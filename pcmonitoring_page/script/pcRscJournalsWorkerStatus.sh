cd /tmp

/usr/local/bin/rabbitmqadmin list queues name messages_ready messages_unacknowledged messages --username=pcrsc --password=WrOUBXN5om --host=172.31.16.13 --port=15672 > /tmp/pcrscrabbitmq.status
sed -i '/^+/d' /tmp/pcrscrabbitmq.status && sed -i '1d' /tmp/pcrscrabbitmq.status && sed -i 's/ //g' /tmp/pcrscrabbitmq.status && sed -i 's/^.\{1\}//' /tmp/pcrscrabbitmq.status && echo "{\"data\":[" > /tmp/json && awk -F'|' '{print "{ \"name\":\""$1"\", \"ready\":\""$2"\", \"unacked\":\""$3"\", \"total\":\""$4"\" },"}' /tmp/pcrscrabbitmq.status >> /tmp/json && sed -i '$s/.$//' /tmp/json && echo "]}" >> /tmp/json && tr -d "\n\r" < /tmp/json >> /tmp/rmq-pcrsc.json
s3cmd del s3://pcmonitoring.tnq.co.in/json/pcrsc/rmq-pcrsc.json
s3cmd put /tmp/rmq-pcrsc.json s3://pcmonitoring.tnq.co.in/json/pcrsc/
s3cmd setacl --acl-public --recursive s3://pcmonitoring.tnq.co.in/json/pcrsc/rmq-pcrsc.json
rm -rf /tmp/json /tmp/rmq-pcrsc.json /tmp/pcrscrabbitmq.status

/usr/bin/supervisorctl status > /tmp/supervisorctl.status
echo "{\"data\":[" > /tmp/json && awk -F':' '{print $2}' /tmp/supervisorctl.status | awk '{print "{ \"worker\":\""$1"\", \"status\":\""$2"\" },"}' | sed '$s/.$//' >> /tmp/json && echo "]}" >> /tmp/json && tr -d "\n\r" < /tmp/json > /tmp/pcrscworker.json
s3cmd del s3://pcmonitoring.tnq.co.in/json/pcrsc/pcrscworker.json
s3cmd put /tmp/pcrscworker.json s3://pcmonitoring.tnq.co.in/json/pcrsc/
s3cmd setacl --acl-public --recursive s3://pcmonitoring.tnq.co.in/json/pcrsc/pcrscworker.json
rm -rf /tmp/json /tmp/supervisorctl.status /tmp/pcrscworker.json

