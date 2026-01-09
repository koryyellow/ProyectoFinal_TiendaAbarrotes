# 🛒 Sistema de Gestión – Tienda de Abarrotes

Sistema integral de gestión para una **Tienda de Abarrotes**, desarrollado como proyecto académico para la materia de **Bases de Datos**.

El sistema permite administrar de forma eficiente el **inventario**, las **ventas**, los **clientes**, los **empleados**, los **proveedores** y los **pagos a crédito**, utilizando una **base de datos relacional** y un **ORM implementado en PHP**.

---

## ✨ Características Principales

### 📦 Gestión de Inventario
- Registro de productos de abarrotes
- Control de información:
  - Nombre
  - Precio
  - Stock
- Asociación de productos con proveedores
- Actualización automática del inventario al realizar ventas

---

### 🔐 Acceso al Sistema
Al ingresar a la página principal, utiliza las siguientes credenciales:

- **Usuario:** `admin`
- **Contraseña:** `admin`

Una vez dentro del sistema, podrás **agregar, editar y eliminar información**, simulando la gestión real de una tienda de abarrotes.

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

## 🗂️ Arquitectura de la Base de Datos

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

## 🧪 Pruebas de la Página

<img width="1839" height="821" alt="Vista general" src="https://github.com/user-attachments/assets/f0e76057-9a58-41e8-8dba-5c632900cb0c" />

<img width="1468" height="796" alt="Gestión de productos" src="https://github.com/user-attachments/assets/8424e2b4-2032-4bba-be9f-f68804c377b2" />

<img width="1074" height="612" alt="Ventas" src="https://github.com/user-attachments/assets/df73ac13-37e2-4e29-b7af-52daa544aea2" />

<img width="1527" height="763" alt="Pagos a crédito" src="https://github.com/user-attachments/assets/e68f7bf9-b7be-41c7-973e-1745f3a07b38" />

---

## 🔁 Implementación del ORM

El proyecto implementa un **ORM propio en PHP**, que permite mapear las tablas de la base de datos a **clases**, facilitando el acceso a los datos sin escribir SQL directamente en toda la aplicación.

---

## 📂 Estructura del ORM

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
