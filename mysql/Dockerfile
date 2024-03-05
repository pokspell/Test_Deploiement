FROM mysql:8.0

RUN yum update && yum install wget systemd
RUN wget https://packages.wazuh.com/4.x/apt/pool/main/w/wazuh-agent/wazuh-agent_4.7.2-1_amd64.deb && sudo WAZUH_MANAGER='test.com' WAZUH_AGENT_GROUP='default' dpkg -i ./wazuh-agent_4.7.2-1_amd64.deb
RUN systemctl daemon-reload
RUN systemctl enable wazuh-agent
RUN systemctl start wazuh-agent
