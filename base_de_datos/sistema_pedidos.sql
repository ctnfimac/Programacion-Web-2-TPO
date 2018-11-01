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
	email varchar(50) not null,
	contrasenia varchar(32) not null,
	telefono varchar(30)
	-- id_telefono int,
	-- CONSTRAINT FK_USUARIO_TELEFONO FOREIGN KEY (id_telefono) REFERENCES Telefono(id)
);

create table Cliente (
	id int primary key auto_increment,
	calle varchar(30) not null,
	numero varchar(30) not null,
	id_localidad int,
    id_usuario int not null,
    CONSTRAINT FK_CLIENTE_USER FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
	CONSTRAINT FK_USUARIO_LOCALIDAD FOREIGN KEY (id_localidad) REFERENCES Localidad(id)
);

create table Repartidor (
	id int primary key auto_increment,
	fecha_nacimiento date not null,
	dni varchar(8) not null,
	cuil varchar(11) not null,
    id_usuario int not null,
    CONSTRAINT FK_REPARTIDOR_USER FOREIGN KEY (id_usuario) REFERENCES Usuario(id)
);

create table Comercio (
	id int primary key auto_increment,
	cuit varchar(11) not null
);

create table Gerente (
	id int primary key,
	id_usuario int not null,
	id_comercio int not null,
	CONSTRAINT FK_GERENTE_USER FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
	CONSTRAINT FK_COMERCIO_ADMIN FOREIGN KEY (id_comercio) REFERENCES Comercio(id)
);

create table Admin (
	id int primary key,
	id_usuario int not null,
	CONSTRAINT FK_ADMIN_USER FOREIGN KEY (id_usuario) REFERENCES Usuario(id)
);

create table Sucursal (
	id int primary key,
	cuit varchar(11),
	id_comercio int not null,
	CONSTRAINT FK_SUCURSAL_COMERCIO FOREIGN KEY (id_comercio) REFERENCES Comercio(id)
);

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
	precio double
);

create table Productos_Menu (
	id_producto int,
	id_menu int,
	CONSTRAINT FK_PRODUCTO_ID FOREIGN KEY (id_producto) REFERENCES Producto(id),
	CONSTRAINT FK_MENU_ID FOREIGN KEY (id_menu) REFERENCES Menu(id)
);

create table Pedido (
	id int primary key,
	id_sucursal int,
	id_cliente int,
	id_menu int,
	CONSTRAINT FK_PEDIDO_MENU FOREIGN KEY (id_menu) REFERENCES Menu(id),
	CONSTRAINT FK_PEDIDO_CLIENTE FOREIGN KEY (id_menu) REFERENCES Cliente(id),
	CONSTRAINT FK_PEDIDO_SUCURSAL FOREIGN KEY (id_sucursal) REFERENCES Sucursal(id)
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
	-- fecha_fin datetime not null,
	id_menu int not null,
	CONSTRAINT FK_MENU_OFERTA FOREIGN KEY (id_menu) REFERENCES Menu(id)
);

insert into Usuario(id, nombre, apellido, email, contrasenia) values
(1, 'Alexander', 'Prada', 'notengoemail@gmail.com', 'alex123'),
(2, 'Christian', 'Peralta', 'notengoemail2@gmail.com', 'christian123'),
(3, 'Martin', 'Garra', 'notengoemail3@gmail.com', 'martin123');

insert into Admin(id, id_usuario) values
(1, 1),
(2, 2),
(3, 3);


insert into Menu(descripcion,imagen,precio) 
values ('pizza de muzarella','./public/img/menu/menu02.jpg',220),
	   ('Tostadas de jamon y queso','./public/img/menu/menu04.jpg',49.99),
	   ('Empanadas','./public/img/menu/menu07.jpg',180),
	   ('Saguchitos de miga','./public/img/menu/menu08.jpg',99.99);

INSERT INTO Oferta(fecha, id_menu) 
VALUES ("20181101", 1),
	   ("20181030", 2);

INSERT INTO localidad(descripcion)
VALUES ('liniers'),
	   ('villa luzuriaga'),
	   ('casanova'),
	   ('ramos mejia'),
	   ('san justo');
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