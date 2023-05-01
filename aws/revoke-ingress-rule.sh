. ../aws/common
/usr/local/bin/aws ec2 revoke-security-group-ingress \
    --group-id $1 \
    --security-group-rule-ids $2