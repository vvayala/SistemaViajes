# Atlas Travel
Desarrollo Web Usando Software Libre (DWUSL)

Sistema web de planificación de viajes desarrollado con Laravel.

## Funcionalidades

- Gestión de viajes, reservaciones e itinerarios.
- Recomendación de actividades según intereses.
- Wishlist de actividades.
- Foro de viajeros con imágenes.
- Reseñas con fotografías.
- Chat de soporte entre usuarios y administradores.
- Mapa interactivo con actividades cercanas.
- Consulta de clima en tiempo real.
- Integración con Cloudinary.

## Tecnologías

- Laravel 12
- PHP 8.2
- MySQL / MariaDB
- Bootstrap 5
- Bootstrap Icons
- Leaflet
- Open-Meteo
- Cloudinary

## Instalación

```bash
git clone https://github.com/vvayala/SistemaViajes.git

cd SistemaViajes

composer install

npm install

cp .env.example .env

php artisan key:generate
```

Configurar base de datos y Cloudinary en `.env`.

```bash
php artisan migrate --seed

npm run dev

php artisan serve
```

## Roles

### Usuario

- Gestionar viajes.
- Crear itinerarios.
- Publicar en foros.
- Crear reseñas.
- Utilizar wishlist.
- Abrir tickets de soporte.

### Administrador

- Gestionar soporte.
- Responder chats de usuarios.
