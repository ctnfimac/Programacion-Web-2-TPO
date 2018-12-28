show databases;

drop database if exists sistema_de_comida;

create database sistema_de_comida;

use sistema_de_comida;

create table Localidad (
	id int primary key auto_increment,
	descripcion varchar(30)
);

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
-- 	id int primary key auto_increment,
-- 	calle varchar(30) not null,
-- 	numero varchar(30) not null,
-- 	id_comercio int not null,
-- 	id_localidad int,
-- 	CONSTRAINT FK_SUCURSAL_LOCALIDAD FOREIGN KEY (id_localidad) REFERENCES Localidad(id),
-- 	CONSTRAINT FK_SUCURSAL_COMERCIO FOREIGN KEY (id_comercio) REFERENCES Comercio(id_comercio)
-- );

create table Producto (
	id int primary key auto_increment,
	descripcion varchar(50)
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

create table pedido(
	id int primary key auto_increment,
	comercio varchar(30) NOT NULL,
	cliente varchar(30) NOT NULL,
	fecha_alta DATE not null,
	hora_alta TIME not null,
	repartidor varchar(30),
	penalizado decimal(6,2) default 0,
	estado int default 1,
	precio Double
);

create table pedido_menus(
	id int,
	menu varchar(60),
	imagen varchar(80),
	precio Double,
	cantidad int default 1,
	primary key(id,menu),
	CONSTRAINT FK_REGISTRO_DE_PEDIDO_CONTENIDO FOREIGN KEY (id) REFERENCES pedido(id)
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

create table liquidacion(
	id int primary key auto_increment,
	periodo_pago Date not null,
	remuneracion decimal(9,2),
	descuento decimal(9,2),
	neto decimal(9,2),
	id_usuario int,
	CONSTRAINT FK_LIQUIDACION_USUARIO FOREIGN KEY (id_usuario) REFERENCES Usuario(id)
);


create table ganancia(
	id int primary key auto_increment,
	fecha Date not null unique,
	monto decimal(9,2)
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
values ('pizza de muzarella','./public/img/menu/menu02.jpg',220,7),
	   ('Tostadas de jamon y queso','./public/img/menu/menu04.jpg',50,8),
	   ('Empanadas','./public/img/menu/menu07.jpg',200,8),
	   ('Sanguchitos de miga','./public/img/menu/menu08.jpg',100,7),
	   ('Panchos','./public/img/menu/menu06.jpg',150,8),
	   ('Asado','./public/img/menu/menu05.jpg',300,7);

INSERT INTO Oferta(fecha, id_menu) 
VALUES (CURDATE(), 3),
	   ("20181030", 2);

INSERT INTO pedido(comercio,cliente,fecha_alta,hora_alta,repartidor,estado,precio)
VALUES ('Carrefour','Luz','2018-06-11', '22:15:30','hugo', 3, 540),
	   ('Carrefour','eli', '2018-06-11', '22:00:00','hugo', 3, 880),
	   ('Jumbo','juan','2018-06-11', '22:10:00','mario', 3, 200),
	   ('Carrefour','eli','2018-09-11', '12:15:45','hugo', 3, 820),
 	   ('Carrefour','luz','2018-09-12', '23:10:30','hugo', 3, 1320),
	   ('Jumbo','juan','2018-09-12', '20:05:00','mario', 3, 700),
	   ('Jumbo','juan','2018-10-20', '13:07:10','mario', 3, 200),
	   ('Jumbo','luz','2018-10-20', '13:06:02','hugo', 3, 1000),
	   ('Jumbo','eli','2018-10-20', '21:45:55','mario', 3, 800),
	   ('Carrefour','eli','2018-10-30', '21:25:30','mario', 3, 1100),

	   ('Carrefour','Luz','2018-11-02', '22:15:30','mario', 3, 540),
	   ('Carrefour','eli', '2018-11-11', '22:00:00','hugo', 3, 880),
	   ('Jumbo','juan','2018-11-09', '22:10:00','mario', 3, 200),
	   ('Carrefour','eli','2018-11-11', '12:15:45','hugo', 3, 820),
 	   ('Carrefour','luz','2018-11-12', '23:10:30','hugo', 3, 1320),
	   ('Jumbo','juan','2018-11-12', '20:05:00','mario', 3, 700),

	   ('Carrefour','Luz','2018-11-05', '22:15:30','mario', 3, 840),
	   ('Carrefour','eli', '2018-11-06', '22:00:00','hugo', 3, 2200),
	   ('Jumbo','juan','2018-11-17', '22:10:00','mario', 3, 500),
	   ('Carrefour','eli','2018-11-20', '12:15:45','hugo', 3, 2500),
 	   ('Carrefour','luz','2018-11-17', '23:10:30','hugo', 3, 4400),
	   ('Jumbo','juan','2018-11-17', '20:05:00','mario', 3, 2750),

	   ('Carrefour','luz','2018-12-12', '23:10:30','hugo', 3, 2220),
	   ('Jumbo','juan','2018-12-12', '20:05:00','mario', 3, 1400),
	   ('Jumbo','juan','2018-12-20', '13:07:10','mario', 3, 1000),
	   ('Jumbo','luz','2018-12-20', '13:06:02','hugo', 3, 1600),
	   ('Jumbo','eli','2018-12-20', '21:45:55','mario', 3, 2300),
	   ('Carrefour','eli','2018-12-30', '21:25:30','mario', 3, 4400);

INSERT INTO pedido_menus()
VALUES (1,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,2),
	   (1,'Sanguchitos de miga','./public/img/pedidos/menu08.jpg',100,1),
	   (2,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,4),
	   (3,'Panchos','./public/img/pedidos/menu06.jpg',150,1),
	   (3,'Tostadas de jamon y queso','./public/img/pedidos/menu04.jpg',50,1),
	   (4,'Asado','./public/img/pedidos/menu05.jpg',300,1),
	   (4,'Sanguchitos de miga','./public/img/pedidos/menu08.jpg',100,3),
	   (4,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,1),
	   (5,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,6),
	   (6,'Panchos','./public/img/pedidos/menu06.jpg',150,3),
	   (6,'Empanadas','./public/img/pedidos/menu07.jpg',200,2),
	   (7,'Tostadas de jamon y queso','./public/img/pedidos/menu04.jpg',50,4),
	   (8,'Empanadas','./public/img/pedidos/menu07.jpg',200,5),
	   (9,'Panchos','./public/img/pedidos/menu06.jpg',150,2),
	   (9,'Tostadas de jamon y queso','./public/img/pedidos/menu04.jpg',50,6),
	   (9,'Empanadas','./public/img/pedidos/menu07.jpg',200,1),
	   (10,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,5),

	   (11,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,3),
	   (11,'Sanguchitos de miga','./public/img/pedidos/menu08.jpg',100,2),
	   (12,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,10),
	   (13,'Panchos','./public/img/pedidos/menu06.jpg',150,1),
	   (13,'Tostadas de jamon y queso','./public/img/pedidos/menu04.jpg',50,1),
	   (14,'Asado','./public/img/pedidos/menu05.jpg',300,1),
	   (14,'Sanguchitos de miga','./public/img/pedidos/menu08.jpg',100,3),
	   (14,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,1),
	   (15,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,6),
	   (16,'Panchos','./public/img/pedidos/menu06.jpg',150,3),
	   (16,'Empanadas','./public/img/pedidos/menu07.jpg',200,2),

	   (17,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,2),
	   (17,'Sanguchitos de miga','./public/img/pedidos/menu08.jpg',100,1),
	   (18,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,4),
	   (19,'Panchos','./public/img/pedidos/menu06.jpg',150,2),
	   (19,'Tostadas de jamon y queso','./public/img/pedidos/menu04.jpg',50,4),
	   (20,'Asado','./public/img/pedidos/menu05.jpg',300,3),
	   (20,'Sanguchitos de miga','./public/img/pedidos/menu08.jpg',100,5),
	   (20,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,5),
	   (21,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,20),
	   (22,'Panchos','./public/img/pedidos/menu06.jpg',150,5),
	   (22,'Empanadas','./public/img/pedidos/menu07.jpg',200,10),


	   
	   
	   (23,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,10),
	   (24,'Panchos','./public/img/pedidos/menu06.jpg',150,4),
	   (24,'Empanadas','./public/img/pedidos/menu07.jpg',200,4),
	   (25,'Tostadas de jamon y queso','./public/img/pedidos/menu04.jpg',50,20),
	   (26,'Empanadas','./public/img/pedidos/menu07.jpg',200,8),
	   (27,'Panchos','./public/img/pedidos/menu06.jpg',150,8),
	   (27,'Tostadas de jamon y queso','./public/img/pedidos/menu04.jpg',50,10),
	   (27,'Empanadas','./public/img/pedidos/menu07.jpg',200,3),
	   (28,'pizza de muzarella','./public/img/pedidos/menu02.jpg',220,20);

