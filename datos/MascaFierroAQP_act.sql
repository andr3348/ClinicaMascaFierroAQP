DROP TABLE IF EXISTS usuario CASCADE;
DROP TABLE IF EXISTS cita CASCADE;
DROP TABLE IF EXISTS pago CASCADE;
DROP TABLE IF EXISTS ficha_atencion CASCADE;
DROP TABLE IF EXISTS odontograma CASCADE;

-- Tabla usuario
CREATE TABLE usuario (
    id_usuario SERIAL PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    passw VARCHAR(255) NOT NULL,
    dni VARCHAR(8) UNIQUE NOT NULL,
    tipo_usuario VARCHAR(20) NOT NULL CHECK (tipo_usuario IN ('admin','secretaria','dentista','paciente'))
);

-- Cita
CREATE TABLE cita (
    id_cita SERIAL PRIMARY KEY,
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado VARCHAR(20) NOT NULL CHECK (estado IN ('pendiente','confirmada','cancelada')),
    descripcion VARCHAR(255),
    id_paciente int NOT NULL,
	id_dentista int NOT NULL,
	
	FOREIGN KEY (id_paciente) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
	FOREIGN KEY (id_dentista) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);

-- Pago
CREATE TABLE pago (
    id_pago SERIAL PRIMARY KEY,
    monto INT NOT NULL,
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_paciente INT NOT NULL,
    id_cita INT NOT NULL,
    FOREIGN KEY (id_paciente) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_cita) REFERENCES cita(id_cita) ON DELETE CASCADE
);

-- Ficha de atención
CREATE TABLE ficha_atencion (
    id_ficha SERIAL PRIMARY KEY,
    fecha DATE NOT NULL DEFAULT CURRENT_DATE,
    descripcion VARCHAR(255),
    id_paciente int NOT NULL,
	id_dentista int NOT NULL,

	FOREIGN KEY (id_paciente) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
	FOREIGN KEY (id_dentista) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);

-- Odontograma
CREATE TABLE odontograma (
    id_odontograma SERIAL PRIMARY KEY,
    imagen VARCHAR(255),
	fecha DATE NOT NULL DEFAULT CURRENT_DATE,
    id_paciente INT NOT NULL,
    id_dentista INT NOT NULL,
	id_cita INT NOT NULL,
    FOREIGN KEY (id_paciente) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_dentista) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
	FOREIGN KEY (id_cita) REFERENCES cita(id_cita) ON DELETE CASCADE
);

INSERT INTO usuario(nombre,correo,passw,dni,tipo_usuario)
VALUES ('Luis','lu2024is@hotmail.com','2938','60493758','paciente'),
		('Pedro','pedr20393@gmail.com','4759','48576894','admin'),
		('Maria','maria2020va@outlook.com','3322','25354693','secretaria'),
		('Alex','aleX0666@gmail.com','3hf3','28394856','dentista'),
		('Martin','mar44@outlook.com','39fj','39475018','paciente');

INSERT INTO cita(estado,descripcion,id_paciente,id_dentista)
VALUES ('pendiente','Chequeo y limpieza profunda de muelas',1,4),
		('confirmada','Limpieza de muelas',5,4);


SELECT * FROM pago;
SELECT * FROM odontograma;
SELECT * FROM usuario;
SELECT id_usuario, nombre, correo, passw, dni, tipo_usuario
                    FROM usuario WHERE tipo_usuario = 'dentista';