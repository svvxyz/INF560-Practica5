# Portal Favoritos (INF-560) / Práctica 5

## Autor

Abimael Aviles Melchor

## Instalación

```bash
git clone https://github.com/svvxyz/INF560-Practica5.git
cd INF560-Practica5
composer install
npm install
cp .env.example .env
php artisan key:generate
```

## Configuración de base de datos

Editar `.env`:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=portalfav_db
DB_USERNAME=usuario
DB_PASSWORD=contrasenia
```

## Migraciones y datos de prueba

```bash
php artisan migrate
php artisan db:seed
```

## Compilar assets

```bash
npm run build
```

## Ejecutar servidor

```bash
php artisan serve
```

Abrir `http://localhost:8000`.

## Usuario de prueba

| Email: bigotes21@gmail.com  |

| Password: password |