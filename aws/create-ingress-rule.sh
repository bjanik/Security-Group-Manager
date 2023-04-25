cd /Users/bart/.aws
. ./common
/usr/local/bin/aws ec2 authorize-security-group-ingress \
    --group-name $1 \
    --tag-specifications "ResourceType=security-group-rule,Tags=[{Key=Name,Value=$2}]" \
    --ip-permissions IpProtocol=$3,FromPort=$4,ToPort=$5,IpRanges="[{CidrIp=$6}]" \
    --query 'SecurityGroupRules[].SecurityGroupRuleId' \
    --output text