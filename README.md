# 🏪 Sistema de Gestión – Tienda de Abarrotes

Sistema integral de gestión para una **Tienda de Abarrotes**, desarrollado como proyecto académico para la materia de **Bases de Datos**.

El sistema permite administrar de forma eficiente el **inventario**, las **ventas**, los **clientes**, los **empleados**, los **proveedores** y los **pagos a crédito**, utilizando una **base de datos relacional** y un **ORM implementado en PHP**.

---

## 🚀 Características Principales

### 📦 Gestión de Inventario
- Registro de productos de abarrotes
- Control de:
  - Nombre
  - Precio
  - Stock
- Asociación de productos con proveedores
- Actualización automática del inventario al realizar ventas

---

### 👥 Gestión de Usuarios
- Administración de clientes
- Gestión de empleados
- Relación directa entre clientes, empleados y ventas

---

### 🧾 Proceso de Venta
- Registro de ventas con:
  - Fecha
  - Cliente
  - Empleado
- Detalle de venta con:
  - Producto
  - Cantidad
  - Precio unitario
- Cálculo automático del total

---

### 💳 Pagos a Crédito
- Registro de ventas a crédito
- Control de pagos parciales
- Seguimiento de adeudos de clientes

---

## 🛠️ Tecnologías Utilizadas

### 🔧 Backend
- PHP
- Programación Orientada a Objetos (POO)
- ORM (Object Relational Mapping)

### 🗄️ Base de Datos
- MySQL / MariaDB
- SQL estándar
- Llaves primarias y foráneas
- Integridad referencial

### 🎨 Frontend
- HTML
- CSS
- PHP

---

## 📊 Arquitectura de la Base de Datos

La base de datos está diseñada bajo un **modelo relacional normalizado**, evitando redundancia y garantizando consistencia.

### 📋 Tablas Principales
- `cliente`
- `empleado`
- `proveedor`
- `producto`
- `venta`
- `detalle_venta`
- `pago_credito`

Cada tabla cuenta con su **llave primaria** y relaciones mediante **llaves foráneas**.

---

## 🔁 Implementación del ORM

El proyecto implementa un **ORM propio en PHP**, que permite mapear las tablas de la base de datos a **clases**, facilitando el acceso a los datos sin escribir SQL directamente en toda la aplicación.

---

### 📂 Estructura del ORM

```text
models/
├── Cliente.php
├── Empleado.php
├── Proveedor.php
├── Producto.php
├── Venta.php
├── DetalleVenta.php
└── PagoCredito.php
🧩 Mapeo Objeto–Relacional
Cada clase del ORM:

Representa una tabla

Contiene atributos equivalentes a los campos

Incluye métodos para:

Crear

Leer

Actualizar

Eliminar

🔗 Relaciones Manejadas
Cliente → Venta

Venta → DetalleVenta

Producto → DetalleVenta

Venta → PagoCredito

✅ Ventajas del ORM
Código limpio y mantenible

Separación de lógica y datos

Menor riesgo de errores SQL

Fácil escalabilidad

🔧 Instalación
📌 Requisitos
Apache

PHP 7.4+

MySQL / MariaDB

⚙️ Pasos
Colocar el proyecto en:

text
Copiar código
htdocs/ o www/
Crear la base de datos

Ejecutar:

sql
Copiar código
setup/schemas.sql
(Opcional):

sql
Copiar código
setup/seed.sql
Configurar:

text
Copiar código
config/database.php
Acceder desde el navegador:

text
Copiar código
http://localhost/tienda_abarrotes
