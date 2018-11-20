show databases;

drop database if exists sistema_de_comida;

create database sistema_de_comida;

use sistema_de_comida;

create table Localidad (
	id int primary key auto_increment,
	descripcion varchar(30)
);

-- create table Telefono (
-- 	id int primary key,
-- 	numero varchar(30)
-- );

create table Usuario (
	id int primary key auto_increment,
	nombre varchar(30) not null,
	apellido varchar(30) not null,
	email varchar(50) not null unique,
	contrasenia varchar(60) not null,
	telefono varchar(30),
	habilitado smallint not null default 0
	-- id_telefono int,
	-- CONSTRAINT FK_USUARIO_TELEFONO FOREIGN KEY (id_telefono) REFERENCES Telefono(id)
);

create table Cliente (
	-- id int primary key auto_increment,
	id_usuario int primary key,
	calle varchar(30) not null,
	numero varchar(30) not null,
	id_localidad int,
    CONSTRAINT FK_CLIENTE_USER FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
	CONSTRAINT FK_USUARIO_LOCALIDAD FOREIGN KEY (id_localidad) REFERENCES Localidad(id)
);

create table Repartidor (
	id_usuario int primary key,
	fecha_nacimiento date default '19870529',
	dni varchar(8) not null,
	cuil varchar(11) not null,
	estado int(1) default 0,
    CONSTRAINT FK_REPARTIDOR_USER FOREIGN KEY (id_usuario) REFERENCES Usuario(id)
);

create table Comercio (
	id_comercio int primary key,
	cuit varchar(11) not null,
	CONSTRAINT FK_COMERCIO_USER FOREIGN KEY (id_comercio) REFERENCES Usuario(id)
);

create table Gerente (
	id int primary key,
	id_usuario int not null,
	id_comercio int not null,
	CONSTRAINT FK_GERENTE_USER FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
	CONSTRAINT FK_COMERCIO_ADMIN FOREIGN KEY (id_comercio) REFERENCES Comercio(id_comercio)
);

create table Administrador (
	id_usuario int primary key,
	usuario varchar(20) not null,
	CONSTRAINT FK_ADMIN_USER FOREIGN KEY (id_usuario) REFERENCES Usuario(id)
);

-- create table Sucursal (
-- 	id int primary key,
-- 	cuit varchar(11),
-- 	id_comercio int not null,
-- 	CONSTRAINT FK_SUCURSAL_COMERCIO FOREIGN KEY (id_comercio) REFERENCES Comercio(id_comercio)
-- );

-- create table Precio (
-- 	id int primary key auto_increment,
-- 	valor double not null
-- );

create table Producto (
	id int primary key auto_increment,
	descripcion varchar(50)
	-- id_precio int,
	-- CONSTRAINT FK_PRODUCTO_PRECIO FOREIGN KEY (id_precio) REFERENCES Precio(id)
);

create table Menu (
	id int primary key auto_increment,
	descripcion varchar(60),
	imagen varchar(80),
	precio double not null,
	id_comercio int,
	CONSTRAINT FK_COMERCIO_ID FOREIGN KEY (id_comercio) REFERENCES Comercio(id_comercio)
);

create table Productos_Menu (
	id_producto int,
	id_menu int,
	CONSTRAINT FK_PRODUCTO_ID FOREIGN KEY (id_producto) REFERENCES Producto(id),
	CONSTRAINT FK_MENU_ID FOREIGN KEY (id_menu) REFERENCES Menu(id)
);

create table Pedido (
	id int primary key auto_increment,
	-- id_sucursal int,
	id_comercio int,
	id_cliente int,
	fecha_alta DATE NOT NULL,
	hora_alta TIME not null,
	id_repartidor int,
	precio Double,
	estado int default 1,
	CONSTRAINT FK_PEDIDO_CLIENTE FOREIGN KEY (id_cliente) REFERENCES Cliente(id_usuario),
	-- CONSTRAINT FK_PEDIDO_SUCURSAL FOREIGN KEY (id_sucursal) REFERENCES Sucursal(id)
	CONSTRAINT FK_PEDIDO_COMERCIO FOREIGN KEY (id_comercio) REFERENCES Comercio(id_comercio),
	CONSTRAINT FK_PEDIDO_REPARTIDOR FOREIGN KEY (id_repartidor) REFERENCES Repartidor(id_usuario)
);


create table pedido_menus(
	id_pedido int,
	id_menu int,
	cantidad int default 1,
	primary key(id_pedido,id_menu),
	CONSTRAINT FK_PEDIDO_MENUS_MENU FOREIGN KEY (id_menu) REFERENCES Menu(id),
	CONSTRAINT FK_PEDIDO_MENUS_PEDIDO FOREIGN KEY (id_pedido) REFERENCES Pedido(id)
);

create table Entrega (
	id int not null,
	id_pedido int not null,
	fecha_retiro datetime not null,
	fecha_entrega datetime,
	CONSTRAINT PK_ID PRIMARY KEY (id, id_pedido),
	CONSTRAINT FK_ENTREGA_PEDIDO FOREIGN KEY (id_pedido) REFERENCES Pedido(id)
);

-- duran un dia
create table Oferta (
	id int primary key auto_increment,
	fecha date not null unique,
	id_menu int not null,
	CONSTRAINT FK_MENU_OFERTA FOREIGN KEY (id_menu) REFERENCES Menu(id)
);


INSERT INTO localidad(descripcion)
VALUES ('liniers'),
	   ('villa luzuriaga'),
	   ('casanova'),
	   ('ramos mejia'),
	   ('san justo');

insert into Usuario(nombre, apellido, email, contrasenia, telefono, habilitado ) values
('Alexander', 'Prada', 'notengoemail@gmail.com', 'alex123','',''),
('Christian', 'Peralta', 'notengoemail2@gmail.com', '$2y$10$oiAZLkt7DpnuLwEksfX4MeMqSilJuVLYuYvQjsxbD1hsLvW5sy0mu','',1),
('Martin', 'Garra', 'notengoemail3@gmail.com', 'martin123','',''),
('juan', 'Boliche', 'juan@hotmail.com', '$2y$10$0SxshydvVYCJwBKCpm5WQuAYABDa95HRaf7F9FlqwWWnUNKKYS2ke','46446645',1),
('eli', 'Pradas', 'eli@gmail.com', '$2y$10$KquJc6ZBXCcwFBeK7Tko/OZaBKpadpI5E040Hc/kQLJON8qGx1JqK','46446646',1),
('Luz', 'Moreno', 'luz@gmail.com', '$2y$10$C36nH6GzqlLOgq3xa7tVp.IEOzl6Z/RYTB94aeI6lXyNoqfshUeyq','46446647',1),
('Carrefour', '', 'carrefour@gmail.com', '$2y$10$LuSZKkymsBM8nuaqQiHU8OEQnENJYK2DfAPdqTNxEm9pud/KGIj3y','56446640',''),
('Jumbo', '', 'jumbo@gmail.com', '$2y$10$fxxdscKETA7vAp.XgPrux.rQQ/T8dCg5n1r4UiQKwDFKbcBsH3XxG','56446641',''),
('hugo', 'Perez', 'hugo@gmail.com', '$2y$10$eRs.y/W/9Bk6e.4aFcO/xexMHW9rv3gWtDzAuG1NEVW3CLCXYllQq','1560010001',''),
('Mario', 'Bros', 'mario@gmail.com', '$2y$10$H0f5M3gDfSP34Myp4TMm8ep5oC7C4km/jog2PbLg70z23Vn5WSLei','1560010001','');
-- 123


INSERT INTO repartidor(id_usuario, fecha_nacimiento, dni, cuil)
VALUES (9,'19900821','40320123','20403201231'),
	   (10,'20000115','45600120','20200001158');

INSERT INTO comercio(id_comercio,cuit)
VALUES(7,'401234567991'),
	  (8,'501234567994');

INSERT INTO cliente(id_usuario,calle,numero,id_localidad) 
VALUES (4,'las tunas','11122',1),
	   (5,'Arieta','546',2),
	   (6,'Belgrano','1704',4);

insert into Administrador(id_usuario, usuario) values
(1,'ap'),
(2,'ctn'),
(3,'mg');


insert into Menu(descripcion,imagen,precio,id_comercio) 
values ('pizza de muzarella','./public/img/menu/menu03.jpg',220,7),
	   ('Tostadas de jamon y queso','./public/img/menu/menu05.jpg',49.99,8),
	   ('Empanadas','./public/img/menu/menu06.jpg',180,8),
	   ('Saguchitos de miga','./public/img/menu/menu08.jpg',99.99,7);

INSERT INTO Oferta(fecha, id_menu) 
VALUES (CURDATE(), 1),
	   ("20181030", 2);

INSERT INTO pedido(id_comercio, id_cliente, fecha_alta, hora_alta, precio)
VALUES (7, 4, CURDATE() , '03:36:23', 859.98),
	   (8, 4, CURDATE() , '03:43:46', 720);


INSERT INTO pedido_menus(id_pedido, id_menu, cantidad)
VALUES (1, 1, 3),
	   (1, 4, 2),
	   (2, 3, 4);
-- create table Oferta (
-- 	id int primary key,
-- 	fecha_inicio datetime not null,
-- 	fecha_fin datetime not null,
-- 	id_menu int not null,
-- 	CONSTRAINT FK_MENU_OFERTA FOREIGN KEY (id_menu) REFERENCES Menu(id)
-- );

-- INSERT INTO Precio(valor)
-- VALUES (100.00),
-- 	   (90.00),
-- 	   (150.00);

-- INSERT INTO  Producto(descripcion,id_precio)
-- VALUES ('Queso',1),
-- 	   ('Harina',2),
-- 	   ('Morron',3),
-- 	   ('pan',2),
-- 	   ('Hamburguesa',3);

-- create table Precio (
-- 	id int primary key auto_increment,
-- 	valor double not null
-- );

-- create table Producto (
-- 	id int primary key auto_increment,
-- 	descripcion varchar(50),
-- 	id_precio int,
-- 	CONSTRAINT FK_PRODUCTO_PRECIO FOREIGN KEY (id_precio) REFERENCES Precio(id)
-- );