#
#     https://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
FROM ubuntu:22.04 as chroot

RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive \
    apt-get -y install \
    unzip \
    wget \
    socat \
    default-jre-headless && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN wget http://h2o-release.s3.amazonaws.com/h2o/rel-3.46.0/1/h2o-3.46.0.1.zip
RUN unzip h2o-3.46.0.1.zip

ADD realm.properties /h2o-3.46.0.1

ADD startup.sh /
RUN chmod +777 /startup.sh

FROM gcr.io/kctf-docker/challenge@sha256:0f7d757bcda470c3bbc063606335b915e03795d72ba1d8fdb6f0f9ff3757364f

COPY --from=chroot / /chroot

ADD nsjail.cfg /
CMD kctf_setup && \
    kctf_drop_privs nsjail --config /nsjail.cfg --port 1337 -- /startup.sh

## To setup password:
# $ java -cp /opt/h2oai/h2o-3/h2o.jar org.eclipse.jetty.util.security.Password user pass
# > 19:01:51.510 [main] INFO  org.eclipse.jetty.util.log - Logging initialized @759ms to org.eclipse.jetty.util.log.Slf4jLog
# > pass
# > OBF:1y0s1v1p1v2p1y0y
# > MD5:1a1dc91c907325c69271ddf0c944bc72
# > CRYPT:usGhvISzyaLuU
# $ echo 'user: MD5:1a1dc91c907325c69271ddf0c944bc72' > realm.properties
## Start server
#java -jar /opt/h2oai/h2o-3/h2o.jar -hash_login -login_conf realm.properties