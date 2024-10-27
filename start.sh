#!/bin/bash

# Actualiza los paquetes e instala wget y unzip
sudo apt update -y
sudo apt install wget unzip -y

# Descarga el archivo desde GitHub
wget https://github.com/Encanto-ITM/TuLook_API/archive/refs/heads/main.zip -O TuLook_API.zip

# Descomprime el archivo
unzip TuLook_API.zip

# Da permisos 777 a la carpeta descomprimida
chmod -R 777 TuLook_API-main

# Mensaje de finalización
echo "Descarga y descompresión completada. Permisos aplicados."
