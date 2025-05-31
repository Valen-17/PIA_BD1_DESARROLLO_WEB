--1. Listado de Docentes #1
--	Listado de docentes en orden alfabético por apellidos y nombres.
SELECT 
    prof.numero_identificacion AS id_profesor,
    prof.apellido AS primer_apellido,
    prof.apellido_2 AS segundo_apellido,
    prof.nombre AS primer_nombre,
    prof.nombre_2 AS segundo_nombre
FROM profesor prof
ORDER BY prof.apellido, prof.apellido_2, prof.nombre, prof.nombre_2;


--2. Listado de Docentes #2
-- 	Listado de docentes en orden de código de departamento y alfabético por apellidos y nombres.
SELECT 
    prof.numero_identificacion AS id_profesor,
    prof.apellido AS primer_apellido,
    prof.apellido_2 AS segundo_apellido,
    prof.nombre AS primer_nombre,
    prof.nombre_2 AS segundo_nombre,
    (
        SELECT dep.id_departamento
        FROM grupo grup, asignatura asig, programa_academico prog_aca, departamento dep
        WHERE grup.id_profesor = prof.id_profesor
          AND grup.id_asignatura = asig.id_asignatura
          AND asig.id_programa = prog_aca.id_programa
          AND prog_aca.id_departamento = dep.id_departamento
        LIMIT 1
    ) AS codigo_departamento
FROM profesor prof
ORDER BY codigo_departamento, prof.apellido, prof.apellido_2, prof.nombre, prof.nombre_2;


--3. Listado de Docentes #3
--Listado de docentes del departamento de “Sistemas Digitales” ordenado por código de docente (documento de identificación).
SELECT 
    prof.numero_identificacion AS id_profesor,
    prof.apellido AS primer_apellido,
    prof.apellido_2 AS segundo_apellido,
    prof.nombre AS primer_nombre,
    prof.nombre_2 AS segundo_nombre,
    dep.nombre AS departamento
FROM profesor prof, grupo grup, asignatura asig, programa_academico prog_aca, departamento dep
WHERE prof.id_profesor = grup.id_profesor
  AND grup.id_asignatura = asig.id_asignatura
  AND asig.id_programa = prog_aca.id_programa
  AND prog_aca.id_departamento = dep.id_departamento
  AND dep.nombre = 'Sistemas Digitales'
ORDER BY prof.id_profesor;


--4. Listado de Docentes #4
--Listado de cantidad de docentes por departamento. Presentar el listado con código departamento y cantidad total de docentes por departamento. 
SELECT 
    dep.id_departamento AS codigo_departamento,
    COUNT(DISTINCT grup.id_profesor) AS total_docentes
FROM profesor prof, grupo grup, asignatura asig, departamento dep
WHERE prof.id_profesor = grup.id_profesor
  AND grup.id_asignatura = asig.id_asignatura
  AND asig.id_programa = dep.id_departamento
GROUP BY dep.id_departamento
ORDER BY dep.id_departamento;

--5. Listado de Estudiantes #1
--Listado de estudiantes en orden de género (sexo), apellidos y nombres.
--NO TENEMOS "GENERO" EN "ESTUDIANTE"
SELECT 
    est.numero_identificacion AS id_estudiante,
    est.apellido AS primer_apellido,
    est.apellido_2 AS segundo_apellido,
    est.nombre AS primer_nombre,
    est.nombre_2 AS segundo_nombre
FROM estudiante est
ORDER BY est.apellido, est.apellido_2, est.nombre, est.nombre_2;

--6. Listado de Estudiantes #2
--Listado de estudiantes en ordenado por género (sexo), apellidos y nombres.
--NO TENEMOS "GENERO" EN "ESTUDIANTE"
SELECT 
    est.numero_identificacion AS id_estudiante,
    est.apellido AS primer_apellido,
    est.apellido_2 AS segundo_apellido,
    est.nombre AS primer_nombre,
    est.nombre_2 AS segundo_nombre
FROM estudiante est
GROUP BY est.id_estudiante, est.apellido, est.apellido_2, est.nombre, est.nombre_2;


--7. Listado de Estudiantes #3
--Listado de estudiantes del programa “Ingeniería de Software” y “Tecnología en Desarrollo de Software” ordenado por código de programa y (documento de identificación).
SELECT 
    est.numero_identificacion AS id_estudiante,
    est.apellido AS primer_apellido,
    est.apellido_2 AS segundo_apellido,
    est.nombre AS primer_nombre,
    est.nombre_2 AS segundo_nombre,
    est_prg_aca.id_programa AS codigo_programa
FROM estudiante est, estudiante_programa_academico est_prg_aca, programa_academico prg_aca
WHERE est.id_estudiante = est_prg_aca.id_estudiante
  AND est_prg_aca.id_programa = prg_aca.id_programa
  AND prg_aca.nombre_programa IN ('Ingeniería de Software', 'Tecnología en Desarrollo de Software')
ORDER BY est_prg_aca.id_programa, est.numero_identificacion;

--8. Listado de Estudiantes #4
--Listado de cantidad de estudiantes por programa. Presentar el listado con código de programa y cantidad total de estudiantes por programa. 
SELECT 
    est_prg_aca.id_programa AS codigo_programa,
	prg_aca.nombre_programa,
    COUNT(est_prg_aca.id_estudiante) AS total_estudiantes
FROM estudiante_programa_academico est_prg_aca,
     programa_academico prg_aca
WHERE est_prg_aca.id_programa = prg_aca.id_programa
GROUP BY est_prg_aca.id_programa, prg_aca.nombre_programa
ORDER BY est_prg_aca.id_programa;


--9. Listado de Asignaturas #1
--Listado de asignaturas ordenado por código de nombre.
SELECT 
    asg.id_asignatura AS codigo_asignatura,
    asg.nombre AS nombre_asignatura
FROM asignatura asg
ORDER BY asg.id_asignatura, asg.nombre;



--10. Listado de Asignaturas #2
--Listado de asignaturas del programa de “Ingeniería de Software” y “Tecnología en Desarrollo de Software” ordenado por código de programa y código asignatura.
SELECT 
    asg.id_programa AS codigo_programa,
    asg.id_asignatura AS codigo_asignatura,
    asg.nombre AS nombre_asignatura
FROM asignatura asg
WHERE asg.id_programa IN (
    SELECT prg_aca.id_programa
    FROM programa_academico prg_aca
    WHERE prg_aca.nombre_programa IN ('Ingeniería de Software', 'Tecnología en Desarrollo de Software')
)
ORDER BY asg.id_programa, asg.id_asignatura;




--11. Listado de Asignaturas #2
--Listado de asignaturas del programa de “Ingeniería de Software” y “Tecnología en Desarrollo de Software” ordenado por código de programa y código asignatura.
-- REPETIDA CON LA ANTERIOR
SELECT 
    asg.id_programa AS codigo_programa,
    asg.id_asignatura AS codigo_asignatura,
    asg.nombre AS nombre_asignatura
FROM asignatura asg
WHERE asg.id_programa IN (
    SELECT prg_aca.id_programa
    FROM programa_academico prg_aca
    WHERE prg_aca.nombre_programa IN ('Ingeniería de Software', 'Tecnología en Desarrollo de Software')
)
ORDER BY asg.id_programa, asg.id_asignatura;


--12. Listado de Asignaturas #4
--Listado de cantidad de asignaturas por programa. Presentar el listado con código de programa y cantidad total de asignaturas  por programa. 
SELECT 
    prg_aca.id_programa AS codigo_programa_academico,
    prg_aca.nombre_programa AS nombre_programa,
    COUNT(asg.id_asignatura) AS cantidad_asignaturas
FROM programa_academico prg_aca, asignatura asg
WHERE prg_aca.id_programa = asg.id_programa
GROUP BY prg_aca.id_programa, prg_aca.nombre_programa
ORDER BY prg_aca.id_programa;



--13. Listado de proyectos #1
--Cantidad de proyectos por tipo de proyecto.
SELECT 
    tip_pro.id_tipo_proyecto AS codigo_tipo,
    tip_pro.tipo_proyecto AS tipo,
    COUNT(pro.id_proyecto) AS total_proyectos
FROM tipo_proyecto tip_pro, proyecto pro
WHERE tip_pro.id_tipo_proyecto = pro.id_tipo
GROUP BY tip_pro.id_tipo_proyecto, tip_pro.tipo_proyecto
ORDER BY tip_pro.id_tipo_proyecto;


--14. Listado de entregables #1
--Listado de entregables con su tipo y descripción, ordenados por tipo.
SELECT 
    etgb.id_entregable AS codigo_entregable,
    tip_etgb.tipo_entregable AS tipo,
    etgb.descripcion AS descripcion
FROM entregable etgb, tipo_entregable tip_etgb
WHERE etgb.id_tipo_entregable = tip_etgb.id_tipo_entregable
ORDER BY tip_etgb.tipo_entregable, etgb.id_entregable;



--15. Listado de insumos #1
--Listado de insumos prestados por universidad, ordenado por fecha de entrega.
SELECT 
    prs_insu.id_prestamo AS codigo_prestamo,
    uni.nombre AS universidad,
    tip_insu.tipo_insumo AS insumo,
    prs_insu.fecha_entrega,
    prs_insu.fecha_aprox_devolucion
FROM prestamo_insumo prs_insu, tipo_insumo tip_insu, universidad uni
WHERE prs_insu.id_insumo = tip_insu.id_insumo
  AND prs_insu.id_universidad = uni.id_universidad
ORDER BY prs_insu.fecha_entrega;

