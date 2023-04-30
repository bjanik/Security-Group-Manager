# cd /Users/bart/.aws
. ../aws/common
/usr/local/bin/aws ec2 create-security-group \
    --description sg-tp-cnam \
    --group-name $1 \
    --vpc-id $VpcId \
    --output text