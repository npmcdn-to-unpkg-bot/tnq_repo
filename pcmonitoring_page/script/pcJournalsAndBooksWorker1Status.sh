cd /tmp

/usr/local/bin/rabbitmqadmin list queues name messages_ready messages_unacknowledged messages --username=itsupport --password=pQM1QJGeWKfi --host=172.31.4.131 --port=15672 > /tmp/pcjournalsrabbitmq.status
sed -i '/^+/d' /tmp/pcjournalsrabbitmq.status && sed -i '1d' /tmp/pcjournalsrabbitmq.status && sed -i 's/ //g' /tmp/pcjournalsrabbitmq.status && sed -i 's/^.\{1\}//' /tmp/pcjournalsrabbitmq.status && echo "{\"data\":[" > /tmp/json && awk -F'|' '{print "{ \"name\":\""$1"\", \"ready\":\""$2"\", \"unacked\":\""$3"\", \"total\":\""$4"\" },"}' /tmp/pcjournalsrabbitmq.status >> /tmp/json && sed -i '$s/.$//' /tmp/json && echo "]}" >> /tmp/json && tr -d "\n\r" < /tmp/json >> /tmp/rmq-pcjournals.json
s3cmd del s3://pcmonitoring.tnq.co.in/json/pcjournalsandbooks/rmq-pcjournals.json
s3cmd put /tmp/rmq-pcjournals.json s3://pcmonitoring.tnq.co.in/json/pcjournalsandbooks/
s3cmd setacl --acl-public --recursive s3://pcmonitoring.tnq.co.in/json/pcjournalsandbooks/rmq-pcjournals.json
rm -rf /tmp/json /tmp/rmq-pcjournals.json /tmp/pcjournalsrabbitmq.status

/usr/local/bin/rabbitmqadmin list queues name messages_ready messages_unacknowledged messages --username=pcbooks --password=fv7QC8NP4j --host=172.31.4.131 --port=15672 > /tmp/pcbooksrabbitmq.status
sed -i '/^+/d' /tmp/pcbooksrabbitmq.status && sed -i '1d' /tmp/pcbooksrabbitmq.status && sed -i 's/ //g' /tmp/pcbooksrabbitmq.status && sed -i 's/^.\{1\}//' /tmp/pcbooksrabbitmq.status && echo "{\"data\":[" > /tmp/json && awk -F'|' '{print "{ \"name\":\""$1"\", \"ready\":\""$2"\", \"unacked\":\""$3"\", \"total\":\""$4"\" },"}' /tmp/pcbooksrabbitmq.status >> /tmp/json && sed -i '$s/.$//' /tmp/json && echo "]}" >> /tmp/json && tr -d "\n\r" < /tmp/json >> /tmp/rmq-pcbooks.json
s3cmd del s3://pcmonitoring.tnq.co.in/json/pcjournalsandbooks/rmq-pcbooks.json
s3cmd put /tmp/rmq-pcbooks.json s3://pcmonitoring.tnq.co.in/json/pcjournalsandbooks/
s3cmd setacl --acl-public --recursive s3://pcmonitoring.tnq.co.in/json/pcjournalsandbooks/rmq-pcbooks.json
rm -rf /tmp/json /tmp/rmq-pcbooks.json /tmp/pcbooksrabbitmq.status

/usr/bin/supervisorctl status > /tmp/supervisorctl.status
echo "{\"data\":[" > /tmp/json && awk -F':' '{print $2}' /tmp/supervisorctl.status | awk '{print "{ \"worker\":\""$1"\", \"status\":\""$2"\" },"}' | sed '$s/.$//' >> /tmp/json && echo "]}" >> /tmp/json && tr -d "\n\r" < /tmp/json > /tmp/pcjournalsandbooksworker1.json
s3cmd del s3://pcmonitoring.tnq.co.in/json/pcjournalsandbooks/pcjournalsandbooksworker1.json
s3cmd put /tmp/pcjournalsandbooksworker1.json s3://pcmonitoring.tnq.co.in/json/pcjournalsandbooks/
s3cmd setacl --acl-public --recursive s3://pcmonitoring.tnq.co.in/json/pcjournalsandbooks/pcjournalsandbooksworker1.json
rm -rf /tmp/json /tmp/worker.json /tmp/supervisorctl.status /tmp/pcjournalsandbooksworker1.json


