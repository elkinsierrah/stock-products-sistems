# Sistema de Gestión de Productos

Este es un sistema completo para la gestión de inventario de productos, desarrollado con Laravel (backend) y Vue.js (frontend).

## Estructura del Proyecto

El proyecto está dividido en dos partes principales:

- **products-back**: API REST desarrollada con Laravel
- **products-front**: Aplicación frontend desarrollada con Vue.js

## Requisitos

- PHP >= 8.1
- Node.js >= 16
- Composer
- MySQL o PostgreSQL
- Docker (opcional)

## Instalación

### Backend (Laravel)

1. Navega al directorio del backend:
```bash
cd products-back
```

2. Sigue las instrucciones en el [README del backend](./products-back/README.md)

### Frontend (Vue.js)

1. Navega al directorio del frontend:
```bash
cd products-front
```

2. Instala las dependencias:
```bash
npm install
```

3. Configura el archivo de entorno:
```bash
cp .env.example .env
```

4. Inicia el servidor de desarrollo:
```bash
npm run dev
```

## Usando Docker

Puedes ejecutar todo el sistema usando Docker Compose:

```bash
docker-compose up -d
```

## Características

- Autenticación de usuarios
- Gestión de productos (CRUD)
- Interfaz de usuario intuitiva
- API RESTful

## Capturas de Pantalla

(Próximamente)

## Licencia

MIT 