CREATE TABLE profesor (
    id_profesor SERIAL PRIMARY KEY,
    numero_identificacion BIGINT NOT NULL UNIQUE, 
    nombre VARCHAR(20) NOT NULL,
    nombre_2 VARCHAR(20),
    apellido VARCHAR(20) NOT NULL,
    apellido_2 VARCHAR(20)
);

CREATE TABLE estudiante (
    id_estudiante SERIAL PRIMARY KEY,
    numero_identificacion BIGINT NOT NULL UNIQUE, 
    nombre VARCHAR(20) NOT NULL,
    nombre_2 VARCHAR(20),
    apellido VARCHAR(20) NOT NULL,
    apellido_2 VARCHAR(20)
);

CREATE TABLE permiso (
    id_permiso SERIAL PRIMARY KEY,
    crear BOOLEAN NOT NULL DEFAULT FALSE,
    leer BOOLEAN NOT NULL DEFAULT FALSE,
    actualizar BOOLEAN NOT NULL DEFAULT FALSE,
    borrar BOOLEAN NOT NULL DEFAULT FALSE,
    leer_nota BOOLEAN NOT NULL DEFAULT FALSE,
    actualizar_nota BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE usuario (
    id_usuario SERIAL PRIMARY KEY,
    correo VARCHAR(100) NOT NULL UNIQUE CHECK (correo LIKE '%@%'),
    contrasena TEXT NOT NULL DEFAULT '12345'
);

CREATE TABLE tipo_proyecto (
    id_tipo_proyecto SERIAL PRIMARY KEY,
    tipo_proyecto VARCHAR(8) NOT NULL
);

CREATE TABLE tipo_entregable (
    id_tipo_entregable SERIAL PRIMARY KEY,
    tipo_entregable VARCHAR(30) NOT NULL,
    descripcion TEXT NOT NULL
);

CREATE TABLE linea_de_investigacion (
    id_linea SERIAL PRIMARY KEY,
    linea_investigacion VARCHAR(30) NOT NULL,
    descripcion TEXT NOT NULL
);

CREATE TABLE tipo_insumo (
    id_insumo SERIAL PRIMARY KEY,
    tipo_insumo VARCHAR(30),
    valor INT
);

CREATE TABLE pais (
    id_pais INT PRIMARY KEY NOT NULL,
    pais VARCHAR(20) NOT NULL
);

CREATE TABLE taller_transito (
    id_taller SERIAL PRIMARY KEY NOT NULL,
    nombre VARCHAR(20) NOT NULL
);

CREATE TABLE proyecto (
    id_proyecto SERIAL PRIMARY KEY,
    id_tipo INT NOT NULL,
    titulo VARCHAR(50) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_inscripcion DATE NOT NULL,
    FOREIGN KEY (id_tipo) REFERENCES tipo_proyecto(id_tipo_proyecto)
);

CREATE TABLE entregable (
    id_entregable SERIAL PRIMARY KEY,
    id_tipo_entregable INT NOT NULL,
    descripcion TEXT NOT NULL,
    FOREIGN KEY (id_tipo_entregable) REFERENCES tipo_entregable(id_tipo_entregable)
);

CREATE TABLE rol (
    id_rol SERIAL PRIMARY KEY,
    rol VARCHAR(50) NOT NULL,
    id_permiso INT NOT NULL,
    FOREIGN KEY (id_permiso) REFERENCES permiso(id_permiso)
);

CREATE TABLE evaluador (
    id_evaluador SERIAL PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL,
    nombre_2 VARCHAR(20),
    apellido VARCHAR(20) NOT NULL,
    apellido_2 VARCHAR(20),
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

CREATE TABLE region (
    id_region INT PRIMARY KEY NOT NULL,
    region VARCHAR(20) NOT NULL,
    id_pais INT NOT NULL,
    FOREIGN KEY (id_pais) REFERENCES pais(id_pais)
);

CREATE TABLE municipio (
    id_municipio INT PRIMARY KEY NOT NULL,
    municipio VARCHAR(20) NOT NULL,
    id_region INT NOT NULL,
    FOREIGN KEY (id_region) REFERENCES region(id_region)
);

CREATE TABLE evaluacion (
    id_evaluacion SERIAL PRIMARY KEY,
    id_proyecto INT NOT NULL,
    id_evaluador INT NOT NULL,
    observacion TEXT NOT NULL,
    criterio1 NUMERIC(5,2) NOT NULL DEFAULT 0 CHECK (criterio1 >= 0 AND criterio1 <= 5),
    criterio2 NUMERIC(5,2) NOT NULL DEFAULT 0 CHECK (criterio2 >= 0 AND criterio2 <= 5),
    criterio3 NUMERIC(5,2) NOT NULL DEFAULT 0 CHECK (criterio3 >= 0 AND criterio3 <= 5),
    criterio4 NUMERIC(5,2) NOT NULL DEFAULT 0 CHECK (criterio4 >= 0 AND criterio4 <= 5),
    criterio5 NUMERIC(5,2) NOT NULL DEFAULT 0 CHECK (criterio5 >= 0 AND criterio5 <= 5),
    criterio6 NUMERIC(5,2) NOT NULL DEFAULT 0 CHECK (criterio6 >= 0 AND criterio6 <= 5),
    criterio7 NUMERIC(5,2) NOT NULL DEFAULT 0 CHECK (criterio7 >= 0 AND criterio7 <= 5),
    criterio8 NUMERIC(5,2) NOT NULL DEFAULT 0 CHECK (criterio8 >= 0 AND criterio8 <= 5),
    criterio9 NUMERIC(5,2) NOT NULL DEFAULT 0 CHECK (criterio9 >= 0 AND criterio9 <= 5),
    criterio10 NUMERIC(5,2) NOT NULL DEFAULT 0 CHECK (criterio10 >= 0 AND criterio10 <= 5),
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    resultado NUMERIC(5,2) NOT NULL DEFAULT 0 CHECK (resultado >= 0 AND resultado <= 5),
    FOREIGN KEY (id_proyecto) REFERENCES proyecto(id_proyecto),
    FOREIGN KEY (id_evaluador) REFERENCES evaluador(id_evaluador)
);

CREATE TABLE universidad (
    id_universidad SERIAL PRIMARY KEY,
    id_municipio INT NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    sede VARCHAR(30),
    FOREIGN KEY (id_municipio) REFERENCES municipio(id_municipio)
);

CREATE TABLE facultad (
    id_facultad SERIAL PRIMARY KEY NOT NULL,
    nombre VARCHAR(20) NOT NULL,
    id_universidad INT NOT NULL,
    FOREIGN KEY (id_universidad) REFERENCES universidad(id_universidad)
);

CREATE TABLE departamento (
    id_departamento SERIAL PRIMARY KEY NOT NULL,
    nombre VARCHAR(60) NOT NULL,
    id_facultad INT NOT NULL,
    FOREIGN KEY (id_facultad) REFERENCES facultad(id_facultad)
);

CREATE TABLE programa_academico (
    id_programa SERIAL PRIMARY KEY,
    nombre_programa VARCHAR(100) NOT NULL,
    id_departamento INT NOT NULL,
    FOREIGN KEY (id_departamento) REFERENCES departamento(id_departamento)
);

CREATE TABLE asignatura (
    id_asignatura SERIAL PRIMARY KEY,
    id_programa INT NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    nivel_estudio VARCHAR(10) NOT NULL CHECK (nivel_estudio IN ('Pregrado', 'Posgrado')),
    nivel_formacion VARCHAR(20) NOT NULL,
    ciencias VARCHAR(20) NOT NULL,
    modalidad VARCHAR(20) NOT NULL,
    FOREIGN KEY (id_programa) REFERENCES programa_academico(id_programa)
);

CREATE TABLE grupo (
    id_grupo SERIAL PRIMARY KEY,
    id_asignatura INT NOT NULL,
    id_profesor INT NOT NULL,
    numero_grupo INT NOT NULL,
    FOREIGN KEY (id_asignatura) REFERENCES asignatura(id_asignatura),
    FOREIGN KEY (id_profesor) REFERENCES profesor(id_profesor)
);

CREATE TABLE era (
    id_era SERIAL PRIMARY KEY,
    id_asignatura INT NOT NULL,
    descripcion TEXT NOT NULL,
    FOREIGN KEY (id_asignatura) REFERENCES asignatura(id_asignatura)
);

CREATE TABLE ira (
    id_ira SERIAL PRIMARY KEY,
    id_asignatura INT NOT NULL,
    descripcion TEXT,
    FOREIGN KEY (id_asignatura) REFERENCES asignatura(id_asignatura)
);

CREATE TABLE rep (
    id_rep SERIAL PRIMARY KEY,
    id_proyecto INT NOT NULL,
    descripcion TEXT,
    FOREIGN KEY (id_proyecto) REFERENCES proyecto(id_proyecto)
);

CREATE TABLE prestamo_insumo (
    id_prestamo SERIAL PRIMARY KEY,
    id_insumo INT NOT NULL,
    id_proyecto INT NOT NULL,
    id_universidad INT NOT NULL,
    fecha_entrega DATE NOT NULL,
    fecha_aprox_devolucion DATE NOT NULL CHECK (fecha_aprox_devolucion >= fecha_entrega),
    fecha_devolucion DATE,
    descripcion_estado VARCHAR(64) DEFAULT 'Sin observaciones',
    FOREIGN KEY (id_insumo) REFERENCES tipo_insumo(id_insumo),
    FOREIGN KEY (id_proyecto) REFERENCES proyecto(id_proyecto),
    FOREIGN KEY (id_universidad) REFERENCES universidad(id_universidad)
);

CREATE TABLE universidad_programa_academico (
    id_universidad INT NOT NULL,
    id_programa INT NOT NULL,
    PRIMARY KEY (id_universidad, id_programa),
    FOREIGN KEY (id_universidad) REFERENCES universidad(id_universidad),
    FOREIGN KEY (id_programa) REFERENCES programa_academico(id_programa)
);

CREATE TABLE usuario_proyecto_rol (
    id_proyecto INT NOT NULL,
    id_usuario INT NOT NULL,
    id_rol INT NOT NULL,
    PRIMARY KEY (id_proyecto, id_usuario, id_rol),
    FOREIGN KEY (id_proyecto) REFERENCES proyecto(id_proyecto),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_rol) REFERENCES rol(id_rol)
);

CREATE TABLE estudiante_grupo (
    id_estudiante INT NOT NULL,
    id_grupo INT NOT NULL,
    PRIMARY KEY (id_estudiante, id_grupo),
    FOREIGN KEY (id_estudiante) REFERENCES estudiante(id_estudiante),
    FOREIGN KEY (id_grupo) REFERENCES grupo(id_grupo)
);


CREATE TABLE estudiante_programa_academico (
    id_estudiante INT NOT NULL,
    id_programa INT NOT NULL,
    PRIMARY KEY (id_estudiante, id_programa),
    FOREIGN KEY (id_estudiante) REFERENCES estudiante(id_estudiante),
    FOREIGN KEY (id_programa) REFERENCES programa_academico(id_programa)
);

CREATE TABLE grupo_proyecto (
    id_grupo INT NOT NULL,
    id_proyecto INT NOT NULL,
    PRIMARY KEY (id_grupo, id_proyecto),
    FOREIGN KEY (id_grupo) REFERENCES grupo(id_grupo),
    FOREIGN KEY (id_proyecto) REFERENCES proyecto(id_proyecto)
);

CREATE TABLE era_proyecto (
    id_era INT NOT NULL,
    id_proyecto INT NOT NULL,
    PRIMARY KEY (id_era, id_proyecto),
    FOREIGN KEY (id_era) REFERENCES era(id_era),
    FOREIGN KEY (id_proyecto) REFERENCES proyecto(id_proyecto)
);

CREATE TABLE ira_proyecto (
    id_ira INT NOT NULL,
    id_proyecto INT NOT NULL,
    PRIMARY KEY (id_ira, id_proyecto),
    FOREIGN KEY (id_ira) REFERENCES ira(id_ira),
    FOREIGN KEY (id_proyecto) REFERENCES proyecto(id_proyecto)
);

CREATE TABLE rep_proyecto (
    id_rep INT NOT NULL,
    id_proyecto INT NOT NULL,
    PRIMARY KEY (id_rep, id_proyecto),
    FOREIGN KEY (id_rep) REFERENCES rep(id_rep),
    FOREIGN KEY (id_proyecto) REFERENCES proyecto(id_proyecto)
);

CREATE TABLE linea_investigacion_proyecto (
    id_linea INT NOT NULL,
    id_proyecto INT NOT NULL,
    PRIMARY KEY (id_linea, id_proyecto),
    FOREIGN KEY (id_linea) REFERENCES linea_de_investigacion(id_linea),
    FOREIGN KEY (id_proyecto) REFERENCES proyecto(id_proyecto)
);

CREATE TABLE taller_proyecto (
    id_proyecto INT NOT NULL,
    id_taller INT NOT NULL,
    PRIMARY KEY (id_proyecto, id_taller),
    FOREIGN KEY (id_proyecto) REFERENCES proyecto(id_proyecto),
    FOREIGN KEY (id_taller) REFERENCES taller_transito(id_taller)
);

CREATE TABLE entregable_proyecto (
    id_proyecto INT NOT NULL,
    id_entregable INT NOT NULL,
    PRIMARY KEY (id_proyecto, id_entregable),
    FOREIGN KEY (id_proyecto) REFERENCES proyecto(id_proyecto),
    FOREIGN KEY (id_entregable) REFERENCES entregable(id_entregable)
);