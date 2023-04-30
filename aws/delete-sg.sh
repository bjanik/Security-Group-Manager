# cd /Users/bart/.aws
. ../aws/common
/usr/local/bin/aws ec2 delete-security-group \
    --group-id $1