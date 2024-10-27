#!/bin/bash

# Verificar si la carpeta vendor no existe
if [ ! -d "vendor" ]; then
  echo "La carpeta 'vendor' no existe. Ejecutando composer install..."
  composer install
fi

# Verificar si el archivo .env no existe y copiar .env.txt como .env
if [ ! -f ".env" ]; then
  echo "El archivo '.env' no existe. Creando uno nuevo desde .env.txt..."
  cp .env.txt .env
fi

# Mensaje de finalización
echo "Inicialización completada."
