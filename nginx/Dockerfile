FROM nginx:latest

RUN apt-get update && apt-get install wget systemd lsb-release libpam-systemd daemonize dbus-user-session fontconfig -yqq
RUN wget https://packages.wazuh.com/4.x/apt/pool/main/w/wazuh-agent/wazuh-agent_4.7.2-1_amd64.deb && WAZUH_MANAGER='deploiement-samuel.com' WAZUH_AGENT_GROUP='default' dpkg -i ./wazuh-agent_4.7.2-1_amd64.deb
#RUN /etc/init.d/dbus start
#RUN systemctl daemon-reload
#RUN systemctl enable wazuh-agent
#RUN systemctl start wazuh-agent
#RUN service enable wazuh-agent
#RUN service start wazuh-agent
