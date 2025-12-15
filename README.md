# MotoDoctor.mx  
## Sistema Web de Gestión de Citas para Taller Mecánico

### Descripción General
MotoDoctor.mx es un sistema web desarrollado para la gestión de citas de mantenimiento y reparación de motocicletas. El sistema permite a los clientes registrar citas en línea y al personal administrativo gestionarlas de manera eficiente mediante un panel de administración.

El proyecto fue desarrollado como parte de un trabajo académico, aplicando conceptos de sistemas de información, administración de servicios de TI y desarrollo web.

---

## Objetivo del Sistema
Desarrollar una plataforma digital que permita:
- Registrar citas de clientes de manera ordenada.
- Administrar citas desde un panel seguro.
- Controlar el estado de cada cita.
- Mejorar la organización y atención al cliente del taller.

---

## Funcionalidades Principales

### Usuario (Cliente)
- Registro de citas en línea.
- Captura de datos del cliente y de la motocicleta.
- Selección de fecha, hora y tipo de servicio.
- Confirmación visual del registro de la cita.
- Notificación por correo electrónico (opcional).

### Administrador
- Inicio de sesión seguro.
- Visualización de todas las citas registradas.
- Cambio de estado de citas (Pendiente, Entregado, Cancelado).
- Eliminación de citas.
- Consulta del historial de servicios por motocicleta.
- Exportación de citas a archivo Excel.
- Visualización de estadísticas mediante gráficas.

---

## Tecnologías Utilizadas
- **Lenguaje de programación:** PHP
- **Base de datos:** MySQL / MariaDB
- **Frontend:** HTML5, CSS3, Bootstrap 5
- **Librerías:** Chart.js, DataTables
- **Control de versiones:** Git y GitHub
- **Servidor local:** XAMPP

---


## Requisitos del Sistema
- PHP 7.4 o superior
- MySQL o MariaDB
- Navegador web moderno
- Servidor local (XAMPP recomendado)

---

## Instalación
1. Clonar el repositorio desde GitHub.
2. Copiar el proyecto en la carpeta `htdocs` de XAMPP.
3. Importar la base de datos desde el archivo SQL incluido.
4. Configurar la conexión a la base de datos en `conexion.php`.
5. Iniciar Apache y MySQL.
6. Acceder al sistema desde el navegador.

---

## Roles del Sistema
- **Administrador:** Gestión total del sistema y las citas.
- **Usuario:** Registro de citas.

---

## Consideraciones de Seguridad
- Uso de sesiones para control de acceso.
- Validación de datos del lado del servidor.
- Separación de funciones administrativas.
- Uso de roles para control de permisos.

---

## Mejoras Futuras
- Edición de citas.
- Manejo avanzado de usuarios y roles.
- Implementación de hosting y dominio.
- Envío de notificaciones automáticas.
- Respaldo automático de la base de datos.

---

## Autores
**Aarón Molina de la Cruz**
**Pedro Alejandro Diaz Hernandes**
**Omar Alejandro Garcia Sanchez**
Proyecto académico – Consultoría Tecnológica  
2025