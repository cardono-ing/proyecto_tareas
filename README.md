# Sistema organizador de tareas escolares

Aplicación web hecha con **CodeIgniter 4 (PHP)** y **MySQL**, con arquitectura MVC
cliente/servidor de 3 capas (monolítica).
Proyecto del curso de Algoritmos, Universidad Mariano Gálvez de Guatemala.

## Funcionalidades
- Pantalla de bienvenida, selector de idioma (English / Español).
- Registro con correo de activación, inicio de sesión y "Recordarme".
- Recuperación de contraseña por correo.
- Perfil: editar datos (con confirmación de contraseña), cambiar contraseña, subir y eliminar imagen.
- Usuarios (solo administradores): CRUD con paginación.
- Tareas: CRUD con búsqueda y paginación.

## Requisitos
- Lubuntu 22 o superior (probado en VirtualBox)
- PHP 8.1+, Composer, MySQL, Git

## Instalación
```bash
git clone https://github.com/cardono-ing/proyecto_tareas.git
cd proyecto_tareas
composer install
cp env .env
```

1. Crear la base de datos y el usuario en MySQL:
```sql
CREATE DATABASE tareas_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'tareas_user'@'localhost' IDENTIFIED BY 'TU_CONTRASEÑA';
GRANT ALL PRIVILEGES ON tareas_db.* TO 'tareas_user'@'localhost';
FLUSH PRIVILEGES;
```
2. Editar `.env`: `CI_ENVIRONMENT`, `app.baseURL = 'http://localhost:8080/'`,
   los datos `database.default.*` y la configuración de correo `email.*`
   (SMTP con contraseña de aplicación de Gmail).
3. Crear las tablas y levantar el servidor:
```bash
php spark migrate
mkdir -p public/uploads/profiles
php spark serve
```
4. Abrir `http://localhost:8080`.

## Crear el primer administrador
Registrar un usuario, activarlo desde el correo y ejecutar:
```bash
mysql -u tareas_user -p tareas_db -e "UPDATE users SET is_admin=1 WHERE email='correo@ejemplo.com';"
```

## Estructura
- `app/Controllers`: Auth, Password, Profile, Users, Tasks, Home
- `app/Models`: UserModel, TaskModel
- `app/Views`: vistas por módulo
- `app/Language/en` y `es`: textos en ambos idiomas
- `app/Filters`: control de acceso (sesión, administrador, recordarme)