# Frontend del Sistema de Gestión de Productos

Este es el frontend del sistema de gestión de productos desarrollado con Vue.js.

## Requisitos previos

- Node.js >= 16
- npm o pnpm

## Instalación

1. Clona el repositorio:
```bash
git clone https://github.com/elkinsierrah/stock-products-sistems.git
cd stock-products-sistems/products-front
```

2. Instala las dependencias:
```bash
npm install
# o si prefieres usar pnpm
pnpm install
```

3. Configura el archivo de entorno:
```bash
cp .env.example .env
```

4. Configura la URL de la API en el archivo `.env`

5. Inicia el servidor de desarrollo:
```bash
npm run dev
# o si prefieres usar pnpm
pnpm run dev
```

## Compilar para producción

```bash
npm run build
# o si prefieres usar pnpm
pnpm run build
```

## Usando Docker

También puedes usar Docker para ejecutar la aplicación:

```bash
docker-compose up -d
```

## Características

- Autenticación de usuarios
- Gestión de productos (CRUD)
- Interfaz de usuario intuitiva con Tailwind CSS
