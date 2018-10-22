show databases;

drop database if exists sistema_de_comida;

create database sistema_de_comida;

use sistema_de_comida;

create table Localidad (
	id int primary key,
	descripcion varchar(30)
);

create table Telefono (
	id int primary key,
	numero varchar(30)
);

create table Usuario (
	id int primary key,
	nombre varchar(30) not null,
	apellido varchar(30) not null,
	email varchar(50) not null,
	contrasenia varchar(32) not null,
	id_telefono int,
	CONSTRAINT FK_USUARIO_TELEFONO FOREIGN KEY (id_telefono) REFERENCES Telefono(id)
);

create table Cliente (
	id int primary key,
	calle varchar(30) not null,
	numero varchar(30) not null,
	id_localidad int,
    id_usuario int not null,
    CONSTRAINT FK_CLIENTE_USER FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
	CONSTRAINT FK_USUARIO_LOCALIDAD FOREIGN KEY (id_localidad) REFERENCES Localidad(id)
);

create table Repartidor (
	id int primary key,
	fecha_nacimiento date not null,
	dni varchar(8) not null,
	cuil varchar(11) not null,
    id_usuario int not null,
    CONSTRAINT FK_REPARTIDOR_USER FOREIGN KEY (id_usuario) REFERENCES Usuario(id)
);

create table Comercio (
	id int primary key,
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

create table Precio (
	id int primary key,
	valor double not null
);

create table Producto (
	id int primary key,
	descripcion varchar(50),
	id_precio int,
	CONSTRAINT FK_PRODUCTO_PRECIO FOREIGN KEY (id_precio) REFERENCES Precio(id)
);

create table Menu (
	id int primary key auto_increment,
	descripcion varchar(60),
	imagen varchar(80)
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

create table Oferta (
	id int primary key,
	fecha_inicio datetime not null,
	fecha_fin datetime not null,
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


insert into Menu(descripcion,imagen) 
values ('milanesa con ensalada de tomate y lechuga','./public/img/menu/menu01.jpg'),
	   ('pizza de muzarella','./public/img/menu/menu02.jpg'),
	   ('Hamburgueza completa con huevo','./public/img/menu/menu03.jpg'),
	   ('cortado con dos tostadas de jamon y queso','./public/img/menu/menu04.jpg');