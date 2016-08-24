cd /tmp

/usr/local/bin/rabbitmqadmin list queues name messages_ready messages_unacknowledged messages --username=proofcentral --password=gQ168HV57n --host=172.31.1.41 --port=15672 > /tmp/pgcjournalsrabbitmq.status
sed -i '/^+/d' /tmp/pgcjournalsrabbitmq.status && sed -i '1d' /tmp/pgcjournalsrabbitmq.status && sed -i 's/ //g' /tmp/pgcjournalsrabbitmq.status && sed -i 's/^.\{1\}//' /tmp/pgcjournalsrabbitmq.status && echo "{\"data\":[" > /tmp/json && awk -F'|' '{print "{ \"name\":\""$1"\", \"ready\":\""$2"\", \"unacked\":\""$3"\", \"total\":\""$4"\" },"}' /tmp/pgcjournalsrabbitmq.status >> /tmp/json && sed -i '$s/.$//' /tmp/json && echo "]}" >> /tmp/json && tr -d "\n\r" < /tmp/json >> /tmp/rmq-pgcjournals.json
s3cmd del s3://pcmonitoring.tnq.co.in/json/pgcjournals/rmq-pgcjournals.json
s3cmd put /tmp/rmq-pgcjournals.json s3://pcmonitoring.tnq.co.in/json/pgcjournals/
s3cmd setacl --acl-public --recursive s3://pcmonitoring.tnq.co.in/json/pgcjournals/rmq-pgcjournals.json
rm -rf /tmp/json /tmp/pgcjournalsrabbitmq.status /tmp/rmq-pgcjournals.json

/usr/local/bin/rabbitmqadmin list connections name protocol channels user state --username=proofcentral --password=gQ168HV57n --host=172.31.1.41 --port=15672 > /tmp/pgcjournalsrabbitmqconnection1.status
sed -i '/^+/d' /tmp/pgcjournalsrabbitmqconnection1.status && sed -i '1d' /tmp/pgcjournalsrabbitmqconnection1.status && sed -i 's/ //g' /tmp/pgcjournalsrabbitmqconnection1.status && sed -i 's/^.\{1\}//' /tmp/pgcjournalsrabbitmqconnection1.status && echo "{\"data\":[" > /tmp/json && awk -F'|' '{print "{ \"name\":\""$1"\", \"protocol\":\""$2"\", \"chennals\":\""$3"\", \"user\":\""$4"\", \"state\":\""$5"\"  },"}' /tmp/pgcjournalsrabbitmqconnection1.status >> /tmp/json && sed -i '$s/.$//' /tmp/json && echo "]}" >> /tmp/json && tr -d "\n\r" < /tmp/json >> /tmp/rmq1-pgcjournalsconnection.json
s3cmd del s3://pcmonitoring.tnq.co.in/json/pgcjournals/rmq1-pgcjournalsconnection.json
s3cmd put /tmp/rmq1-pgcjournalsconnection.json s3://pcmonitoring.tnq.co.in/json/pgcjournals/
s3cmd setacl --acl-public --recursive s3://pcmonitoring.tnq.co.in/json/pgcjournals/rmq1-pgcjournalsconnection.json
rm -rf /tmp/json /tmp/pgcjournalsrabbitmqconnection1.status /tmp/rmq1-pgcjournalsconnection.json

/usr/local/bin/rabbitmqadmin list connections name protocol channels user state --username=proofcentral --password=gQ168HV57n --host=172.31.4.136 --port=15672 > /tmp/pgcjournalsrabbitmqconnection2.status
sed -i '/^+/d' /tmp/pgcjournalsrabbitmqconnection2.status && sed -i '1d' /tmp/pgcjournalsrabbitmqconnection2.status && sed -i 's/ //g' /tmp/pgcjournalsrabbitmqconnection2.status && sed -i 's/^.\{1\}//' /tmp/pgcjournalsrabbitmqconnection2.status && echo "{\"data\":[" > /tmp/json && awk -F'|' '{print "{ \"name\":\""$1"\", \"protocol\":\""$2"\", \"chennals\":\""$3"\", \"user\":\""$4"\", \"state\":\""$5"\"  },"}' /tmp/pgcjournalsrabbitmqconnection2.status >> /tmp/json && sed -i '$s/.$//' /tmp/json && echo "]}" >> /tmp/json && tr -d "\n\r" < /tmp/json >> /tmp/rmq2-pgcjournalsconnection.json
s3cmd del s3://pcmonitoring.tnq.co.in/json/pgcjournals/rmq2-pgcjournalsconnection.json
s3cmd put /tmp/rmq2-pgcjournalsconnection.json s3://pcmonitoring.tnq.co.in/json/pgcjournals/
s3cmd setacl --acl-public --recursive s3://pcmonitoring.tnq.co.in/json/pgcjournals/rmq2-pgcjournalsconnection.json
rm -rf /tmp/json /tmp/pgcjournalsrabbitmqconnection2.status /tmp/rmq2-pgcjournalsconnection.json

/usr/bin/supervisorctl status > /tmp/supervisorctl.status
echo "{\"data\":[" > /tmp/json && awk -F':' '{print $2}' /tmp/supervisorctl.status | awk '{print "{ \"worker\":\""$1"\", \"status\":\""$2"\" },"}' | sed '$s/.$//' >> /tmp/json && echo "]}" >> /tmp/json && tr -d "\n\r" < /tmp/json > /tmp/pgcjournalsworker1.json
s3cmd del s3://pcmonitoring.tnq.co.in/json/pgcjournals/pgcjournalsworker1.json
s3cmd put /tmp/pgcjournalsworker1.json s3://pcmonitoring.tnq.co.in/json/pgcjournals/
s3cmd setacl --acl-public --recursive s3://pcmonitoring.tnq.co.in/json/pgcjournals/pgcjournalsworker1.json
rm -rf /tmp/json /tmp/worker.json /tmp/supervisorctl.status /tmp/pgcjournalsworker1.json


