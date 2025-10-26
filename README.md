# 📝 Todo App - Sistema de Gestión de Tareas

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

Sistema completo de gestión de tareas desarrollado con **PHP puro**, **MySQL** y arquitectura **MVC**. Proyecto de aprendizaje para dominar los fundamentos del desarrollo backend con PHP.

## ✨ Características

- ✅ **Autenticación de usuarios** (registro, login, logout)
- ✅ **CRUD completo de tareas** (crear, leer, actualizar, eliminar)
- ✅ **Sistema de prioridades** (baja, media, alta)
- ✅ **Estados de tareas** (pendiente, en progreso, completada)
- ✅ **Fechas de vencimiento**
- ✅ **Dashboard con estadísticas**
- ✅ **Diseño responsive**
- ✅ **Seguridad** (password hashing, SQL injection prevention, validaciones)

## 🛠️ Tecnologías Utilizadas

- **Backend**: PHP 7.4+
- **Base de Datos**: MySQL 5.7+
- **Frontend**: HTML5, CSS3
- **Arquitectura**: MVC (Model-View-Controller)
- **Servidor**: Apache con mod_rewrite

## 📋 Requisitos Previos

- PHP >= 7.4
- MySQL >= 5.7
- Apache con mod_rewrite habilitado
- Extensiones PHP: PDO, pdo_mysql, mbstring

## 🚀 Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/TU_USUARIO/todo-app-php.git
cd todo-app-php
```

### 2. Configurar la base de datos

Importa el archivo SQL:
```bash
mysql -u root -p < database.sql
```

O ejecuta manualmente:
```sql
CREATE DATABASE todo_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE todo_app;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
    due_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE INDEX idx_user_status ON tasks(user_id, status);
CREATE INDEX idx_due_date ON tasks(due_date);
```

### 3. Configurar conexión a base de datos

Copia el archivo de ejemplo:
```bash
cp config/database.example.php config/database.php
```

Edita `config/database.php` con tus credenciales:
```php
private $host = 'localhost';
private $db_name = 'todo_app';
private $username = 'root';
private $password = 'tu_password';
```

### 4. Configurar Virtual Host (Opcional)

**Linux/Mac:**
```bash
sudo nano /etc/apache2/sites-available/todo.conf
```

Agrega:
```apache
<VirtualHost *:80>
    DocumentRoot "/var/www/todo-app/public"
    ServerName todo.local
    
    <Directory "/var/www/todo-app/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Activa el sitio:
```bash
sudo a2ensite todo.conf
sudo a2enmod rewrite
sudo systemctl restart apache2
```

Edita `/etc/hosts`:
```
127.0.0.1 todo.local
```

### 5. Acceder a la aplicación

- **Con Virtual Host**: http://todo.local
- **Sin Virtual Host**: http://localhost/todo-app/public/index.php

## 📁 Estructura del Proyecto
```
todo-app/
├── config/
│   ├── database.php           # Configuración de BD (no incluido en Git)
│   └── database.example.php   # Template de configuración
├── src/
│   ├── controllers/
│   │   ├── AuthController.php
│   │   └── TaskController.php
│   ├── models/
│   │   ├── User.php
│   │   └── Task.php
│   └── views/
│       ├── auth/
│       │   ├── login.php
│       │   └── register.php
│       ├── tasks/
│       │   ├── index.php
│       │   ├── create.php
│       │   └── edit.php
│       └── layouts/
│           ├── header.php
│           └── footer.php
└── public/
    ├── index.php              # Punto de entrada
    ├── .htaccess              # Configuración Apache
    └── css/
        └── style.css
```

## 🎯 Conceptos Aprendidos

- ✅ PHP OOP (Programación Orientada a Objetos)
- ✅ Arquitectura MVC
- ✅ PDO y Prepared Statements
- ✅ Autenticación con sesiones
- ✅ Password hashing con `password_hash()`
- ✅ Validación y sanitización de datos
- ✅ Prevención de SQL Injection
- ✅ Prevención de XSS
- ✅ CRUD operations
- ✅ Diseño de base de datos relacional

## 📸 Screenshots

*(Agrega capturas de pantalla aquí)*

## 🔐 Seguridad

- Passwords hasheados con `PASSWORD_BCRYPT`
- Prepared statements para prevenir SQL Injection
- Sanitización de entradas con `htmlspecialchars()`
- Validación de datos en el servidor
- Protección de archivos sensibles con `.htaccess`

## 🚧 Mejoras Futuras

- [ ] Sistema de filtros y búsqueda
- [ ] Paginación
- [ ] Categorías/Etiquetas
- [ ] Recordatorios por email
- [ ] API REST
- [ ] Compartir tareas entre usuarios
- [ ] Dashboard con gráficas

## 👨‍💻 Autor

**Tu Nombre**

- GitHub: [@tu_usuario](https://github.com/tu_usuario)
- LinkedIn: [tu-perfil](https://linkedin.com/in/tu-perfil)

## 📄 Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.

## 🙏 Agradecimientos

Proyecto desarrollado como parte de mi aprendizaje en PHP Backend Development.

---

⭐ Si te fue útil, no olvides darle una estrella al repositorio!
