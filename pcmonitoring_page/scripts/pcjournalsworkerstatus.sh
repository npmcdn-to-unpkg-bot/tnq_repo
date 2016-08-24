cd /tmp
/usr/bin/supervisorctl status > /tmp/supervisorctl.status
echo "{\"data\":[" > /tmp/json && awk -F':' '{print $2}' /tmp/supervisorctl.status | awk '{print "{ \"worker\":\""$1"\", \"status\":\""$2"\" },"}' | sed '$s/.$//' >> /tmp/json && echo "]}" >> /tmp/json && tr -d "\n\r" < /tmp/json > /tmp/worker.json
scp -i ~/.ssh/statsuser.pem /tmp/worker.json statsuser@172.31.7.51:/tnqpc/apps/pcmonitoring/
rm -rf /tmp/json /tmp/worker.json /tmp/supervisorctl.status
