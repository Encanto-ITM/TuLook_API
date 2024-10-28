#!/bin/bash

# Actualiza los paquetes e instala wget y unzip
sudo apt update -y
sudo apt install wget unzip -y

# Descarga el archivo desde GitHub
wget https://github.com/Encanto-ITM/TuLook_API/archive/refs/heads/main.zip -O main.zip

# Descomprime el archivo
unzip main.zip

# Da permisos 777 a la carpeta descomprimida
chmod -R 777 TuLook_API-main

# Entra en la carpeta descomprimida
cd TuLook_API-main

# instala docker-compose
sudo apt install docker-compose -y	

# Inicia el contenedor
sudo docker-compose up -d --build

# Espera a que los contenedores inicien
# sleep 60

# Ejecuta el script init.sh
./init.sh