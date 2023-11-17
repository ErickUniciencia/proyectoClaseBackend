# Nombre del Proyecto

Descripción corta del proyecto.

## Requisitos Previos

Asegúrate de tener instalados los siguientes requisitos previos antes de continuar:

- PHP >= 7.3
- Composer
- Node.js y NPM
- MySQL o cualquier otro sistema de gestión de bases de datos compatible con Laravel

## Configuración

Sigue estos pasos para configurar el proyecto:

1. Clona el repositorio:

   ```bash
   git clone https://github.com/ErickUniciencia/proyectoClaseBackend.git
   cd proyectoClaseBackend
   
2. Dentro de la carpeta del proyecto instala las dependencias necesarias:

   ```bash
   composer install

3. Copia el archivo .env.example y crea un archivo .env. Luego, configura las variables de entorno, como la conexión a la base de datos y las claves de seguridad:

   ```bash
   cp .env.example .env

4. Genera una nueva clave de aplicación:

   ```bash
   php artisan key:generate

5. Ejecuta las migraciones para crear las tablas de la base de datos:

   ```bash
   php artisan migrate

6. Instala las dependencias de JavaScript y compila los activos:
   ```bash
   npm install
   npm run dev

7. Inicia el servidor de desarrollo:
   
   ```bash
   php artisan serve