cd /tmp
/usr/bin/supervisorctl status > /tmp/supervisorctl.status
echo "{\"data\":[" > /tmp/json && awk -F':' '{print $2}' /tmp/supervisorctl.status | awk '{print "{ \"worker\":\""$1"\", \"status\":\""$2"\" },"}' | sed '$s/.$//' >> /tmp/json && echo "]}" >> /tmp/json && tr -d "\n\r" < /tmp/json > /tmp/pcjournalsandbooksworker2.json
s3cmd del s3://pcmonitoring.tnq.co.in/json/pcjournalsandbooks/pcjournalsandbooksworker2.json
s3cmd put /tmp/pcjournalsandbooksworker2.json s3://pcmonitoring.tnq.co.in/json/pcjournalsandbooks/
s3cmd setacl --acl-public --recursive s3://pcmonitoring.tnq.co.in/json/pcjournalsandbooks/pcjournalsandbooksworker2.json

rm -rf /tmp/json /tmp/supervisorctl.status /tmp/pcjournalsandbooksworker2.json
