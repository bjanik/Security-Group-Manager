. ../aws/common
/usr/local/bin/aws ec2 describe-instances \
    --instance-ids $1 \
    --query 'Reservations[0].Instances[0].PublicDnsName' \
    --output text