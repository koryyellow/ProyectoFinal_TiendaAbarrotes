CREATE TABLE IF NOT EXISTS cliente (
  id_cliente INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  telefono VARCHAR(20),
  direccion VARCHAR(150)
);

CREATE TABLE IF NOT EXISTS empleado (
  id_empleado INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS proveedor (
  id_proveedor INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  telefono VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS producto (
  id_producto INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  precio DECIMAL(10,2),
  id_proveedor INT,
  FOREIGN KEY (id_proveedor) REFERENCES proveedor(id_proveedor)
);

CREATE TABLE IF NOT EXISTS venta (
  id_venta INT AUTO_INCREMENT PRIMARY KEY,
  fecha DATE,
  id_cliente INT,
  id_empleado INT,
  forma_pago VARCHAR(50),
  FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente),
  FOREIGN KEY (id_empleado) REFERENCES empleado(id_empleado)
);

CREATE TABLE IF NOT EXISTS detalle_venta (
  id_detalle INT AUTO_INCREMENT PRIMARY KEY,
  id_venta INT,
  id_producto INT,
  cantidad INT,
  FOREIGN KEY (id_venta) REFERENCES venta(id_venta),
  FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
);

CREATE TABLE IF NOT EXISTS pago_credito (
  id_pago INT AUTO_INCREMENT PRIMARY KEY,
  id_venta INT,
  fecha_pago DATE,
  monto DECIMAL(10,2),
  saldo_restante DECIMAL(10,2),
  FOREIGN KEY (id_venta) REFERENCES venta(id_venta)
);

CREATE TABLE IF NOT EXISTS login (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE,
  password VARCHAR(255)
);
