#!/bin/bash
#===============================================================================
#
#          FILE:  
# 
#         USAGE:   
# 
#   DESCRIPTION:  This script is used to transfer latest zip file from AWS S3 to local directory then extract it into another directory.
#                 It will log all the actions and send a mail to admin.
#       OPTIONS:  ---
#  REQUIREMENTS:  This Script Requires s3cmd Utility. It is availble in sourceforge.net
#		  http://sourceforge.net/projects/s3tools/files/s3cmd/1.0.1/s3cmd-1.0.1.tar.gz/download
#          BUGS:  ---
#         NOTES:  ---
#        AUTHOR:  arun sasidharan (), arunssasidhar@gmail.com
#       COMPANY:  
#       VERSION:  1.0
#       CREATED:  Monday 18 July 2011 03:58:59  IST IST
#      REVISION:  ---
#===============================================================================
##Your S3 Bucket Name
S3_BUCKET=mybucket
 
##Local Directory For downloading files from S3 Bucket            
LOCAL_DIR=/tmp/1/      

##Where to Log your activities during tranasfer           
LOG_FILE=/tmp/scriptlog

##Target location to extract the ZIP file      
ZIP_EXT_DIR=/tmp/var/Downloads/ 
      
##Admin Email For sending Log
ADMIN_EMAIL=arunssasidhar@gmail.com    

##Email Subject                 
EMAIL_SUBJECT="S3 Transfer Status On"  #Should be in Quotes     
#*****************************************************************************************
#
#                               STOP EDITING FROM HERE DOWN!!!
#
#*****************************************************************************************
PATH=/usr/local/bin:/usr/bin:/bin:
DATE=$(date +"%d-%m-%Y_%Hh:%Mm")
TIME=$(date +"%Hh:%Mm")
echo "" >>$LOG_FILE
echo "$DATE" >>$LOG_FILE
#
[ -d $LOCAL_DIR ] || mkdir -p $LOCAL_DIR
[ -d $ZIP_EXT_DIR ] || mkdir -p $ZIP_EXT_DIR
#
#Main Functions
#This function is used to extract current sessions log from log file and send it to Admin
mail_me () {
 LIVE=$(cat $LOG_FILE | grep -n "$DATE" | tail -1 | cut -d":" -f 1)
 tail -n +$LIVE $LOG_FILE | mail -s "$EMAIL_SUBJECT $DATE" $ADMIN_EMAIL
}
#
#This function will send mail then exit with status 0 
exit_0 () {
  mail_me
  exit 0
}
#
#This function will send mail then exit with status 1 (End up with error!)
exit_1 () {
  mail_me
  exit 1
}
#########################
## Get the Last uploaded File-name from S3 Bucket (Only One)
S3_OBJECT=$(s3cmd ls s3://$S3_BUCKET | sort | tail -1 | awk '{ print $4 }') 
## Download the latest file into Local Directory
s3cmd get $S3_OBJECT $LOCAL_DIR 2>>$LOG_FILE                              
#########################
if [ $? -eq 0 ]
  then 
      echo "$TIME : Transfer Completed Successfully" >>$LOG_FILE
      FILE=$(echo $S3_OBJECT | awk -F"/" '{print $NF}')             ## Fetch the file name from S3 URL
      echo "$TIME : Zip Extraction Started" >>$LOG_FILE
      unzip -nq "$LOCAL_DIR""$FILE" -d $ZIP_EXT_DIR 2>>$LOG_FILE    ## Unzip the downloaded file to extract Directory
               if [ $? -eq 0 ] 
		    then echo "$TIME : Zip Successfully Extracted To $ZIP_EXT_DIR" >>$LOG_FILE
                    else echo "$TIME : Zip Extraction Failed With Above Errors" >>$LOG_FILE 
                         exit_1
               fi
      exit_0   
  else
      echo "$TIME : Transfer Failed with Above Errors" >>$LOG_FILE
      exit_1
fi
#########END#######
