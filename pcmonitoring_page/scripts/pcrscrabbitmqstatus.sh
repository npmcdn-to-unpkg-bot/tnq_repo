cd /tmp
/usr/local/bin/rabbitmqadmin list queues name messages_ready messages_unacknowledged messages --username=pcrsc --password=WrOUBXN5om --host=52.22.16.117 --port=15672 > /tmp/rabbitmq.status
sed -i '/^+/d' /tmp/rabbitmq.status && sed -i '1d' /tmp/rabbitmq.status && sed -i 's/ //g' /tmp/rabbitmq.status && sed -i 's/^.\{1\}//' /tmp/rabbitmq.status && echo "{\"data\":[" > /tmp/json && awk -F'|' '{print "{ \"name\":\""$1"\", \"ready\":\""$2"\", \"unacked\":\""$3"\", \"total\":\""$4"\" },"}' /tmp/rabbitmq.status >> /tmp/json && sed -i '$s/.$//' /tmp/json && echo "]}" >> /tmp/json && tr -d "\n\r" < /tmp/json >> /tmp/rmq-pcrsc.json
mv /tmp/rmq-pcrsc.json /home/raja/RAJA/git/pcmonitoring_page/json/pcrsc/
rm -rf /tmp/json /tmp/rabbitmq.status
