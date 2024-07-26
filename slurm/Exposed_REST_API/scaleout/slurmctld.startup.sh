#!/bin/bash
#only configure once
[ -f /var/run/slurmctld.startup ] && exit 0

HOST="$(cat /etc/hostname)"

sed -e '/^hosts:/d' -i /etc/nsswitch.conf
echo 'hosts: files myhostname' >> /etc/nsswitch.conf

[ "${HOST}" = "mgmtnode" ] && IS_MGT=1 || IS_MGT=
[ "${HOST}" = "${SLURM_FEDERATION_CLUSTER}-mgmtnode" ] && IS_FMGT=1 || IS_FMGT=
echo "Running on host:${HOST} cluster:${SLURM_FEDERATION_CLUSTER} mgt=${IS_MGT} federated=${IS_FMGT}"

if [ "${IS_MGT}${IS_FMGT}" != "" ]
then
	if [ "$IS_FMGT" != "" ]
	then
		#force the cluster name to be the assigned
		sed -e '/^ClusterName=/d' -i /etc/slurm/slurm.conf
		echo "ClusterName=${SLURM_FEDERATION_CLUSTER}" >> /etc/slurm/slurm.conf

		sed -e '/^SlurmCtldHost=/d' -i /etc/slurm/slurm.conf
		echo "SlurmCtldHost=${SLURM_FEDERATION_CLUSTER}-mgmtnode" >> /etc/slurm/slurm.conf
		echo "SlurmCtldHost=${SLURM_FEDERATION_CLUSTER}-mgmtnode2" >> /etc/slurm/slurm.conf

	fi

	if [ ! -s /etc/slurm/nodes.conf ]
	then
		props="$(slurmd -C | head -1 | sed "s#NodeName=$(hostname -s) ##g")"
		echo "NodeName=DEFAULT $props Gres=gpu:gtx:3 State=UNKNOWN" > /etc/slurm/nodes.conf

		cat /etc/nodelist | while read name cluster ip4 ip6
		do
			if [[ "$cluster" = "${SLURM_FEDERATION_CLUSTER}" ]]
			then
				[ ! -z "$ip6" ] && addr="$ip6" || addr="$ip4"
				echo "NodeName=$name NodeAddr=$addr" >> /etc/slurm/nodes.conf
			fi
		done

		NODES=$(cat /etc/nodelist  | awk -v CLUSTER=${SLURM_FEDERATION_CLUSTER} '
			BEGIN {delete nodes[0]}

			$2 == CLUSTER {
				nodes[$1]=1
			}

			END {
				comma=0
				for (i in nodes) {
					if (comma)
						printf ",%s", i
					else
						printf "%s", i
					comma=1
				}
			}')

		grep "PartitionName=DEFAULT" /etc/slurm/slurm.conf &>/dev/null
		if [ $? -ne 0 ]
		then
			#only add partitions if none exist yet - avoid clobbering user modified partition config
			echo "PartitionName=DEFAULT Nodes=$NODES" >> /etc/slurm/slurm.conf
			echo "PartitionName=debug Nodes=$NODES Default=YES MaxTime=INFINITE State=UP" >> /etc/slurm/slurm.conf
		fi
	fi

	[ ! -s /etc/slurm/nodes.conf ] && (echo "nodes.conf not populated when it should have been" && exit 10)

	#wait for slurmdbd to start up fully

	while true
	do
		sacctmgr show cluster &>/dev/null
		[ $? -eq 0 ] && break
		sleep 5
	done

	sacctmgr -vi add cluster "${SLURM_FEDERATION_CLUSTER}"
	sacctmgr -vi add account bedrock Cluster="${SLURM_FEDERATION_CLUSTER}" Description="none" Organization="none"
	sacctmgr -vi add user root Account=bedrock DefaultAccount=bedrock
	sacctmgr -vi add user slurm Account=bedrock DefaultAccount=bedrock

	for i in arnold bambam barney betty chip edna fred gazoo wilma dino pebbles
	do
		sacctmgr -vi add user $i Account=bedrock DefaultAccount=bedrock
	done

	#disable admins to allow their setup in class
	#sacctmgr -vi add user dino Account=bedrock DefaultAccount=bedrock admin=admin
	#sacctmgr -vi add user pebbles Account=bedrock DefaultAccount=bedrock admin=admin
else
	#wait for primary mgt node to be done starting up
	while [ [ ! -s /etc/slurm/nodes.conf ] -o [ "$(scontrol --json ping | jq -r '.pings[0].pinged')" = "UP" ] ]
	do
		sleep 0.25
	done
fi

date > /var/run/slurmctld.startup

exit 0
