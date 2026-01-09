🏪 Sistema de Gestión – Tienda de Abarrotes

Este proyecto corresponde a un Sistema Integral de Gestión para una Tienda de Abarrotes, desarrollado como proyecto académico para la materia de Bases de Datos.
El sistema permite administrar de forma eficiente el inventario, las ventas, los clientes, los empleados, los proveedores y los pagos a crédito, apoyándose en una base de datos relacional y un modelo ORM implementado en PHP.

🚀 Características Principales
📦 Gestión de Inventario

Registro y administración de productos de abarrotes:

Nombre

Precio

Stock

Asociación de productos con proveedores.

Actualización automática del inventario al realizar ventas.

👥 Gestión de Usuarios

Administración de clientes con datos personales y de contacto.

Gestión de empleados responsables de las ventas.

Relación directa entre clientes, empleados y ventas.

🧾 Proceso de Venta

Registro de ventas con:

Fecha

Cliente

Empleado

Manejo de detalles de venta:

Producto

Cantidad

Precio unitario

Cálculo automático del total de la venta.

💳 Pagos a Crédito

Registro de ventas a crédito.

Control de pagos parciales mediante abonos.

Seguimiento del estado de adeudos de los clientes.

🛠️ Tecnologías Utilizadas
Backend

PHP

Programación Orientada a Objetos (POO)

Patrón de diseño ORM (Object Relational Mapping)

Base de Datos

MySQL / MariaDB

SQL estándar

Llaves primarias y foráneas

Integridad referencial

Frontend

HTML

CSS

Integración directa con PHP

📊 Arquitectura de la Base de Datos

La base de datos está diseñada bajo un modelo relacional normalizado, evitando redundancia y garantizando consistencia de los datos.

Tablas principales:

cliente

empleado

proveedor

producto

venta

detalle_venta

pago_credito

Cada tabla cuenta con su llave primaria y las relaciones necesarias mediante llaves foráneas, lo que asegura la integridad de la información en el sistema.

🔁 Implementación del ORM (Object Relational Mapping)

El proyecto implementa un ORM propio en PHP, el cual permite mapear las tablas de la base de datos a clases del sistema, facilitando el acceso y manipulación de los datos sin depender directamente de consultas SQL en toda la aplicación.

📂 Estructura del ORM

El ORM se organiza principalmente en la carpeta:

models/


Cada archivo dentro de esta carpeta representa una entidad del sistema, por ejemplo:

Cliente.php

Empleado.php

Proveedor.php

Producto.php

Venta.php

DetalleVenta.php

PagoCredito.php

🧩 Mapeo Objeto–Relacional

Cada clase del ORM:

Representa una tabla de la base de datos.

Sus atributos corresponden a los campos de la tabla.

Contiene métodos para:

Insertar registros

Consultar datos

Actualizar información

Eliminar registros

Ejemplo conceptual:

La clase Producto se relaciona con la tabla producto

La clase Venta se relaciona con la tabla venta

La clase DetalleVenta permite manejar la relación entre ventas y productos

🔗 Manejo de Relaciones

El ORM permite manejar relaciones entre tablas como:

Cliente → Venta

Venta → Detalle de Venta

Producto → Detalle de Venta

Venta → Pago a Crédito

Estas relaciones se gestionan mediante IDs como llaves foráneas, las cuales son manipuladas desde los modelos PHP, manteniendo la coherencia entre la lógica del sistema y la base de datos.

✅ Ventajas del ORM en el Proyecto

Separación entre la lógica de negocio y el acceso a datos.

Código más ordenado y mantenible.

Reducción de errores en consultas SQL.

Facilita futuras modificaciones a la base de datos.

Mejor comprensión del modelo relacional a través de clases.

🔧 Instalación y Configuración
Requisitos Previos

Apache

PHP 7.4 o superior

MySQL / MariaDB

Pasos

Colocar el proyecto en:

htdocs/ o www/


Crear la base de datos.

Ejecutar el script:

setup/schemas.sql


(Opcional) Ejecutar:

setup/seed.sql


Configurar la conexión en:

config/database.php


Acceder desde el navegador:

http://localhost/tienda_abarrotes



Implementación de un ORM

Desarrollo de un sistema funcional para una tienda de abarrotes
