# INSTALAR CENTOS7 64Bits Minimal
# Colar o codigo Abaixo no terminal

- yum install -y nano wget git
- cd /usr/src
- git clone https://github.com/skynetfibragithub/mbilling.git

- mv mbilling/install.sh /root/install.sh
- cd 
- chmod +x install.sh
- ./install.sh
# 

# Apos a instalação
enviar o arquivo base.sql para pasta raiz (root) e copiar e colar o codigo abaixo no terminal


- mysql mbilling < base.sql

