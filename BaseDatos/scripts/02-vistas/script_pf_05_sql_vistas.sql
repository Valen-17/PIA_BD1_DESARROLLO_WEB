--1. vista_proyectos
--Consulta de Proyectos - vista #1
--Listado de proyectos.  Obligatorio el uso asociado de las tablas: tipos de proyecto, proyectos, facultad, programas, asignaturas, grupos, docentes y estudiantes. Esta vista debe ser completa con todos los campos código y descripción (o nombre); y los datos más relevantes.
CREATE VIEW vista_proyectos AS
SELECT
    proy.id_proyecto,
    proy.titulo,
    proy.descripcion AS descripcion_proyecto,
    proy.fecha_inscripcion,

    tip_proy.tipo_proyecto,

    grup.numero_grupo,

    asig.nombre AS nombre_asignatura,

    prof.numero_identificacion,
    prof.nombre AS nombre_profesor,
    prof.apellido AS apellido_profesor,
    prof.apellido_2 AS segundo_apellido_profesor,
    facu.nombre AS nombre_facultad,

    prog_aca.nombre_programa,

    asig.nivel_estudio AS semestre

FROM proyecto proy
JOIN tipo_proyecto tip_proy ON tip_proy.id_tipo_proyecto = proy.id_tipo
JOIN grupo_proyecto grup_proy ON grup_proy.id_proyecto = proy.id_proyecto
JOIN grupo grup ON grup.id_grupo = grup_proy.id_grupo
JOIN profesor prof ON prof.id_profesor = grup.id_profesor
JOIN asignatura asig ON asig.id_asignatura = grup.id_asignatura
JOIN programa_academico prog_aca ON prog_aca.id_programa = asig.id_programa
JOIN departamento dep ON dep.id_departamento = prog_aca.id_departamento
JOIN facultad facu ON facu.id_facultad = dep.id_facultad

ORDER BY proy.id_proyecto, prof.apellido;


--2. vista_evaluaciones
--Consulta de Evaluaciones - vista #2
--Listado de evaluaciones Obligatorio el uso asociado de las tablas: tipos de proyecto, proyectos, facultad, programas, asignaturas, grupos, docentes y estudiantes. Debe incluir los nombres de tipo de proyecto, nombre proyecto, nombre facultad, nombre programa, nombre asignatura, nombre docentes, nombre estudiantes.
CREATE VIEW vista_evaluaciones AS
SELECT
    eva.id_evaluacion,
    eva.observacion,
    eva.resultado,

    proy.id_proyecto,
    proy.titulo AS nombre_proyecto,
    tip_proy.tipo_proyecto,

    grup.id_grupo,
    facu.nombre AS nombre_facultad,
    prog_aca.nombre_programa,
    asig.nombre AS nombre_asignatura,

    prof.nombre,
    prof.apellido

FROM evaluacion eva
JOIN proyecto proy ON proy.id_proyecto = eva.id_proyecto
JOIN tipo_proyecto tip_proy ON tip_proy.id_tipo_proyecto = proy.id_tipo
JOIN grupo_proyecto grup_proy ON grup_proy.id_proyecto = proy.id_proyecto
JOIN grupo grup ON grup.id_grupo = grup_proy.id_grupo
JOIN profesor prof ON prof.id_profesor = grup.id_profesor
JOIN asignatura asig ON asig.id_asignatura = grup.id_asignatura
JOIN programa_academico prog_aca ON prog_aca.id_programa = asig.id_programa
JOIN departamento dep ON dep.id_departamento = prog_aca.id_departamento
JOIN facultad facu ON facu.id_facultad = dep.id_facultad


ORDER BY proy.id_proyecto;


--3. vista_estadistica
--Consulta estadística de proyectos - vista #3
--Listado organizado por de facultad, programa, asignatura, tipos de proyecto y cantidad total de proyectos.
CREATE VIEW vista_estadistica AS
SELECT 
    facu.id_facultad,
    facu.nombre AS nombre_facultad,

    prog_aca.id_programa,
    prog_aca.nombre_programa,

    asig.id_asignatura,
    asig.nombre AS nombre_asignatura,

    tip_proy.id_tipo_proyecto,
    tip_proy.tipo_proyecto,

    COUNT(DISTINCT proy.id_proyecto) AS total_proyectos

FROM facultad facu
JOIN departamento dep ON dep.id_facultad = facu.id_facultad
JOIN programa_academico prog_aca ON prog_aca.id_departamento = dep.id_departamento
JOIN asignatura asig ON asig.id_programa = prog_aca.id_programa
JOIN grupo grup ON grup.id_asignatura = asig.id_asignatura
JOIN grupo_proyecto grup_proy ON grup_proy.id_grupo = grup.id_grupo
JOIN proyecto proy ON proy.id_proyecto = grup_proy.id_proyecto
JOIN tipo_proyecto tip_proy ON tip_proy.id_tipo_proyecto = proy.id_tipo

GROUP BY 
    facu.id_facultad, facu.nombre,
    prog_aca.id_programa, prog_aca.nombre_programa,
    asig.id_asignatura, asig.nombre,
    tip_proy.id_tipo_proyecto, tip_proy.tipo_proyecto

ORDER BY 
    facu.nombre, prog_aca.nombre_programa, asig.nombre, tip_proy.tipo_proyecto;



--4. vista_custom
--Listado de insumos prestados por universidad utlizando las tablas: universidad, tipo_insumo y prestamo_insumo.
CREATE VIEW vista_prestamo_insumos AS
SELECT 
    prs_insu.id_prestamo AS codigo_prestamo,
	
    uni.nombre AS universidad,
	
    tip_insu.tipo_insumo AS insumo,
	
    prs_insu.fecha_entrega,
	
    prs_insu.fecha_aprox_devolucion
	
FROM prestamo_insumo prs_insu
JOIN tipo_insumo tip_insu ON prs_insu.id_insumo = tip_insu.id_insumo
JOIN universidad uni ON prs_insu.id_universidad = uni.id_universidad

ORDER BY tip_insu.id_insumo;


--5. total_tipo_proyecto vista-consulta #1
--Resumen del número total de proyectos por tipo de proyecto y por facultad.
SELECT 
    tipo_proyecto,
    nombre_facultad,
    COUNT(DISTINCT id_proyecto) AS total_proyectos
FROM vista_proyectos
GROUP BY tipo_proyecto, nombre_facultad
ORDER BY nombre_facultad, tipo_proyecto;

--6. puntaje_mayor_a_4 vista-consulta #2
--Listado de evaluaciones con puntaje mayor o igual a 4.
SELECT 
    id_evaluacion,
    resultado,
    nombre_proyecto,
    tipo_proyecto,
    nombre_asignatura,
    nombre_programa
	
FROM vista_evaluaciones
WHERE resultado >= 4
ORDER BY resultado, nombre_proyecto;



--7. proyectos_programa_academico vista-consulta #3
--Cantidad de proyectos ordenados por programa académico.
SELECT 
    nombre_programa,
    COUNT(*) AS total_proyectos
FROM vista_estadistica
GROUP BY nombre_programa
ORDER BY total_proyectos;



--8. insumos_universidad vista-consulta #4
--Cantidad de insumos prestados por universidad.
SELECT 
    universidad,
    COUNT(codigo_prestamo) AS cantidad_prestamos
FROM vista_prestamo_insumos
GROUP BY universidad
ORDER BY cantidad_prestamos;

