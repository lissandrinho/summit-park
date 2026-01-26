# Summit Park - Sistema de Reservas

Sistema web de gestión de reservas y waivers para Summit Trampoline Park, desarrollado con Laravel e Inertia.js.

## 🚀 Características

- **Sistema de Reservas**: Reserva de turnos con selección de fecha, hora y duración
- **Gestión de Waivers**: Sistema de firmas digitales para exención de responsabilidad
- **Panel de Administración**: Dashboard para gestión de reservas, waivers y actividades
- **Gestión de Actividades**: CRUD completo para actividades/pases del parque
- **Autenticación**: Sistema de login y registro de usuarios

## 🛠️ Tecnologías

- **Backend**: Laravel 11
- **Frontend**: Vue.js 3 + Inertia.js
- **Estilos**: Tailwind CSS
- **Base de Datos**: MySQL/PostgreSQL

## 📋 Requisitos

- PHP >= 8.2
- Composer
- Node.js >= 18
- NPM o Yarn

## 🔧 Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/tu-usuario/summit-park.git
cd summit-park
```

2. Instalar dependencias de PHP:
```bash
composer install
```

3. Instalar dependencias de Node:
```bash
npm install
```

4. Configurar el archivo `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurar la base de datos en `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=summit_park
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

6. Ejecutar migraciones:
```bash
php artisan migrate
```

7. Compilar assets:
```bash
npm run dev
# o para producción:
npm run build
```

8. Iniciar el servidor:
```bash
php artisan serve
```

## 📁 Estructura del Proyecto

```
summit-park/
├── app/
│   ├── Http/Controllers/    # Controladores
│   └── Models/              # Modelos Eloquent
├── database/
│   ├── migrations/          # Migraciones de BD
│   └── seeders/            # Seeders
├── resources/
│   ├── js/
│   │   ├── Components/     # Componentes Vue
│   │   ├── Layouts/         # Layouts
│   │   └── Pages/           # Páginas Inertia
│   └── css/                 # Estilos
├── routes/
│   └── web.php             # Rutas web
└── public/                 # Archivos públicos
```

## 🔐 Variables de Entorno

Asegúrate de configurar las siguientes variables en tu archivo `.env`:

- `APP_NAME`: Nombre de la aplicación
- `APP_URL`: URL de la aplicación
- `DB_*`: Configuración de base de datos
- `MAIL_*`: Configuración de correo (opcional)

## 📝 Funcionalidades Principales

### Reservas
- Selección de fecha y hora
- Configuración de duración (60, 90, 120 minutos)
- Selección de número de saltadores
- Cálculo automático de precios

### Waivers
- Firma digital con canvas
- Gestión de menores a cargo
- Validación de límites según reserva
- Almacenamiento de firmas

### Dashboard
- Vista de reservas recientes
- Estadísticas de ingresos
- Gestión de actividades
- Control de estado de reservas

## 🤝 Contribuir

Las contribuciones son bienvenidas. Por favor:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto es privado y de uso exclusivo para Summit Trampoline Park.

## 👥 Autor

Desarrollado para Summit Trampoline Park

---

**Nota**: Este es un proyecto en desarrollo activo.
