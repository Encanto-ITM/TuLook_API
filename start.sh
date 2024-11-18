#!/bin/bash

# Actualiza los paquetes e instala wget y unzip
sudo apt update -y
sudo apt install wget unzip -y

# Descarga el archivo desde GitHub
wget https://github.com/Encanto-ITM/TuLook_API/archive/refs/heads/main.zip -O backend.zip

wget https://github.com/Encanto-ITM/TuLook-Desarrollo/archive/refs/heads/main.zip -O frontend.zip

# Descomprime los archivos
unzip backend.zip && rm backend.zip

unzip frontend.zip && rm frontend.zip

# Da permisos 777 a la carpeta descomprimida
chmod -R 777 TuLook_API-main

chmod -R 777 TuLook-Desarrollo-main

# Entra en la carpeta descomprimida
cd TuLook_API-main

# instala docker-compose
sudo apt install docker-compose -y	

# Inicia el contenedor
sudo docker-compose up -d --build

# Ejecuta el script init.sh
# ./init.sh

# Sale y entra en la carpeta del frontend
cd ../TuLook-Desarrollo-main

# Inicia el docker-compose
sudo docker-compose up -d --build
