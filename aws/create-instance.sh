. ../aws/common
/usr/local/bin/aws ec2 run-instances --image-id ami-01a3ab628b8168507 \
    --count 1 \
    --tag-specifications "ResourceType=instance,Tags=[{Key=Name,Value=$1}]" \
    --instance-type $2 \
    --key-name vm-key-pair \
    --security-group-ids $3 \
    --associate-public-ip-address