cd /tmp
/usr/local/bin/rabbitmqadmin list queues name messages_ready messages_unacknowledged messages --username=proofcentral --password=gQ168HV57n --host=52.70.238.139 --port=15672 > /tmp/rabbitmq.status
sed -i '/^+/d' /tmp/rabbitmq.status && sed -i '1d' /tmp/rabbitmq.status && sed -i 's/ //g' /tmp/rabbitmq.status && sed -i 's/^.\{1\}//' /tmp/rabbitmq.status && echo "{\"data\":[" > /tmp/json && awk -F'|' '{print "{ \"name\":\""$1"\", \"ready\":\""$2"\", \"unacked\":\""$3"\", \"total\":\""$4"\" },"}' /tmp/rabbitmq.status >> /tmp/json && sed -i '$s/.$//' /tmp/json && echo "]}" >> /tmp/json && tr -d "\n\r" < /tmp/json >> /tmp/rmq-pgcjournals.json
mv /tmp/rmq-pgcjournals.json /home/raja/RAJA/git/pcmonitoring_page/json/pgcjournals/
rm -rf /tmp/json /tmp/rabbitmq.status
