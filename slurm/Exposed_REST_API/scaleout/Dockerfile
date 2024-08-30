ARG DOCKER_FROM
FROM ${DOCKER_FROM} as base
ARG SLURM_RELEASE
COPY profile.sh /etc/profile.d/container.sh
# ood (open-ondemand user) is hardcoded to user 1000. must ensure uid is not different
RUN groupadd -g 1000 ood && \
	useradd --no-create-home --gid ood -u 1000 ood
RUN dnf -y install 'dnf-command(config-manager)'
RUN dnf -y install dnf-plugins-core
RUN dnf config-manager --set-enabled powertools
RUN dnf -y install --allowerasing --exclude google-chrome-* \
	rpm gcc automake make perl-macros rpm-build passwd \
	readline-devel openssl-devel openssl pam-devel \
	perl-ExtUtils-MakeMaker.noarch mariadb-devel mariadb \
	glib2-devel gtk2-devel libtool git vim gdb hostname \
	perl-Switch expect lua-devel rrdtool-devel lz4-devel json-c-devel \
	libcurl-devel freeipmi-devel numactl-devel lynx numactl \
	rdma-core-devel gcc-c++ flex libgcrypt-devel gcc-gfortran \
	strace ltrace gdb valgrind wget cmake sudo jansson-devel \
	openssh-server pam-devel xterm oniguruma-devel \
	lua-devel xauth man mailx postfix http-parser-devel \
	libyaml-devel mlocate gettext-devel texinfo java-11-openjdk \
	systemd net-tools socat jq squashfs-tools fuse-overlayfs pigz \
	fuse-devel rpcgen cronie valgrind-devel iproute procps-ng \
	lua-json.noarch rsync crun go gpgme-devel libseccomp-devel \
	libassuan-devel dbus-devel bash-completion tzdata-java \
	python3-setuptools-wheel python3-virtualenv python3-urllib3 \
	python3-six python3-requests python3-pexpect \
	python3.11 python3.11-pip python3.11-pytest python3.11-requests
RUN alternatives --set python3 /usr/bin/python3.11 && \
	ln -s $(which pytest-3.11) /usr/bin/pytest-3 && \
	ln -s /usr/lib/python3.6/site-packages/pexpect/ /usr/lib/python3.11/site-packages/pexpect && \
	ln -s /usr/lib/python3.6/site-packages/ptyprocess/ /usr/lib/python3.11/site-packages/ptyprocess
RUN git clone --depth 1 --single-branch -b v3.9.2 https://github.com/luarocks/luarocks.git /usr/local/src/luarocks/
WORKDIR /usr/local/src/luarocks/
RUN ./configure --prefix=/usr/local --sysconfdir=/etc/ && make -j && make install
RUN luarocks install lunajson
RUN pip3 install certifi pip wheel setuptools markdown
RUN git clone --depth 1 --single-branch -b v1.15.2 https://github.com/benmcollins/libjwt.git /usr/local/src/libjwt/
WORKDIR /usr/local/src/libjwt
RUN autoreconf --force --install && ./configure --prefix=/usr/local --sysconfdir=/etc/ && make -j && make install
RUN git clone --depth 1 --single-branch -b jq-1.6 https://github.com/stedolan/jq.git /usr/local/src/jq/
WORKDIR /usr/local/src/jq
RUN autoreconf --force --install && ./configure --prefix=/usr/local --sysconfdir=/etc/ --disable-maintainer-mode && make -j && make install
RUN git clone --depth 1 --single-branch -b munge-0.5.13 https://github.com/dun/munge.git /usr/local/src/munge/
WORKDIR /usr/local/src/munge/
RUN autoreconf -i && ./configure --localstatedir=/var --prefix=/usr/local --sysconfdir=/etc/ >/dev/null && make -j >/dev/null && make install >/dev/null
RUN mkdir -p /etc/slurm /etc/pmix
RUN git clone --depth 1 --single-branch -b release-2.1.12-stable https://github.com/libevent/libevent.git /usr/local/src/libevent/
RUN git clone -b hdf5-1_10_6 --single-branch --depth 1 https://github.com/HDFGroup/hdf5.git /usr/local/src/hdf5
WORKDIR /usr/local/src/hdf5
RUN ./configure --prefix=/usr/local/ >/dev/null && make -j install >/dev/null
WORKDIR /usr/local/src/libevent
RUN ./autogen.sh && ./configure --prefix=/usr/local >/dev/null && make -j >/dev/null && make install >/dev/null
RUN git clone --depth 1 --single-branch -b hwloc-2.0.2 https://github.com/open-mpi/hwloc.git /usr/local/src/hwloc/
WORKDIR /usr/local/src/hwloc
RUN ./autogen.sh && ./configure --prefix=/usr/local --sysconfdir=/etc/hwloc/ >/dev/null && make -j >/dev/null && make install >/dev/null
RUN git clone --depth 1 --single-branch -b v4.2.2 https://github.com/pmix/pmix.git /usr/local/src/pmix/
WORKDIR /usr/local/src/pmix
RUN ./autogen.pl && ./configure --prefix=/usr/local --sysconfdir=/etc/pmix/ --with-devel-headers --with-tests-examples  --enable-debug --with-libevent=/usr/local/ >/dev/null && \
	make -j >/dev/null && make install >/dev/null
RUN git clone --depth 1 --single-branch -b master https://github.com/SchedMD/slurm.git /usr/local/src/slurm && \
	git config --global --add safe.directory /usr/local/src/slurm
WORKDIR /usr/local/src/slurm
RUN git config --global user.email "you@example.com" && \
	git config --global user.name "scale out" && \
	git fetch --depth 1 origin ${SLURM_RELEASE} && \
	git checkout FETCH_HEAD
RUN ./configure --enable-slurmrestd --enable-multiple-slurmd --enable-memory-leak-debug --enable-developer --disable-optimizations --with-munge=/usr/local/ --prefix=/usr/local \
	--sharedstatedir=/run/slurm/ --with-pmix=/usr/local \
	--enable-pam --sysconfdir=/etc/slurm --with-hdf5=/usr/local/bin/h5cc >/dev/null && \
	make -j >/dev/null && make install >/dev/null && make -j install-contrib >/dev/null && \
	cd contribs && make install && \
	ln -nfs /usr/local/src/slurm/contribs/slurm_completion_help/slurm_completion.sh /etc/bash_completion.d/slurm_completion.sh
RUN /usr/sbin/groupadd -r slurm -g 1001 && \
	/usr/sbin/useradd -c "scheduler daemon" -d "/usr/local/src/slurm/testsuite" -g slurm -s /bin/bash -u 1001 -r slurm && \
	/usr/sbin/groupadd -r slurmrestd -g 1002 && \
	/usr/sbin/useradd -c "REST daemon" -d "/etc/slurm" -g slurmrestd -s /bin/bash -u 1002 -r slurmrestd && \
	echo 'slurm        ALL=(ALL)       NOPASSWD: ALL' >> /etc/sudoers
RUN mkdir -p /var/spool/slurm/statesave /var/spool/slurm/spool
RUN chown slurm:slurm -R /var/spool/slurm
RUN /usr/sbin/groupadd -r munge
RUN /usr/sbin/useradd -c "MUNGE authentication service" -d "/usr/local/etc/munge" -g munge -s /bin/false -r munge
RUN mkdir -m 0700 -p /etc/munge/ && \
	mkdir -p -m 0700 /var/log/munge && chown munge:munge -R /var/log/munge /var/run/munge/
RUN dd if=/dev/urandom bs=32 count=1 >/etc/slurm/jwt.key
RUN chown slurm:slurm /etc/slurm/jwt.key
RUN chmod 0600 /etc/slurm/jwt.key
RUN dd if=/dev/urandom bs=1 count=1024 >/etc/munge/munge.key
RUN touch /etc/munge/munge.seed
RUN chown munge:munge -R /etc/munge
RUN chmod 0400 /etc/munge/munge.key /etc/munge/munge.seed
RUN chown root:root /etc/munge/ -R && chown -R munge:munge /etc/munge
RUN git clone --depth 1 --single-branch -b pdsh-2.33 https://github.com/chaos/pdsh.git /usr/local/src/pdsh/
WORKDIR /usr/local/src/pdsh
RUN autoreconf -i && ./configure --without-rsh --with-ssh --prefix=/usr/local --sysconfdir=/etc/ --with-readline && make -j >/dev/null && make install >/dev/null
WORKDIR /usr/local/src/
RUN wget -q 'https://download.open-mpi.org/release/open-mpi/v4.1/openmpi-4.1.4.tar.gz' -O /usr/local/src/openmpi4.tar.gz && \
	tar -xzf /usr/local/src/openmpi4.tar.gz
WORKDIR /usr/local/src/openmpi-4.1.4/
RUN ./configure --prefix=/usr/local/openmpi/4.1.4 --with-pmix=/usr/local \
	--with-pmix-libdir=/usr/local/lib --with-pmi=/usr/local --with-slurm \
	--with-devel-headers --enable-debug --without-cma --with-libevent=/usr/local \
	--with-libevent-header=/usr/local/include --with-libevent-libs=/usr/local/lib \
	--with-hwloc=/usr/local/ --enable-mca-no-build=btl-uct && make -j >/dev/null \
	&& make install >/dev/null
WORKDIR /usr/local/src/
RUN wget -q 'https://download.open-mpi.org/release/open-mpi/v5.0/openmpi-5.0.0rc9.tar.gz' -O /usr/local/src/openmpi5.tar.gz && \
	tar -xzf /usr/local/src/openmpi5.tar.gz
WORKDIR /usr/local/src/openmpi-5.0.0rc9
RUN ./configure --prefix=/usr/local/openmpi/5.0.0rc9 --with-pmix=/usr/local \
	--with-pmix-libdir=/usr/local/lib --with-slurm --with-devel-headers \
	--enable-debug --without-cma --with-libevent=/usr/local \
	--with-libevent-header=/usr/local/include \
	--with-libevent-libs=/usr/local/lib --with-hwloc=/usr/local/ \
	--enable-mca-no-build=btl-uct && make -j >/dev/null && \
	make install >/dev/null
RUN git clone --depth 1 --branch msmtp-1.8.6 https://github.com/marlam/msmtp-mirror.git /usr/local/src/msmtp
WORKDIR /usr/local/src/msmtp
RUN autoreconf -i && ./configure && make -j >/dev/null && make install >/dev/null && \
	ln -nfs /usr/local/bin/msmtp /usr/sbin/sendmail && \
	ln -nfs /usr/local/bin/msmtp /usr/lib/sendmail
COPY msmtprc /usr/local/etc/msmtprc
ARG SUBNET
ARG SUBNET6
ENV SUBNET=${SUBNET}
ENV SUBNET6=${SUBNET6}
RUN postconf -e "mydestination = cluster scaleout localhost.localdomain localhost" && \
	postconf -e "mynetworks = 127.0.0.0/8, ${SUBNET}.0.0/16" && \
	postconf -e "inet_interfaces = all" && \
	postconf -e "recipient_delimiter = +"
RUN newaliases && \
	postconf -e "mydestination = login login.localdomain cluster scaleout localhost.localdomain, localhost"

#Install OpenAPI generator jar directly (installing from source is very slow)
RUN mkdir -p /usr/local/jar/ && \
	curl -s https://repo1.maven.org/maven2/org/openapitools/openapi-generator-cli/4.3.1/openapi-generator-cli-4.3.1.jar -o /usr/local/jar/openapi-generator-cli.jar && \
	echo -e "#!/bin/bash\nexec java -jar /usr/local/jar/openapi-generator-cli.jar \$@" > /usr/local/bin/openapi-generator-cli && chmod 0755 /usr/local/bin/openapi-generator-cli
#https://pypi.org/project/openapi-python-client/

RUN git clone --depth 1 --single-branch -b v0.9.1 https://github.com/NVIDIA/pyxis.git /usr/local/src/pyxis
WORKDIR /usr/local/src/pyxis
RUN make install

RUN git clone --depth 1 --single-branch --branch 20210222 git://git.savannah.gnu.org/parallel.git /usr/local/src/parallel
WORKDIR /usr/local/src/parallel
RUN autoreconf -i && ./configure --disable-documentation && make -j >/dev/null && make install

RUN git clone --depth 1 --single-branch --branch 0.1.103 https://github.com/vasi/squashfuse.git /usr/local/src/squashfuse
WORKDIR /usr/local/src/squashfuse
RUN autoreconf -i && ./configure && make -j >/dev/null && make install

RUN git clone --recurse-submodules --depth 1 --single-branch --branch v3.3.0 https://github.com/NVIDIA/enroot.git /usr/local/src/enroot
WORKDIR /usr/local/src/enroot
COPY enroot.conf /tmp/enroot.conf
RUN make sysconfdir=/etc/enroot/ -j >/dev/null && make install && make setcap && \
	mkdir -p /etc/enroot/ && cat /tmp/enroot.conf >> /usr/local/etc/enroot/enroot.conf && \
	unlink /tmp/enroot.conf && mkdir /run/enroot

RUN git clone --depth 1 --single-branch --branch V0.12.10 https://github.com/ColinIanKing/stress-ng.git /usr/local/src/stressng
WORKDIR /usr/local/src/stressng
RUN make -j >/dev/null && make install
RUN git clone --depth 1 --single-branch --branch v1.8.3 https://github.com/cea-hpc/clustershell.git /usr/local/src/clush
WORKDIR /usr/local/src/clush
RUN python3 ./setup.py install

RUN git clone --depth 1 --single-branch --branch 1.26.6 https://github.com/urllib3/urllib3.git /usr/local/src/urllib3 && \
	cd /usr/local/src/urllib3 && \
	python3 setup.py install

RUN git clone --depth 1 --single-branch --branch v2.1.6 https://github.com/containers/conmon.git /usr/local/src/conmon && \
	cd /usr/local/src/conmon && \
	export GOCACHE="$(mktemp -d)" && \
	make -j && make podman && make install && \
	git clone --depth 1 --single-branch --branch v4.4.1 https://github.com/containers/podman.git /usr/local/src/podman && \
	cd /usr/local/src/podman && \
	export GOCACHE="$(mktemp -d)" && \
	make -j && make podman && make install

WORKDIR /usr/local/src/
RUN git clone --depth 1 --single-branch -b v0.30 https://github.com/hpc/charliecloud.git
WORKDIR /usr/local/src/charliecloud
RUN ./autogen.sh && ./configure --disable-test && make -j >/dev/null && make install

#make ssh host keys
RUN ssh-keygen -f /etc/ssh/ssh_host_rsa_key -N '' -t rsa && \
	ssh-keygen -f /etc/ssh/ssh_host_ecdsa_key -N '' -t ecdsa && \
	ssh-keygen -f /etc/ssh/ssh_host_ed25519_key -N '' -t ed25519 && \
	echo 'password' | passwd root --stdin && \
	mkdir -p /root/.ssh && \
	ssh-keygen -f /root/.ssh/id_ecdsa -N '' -t ecdsa && \
	ssh-keygen -y -f /root/.ssh/id_ecdsa > /root/.ssh/id_ecdsa.pub && \
	cat /root/.ssh/id_ecdsa.pub >> /root/.ssh/authorized_keys && \
	chmod -R 0700 /root/.ssh && \
	echo -n "ood" | passwd --stdin ood && \
	mkdir -p /home/ood/.ssh && \
	ssh-keygen -f /home/ood/.ssh/id_ecdsa -N '' -t ecdsa && \
	ssh-keygen -y -f /home/ood/.ssh/id_ecdsa > /home/ood/.ssh/id_ecdsa.pub && \
	cat /home/ood/.ssh/id_ecdsa.pub >> /home/ood/.ssh/authorized_keys && \
	chown -R ood:ood /home/ood/.ssh && chmod -R 0700 /home/ood/.ssh

RUN groupadd -g 1005 bedrock && \
	groupadd -g 1006 managers
RUN for i in arnold bambam barney betty chip dino edna fred gazoo pebbles wilma; do \
	/usr/sbin/useradd -c $i -m -g users -G bedrock $i && \
	echo 'password' | passwd $i --stdin && \
	mkdir -p /home/$i/.ssh && \
	mkdir -p /srv/containers/$i/ && \
	chown $i:bedrock /srv/containers/$i/ && \
	chmod 0700 /srv/containers/$i/ && \
	ssh-keygen -f /home/$i/.ssh/id_ecdsa -N '' -t ecdsa && \
	ssh-keygen -y -f /home/$i/.ssh/id_ecdsa > /home/$i/.ssh/id_ecdsa.pub && \
	cat /home/$i/.ssh/id_ecdsa.pub >> /home/$i/.ssh/authorized_keys && \
	chown -R $i:users /home/$i/.ssh && chmod -R 0700 /home/$i/.ssh; \
	mkdir -p /home/$i/.enroot/{data,cache}; \
	done
RUN usermod -G managers fred && \
	usermod -G managers barney

#disable ssh host auth checks
RUN echo -e '\nNoHostAuthenticationForLocalhost=yes\nStrictHostKeyChecking=no' >> /etc/ssh/ssh_config && \
	echo -e '\nAddressFamily any\nUseDNS no' >> /etc/ssh/sshd_config

#override the ssh host keys to be known
RUN awk '{print "*", $1, $2}' </etc/ssh/ssh_host_ecdsa_key.pub >> /etc/ssh/ssh_known_hosts

#add pam module as first module
RUN echo -e '+:wheel:ALL\n+:slurm:ALL\n-:ALL:ALL' > /etc/security/access.conf && \
	chmod 0700 /etc/security/access.conf && \
	echo -e '#%PAM-1.0\naccount    sufficient      pam_access.so\naccount    sufficient   pam_slurm_adopt.so\n' | \
	cat - /etc/pam.d/sshd > /etc/pam.d/sshd2 && \
	mv /etc/pam.d/sshd2 /etc/pam.d/sshd && \
	echo -e 'SlurmdSpoolDir=/var/spool/slurm/spool' > /etc/nss_slurm.conf

#active slurm nss
RUN awk '{if (match($1, /^(passwd|group)/)) {print $1, "slurm", $2, $3} else {print $0}}' > /etc/nsswitch2.conf </etc/nsswitch.conf && \
	mv /etc/nsswitch2.conf /etc/nsswitch.conf && \
	mkdir -p /etc/PDSH && \
	echo -e "node00\nnode01\nnode02\nnode03\nnode04\nnode05\nnode06\nnode07\nnode08\nnode09" > /etc/PDSH/hosts && \
	echo -e "\nexport WCOLL=/etc/PDSH/hosts\n" >> /etc/bashrc && \
	echo -e "\nalias cls='clear'\n" >> /etc/bashrc && \
	echo -e "\nalias ..='cd ..'\n" >> /etc/bashrc && \
	echo -e "\nalias l='ls -alF'\n" >> /etc/bashrc && \
	echo -e "\nalias w=\"watch \\\"sinfo -Nel -pdebug ; squeue -a -o '%.18i %.9P %.8j %.8u %.8T %.10M %.9l %.6D %R %Q' | column -t\\\"\"\n" >> /etc/bashrc && \
	mandb
RUN git clone --depth 1 --single-branch -b v1.0.5 https://github.com/CLIP-HPC/SlurmCommander.git /usr/local/src/slurmcommander/ && \
	cd /usr/local/src/slurmcommander/ && make build && make install && mkdir -p /etc/scom && \
	echo 'prefix="/usr/local/bin"' > /etc/scom/scom.conf && cp scom /usr/local/bin/scom

COPY my.cnf /etc/
RUN sed -e "s#{SUBNET}#${SUBNET}#g" -i /etc/my.cnf && \
	ln -s /etc/my.cnf /usr/local/etc/my.cnf
COPY mysql /usr/local/bin/mysql
COPY slurmctld.startup.sh /usr/local/bin/slurmctld.startup.sh
COPY slurmctld.startup2.sh /usr/local/bin/slurmctld.startup2.sh
COPY slurmd.startup.sh /usr/local/bin/slurmd.startup.sh
COPY slurmd.check.sh /usr/local/bin/slurmd.check.sh
COPY login.startup.sh /usr/local/bin/login.startup.sh
COPY slurmrestd.startup.sh /usr/local/bin/slurmrestd.startup.sh
COPY slurmrestd.env /etc/sysconfig/slurmrestd
RUN sed -e "s/{SUBNET6}/${SUBNET6}/" -e "s/{SUBNET}/${SUBNET}/" \
	-i /etc/sysconfig/slurmrestd && \
	chmod 0755 /usr/local/bin/*.sh

RUN cp /usr/local/src/slurm/etc/{slurmctld.service,slurmd.service,slurmdbd.service,slurmrestd.service}  /usr/lib/systemd/system && \
	echo -e '#!/bin/bash\nset -o vi' > /etc/profile.d/mode.sh && \
	chmod 0755 /usr/local/bin/mysql && \
	chmod 0755 /usr/local/bin/slurmctld.startup.sh && \
	chmod 0755 /usr/local/bin/slurmd.startup.sh && \
	chmod 0755 /usr/local/bin/login.startup.sh && \
	chmod 0755 /usr/local/bin/slurmrestd.startup.sh && \
	mkdir -p /auth && chown -R slurm:slurm /auth && \
	chmod 0755 /auth && \
	chown -R slurm:slurm /usr/local/src/

COPY globals.local /usr/local/src/slurm/testsuite/expect/globals.local
COPY testsuite.conf /usr/local/src/slurm/testsuite/testsuite.conf

#RUN echo "define(`SMART_HOST', `login')dnl" >> /etc/mail/sendmail.mc
RUN echo -e "/usr/local/lib\n/usr/local/lib64" >> /etc/ld.so.conf.d/usr_local_lib.conf && \
	ldconfig && updatedb && \
	rm -f /run/nologin
WORKDIR /root/

ARG DOCKER_FROM
FROM ${DOCKER_FROM} as scaleout
ARG CACHE_DESTROYER
COPY --from=base / /
COPY dump_xdmod.sh /etc/cron.hourly/dump_xdmod.sh
COPY resume.node.sh /usr/local/sbin/
COPY suspend.node.sh /usr/local/sbin/
RUN chmod 0755 /usr/local/sbin/{resume.node.sh,suspend.node.sh} && \
	mkdir -p /etc/systemd/system/{postfix,slurmctld,slurmdbd,slurmd,slurmrestd}.service.d
COPY slurmd.slice /etc/systemd/system/slurmd.slice
COPY slurmdbd.service /etc/systemd/system/slurmdbd.service.d/local.conf
COPY slurmctld.service /etc/systemd/system/slurmctld.service.d/local.conf
COPY slurmd.service /etc/systemd/system/slurmd.service.d/local.conf
COPY slurmrestd.service /etc/systemd/system/slurmrestd.service.d/local.conf
COPY postfix.service /etc/systemd/system/postfix.service.d/local.conf
COPY podman-containers /etc/containers/
RUN systemctl enable slurmdbd slurmctld slurmd slurmrestd postfix slurmd.slice && \
	systemctl disable dnf-makecache.timer && \
	systemctl mask systemd-udevd.service kdump.service systemd-tmpfiles-clean.timer  nis-domainname.service systemd-hwdb-update.service systemd-udev-trigger.service
RUN touch "/tmp/$CACHE_DESTROYER"
COPY patch.d /usr/local/src/slurm/patch.d
RUN find /usr/local/src/slurm/patch.d -type f -name '*.patch' -print0 | \
	sort -z > /usr/local/src/slurm/patch.list && \
	env SLURM_RELEASE="${SLURM_RELEASE}" bash -c "\
	if [ -s /usr/local/src/slurm/patch.list ]; then \
		cd /usr/local/src/slurm/; \
		git fetch -f origin \${SLURM_RELEASE}:\${SLURM_RELEASE} && \
		git reset --hard \${SLURM_RELEASE} && \
		xargs -t -0 -r -n1 git am -3 --ignore-space-change --exclude=NEWS < /usr/local/src/slurm/patch.list && \
		make -j >/dev/null && make install >/dev/null; \
	fi"

COPY nodelist /etc/nodelist
COPY slurm/ /etc/slurm/
RUN ln -nfs /usr/local/share/pyxis/pyxis.conf /etc/slurm/plugstack.conf.d/pyxis.conf && \
	chmod 0600 /etc/slurm/slurmdbd.conf && \
	chown slurm:slurm /etc/slurm/slurmdbd.conf && \
	systemctl enable munge && \
	chmod 4755 /bin/ping

STOPSIGNAL SIGRTMIN+3
VOLUME ["/tmp", "/run", "/run/lock"]
COPY hosts.nodes /etc/
COPY startup.sh /sbin/
CMD [ "/sbin/startup.sh" ]
