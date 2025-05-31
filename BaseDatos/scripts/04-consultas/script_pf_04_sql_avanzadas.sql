
-- Consulta 1: Listado general de proyectos por facultad, programa y código de proyecto
SELECT fac.nombre AS facultad,
       prog.nombre_programa AS programa,
       pro.id_proyecto AS codigo_proyecto,
       pro.titulo AS titulo_proyecto,
       tip.tipo_proyecto AS tipo_proyecto
FROM proyecto pro
JOIN tipo_proyecto tip ON pro.id_tipo = tip.id_tipo_proyecto
JOIN grupo_proyecto grppr ON pro.id_proyecto = grppr.id_proyecto
JOIN grupo grp ON grppr.id_grupo = grp.id_grupo
JOIN asignatura asi ON grp.id_asignatura = asi.id_asignatura
JOIN programa_academico prog ON asi.id_programa = prog.id_programa
JOIN departamento dep ON prog.id_departamento = dep.id_departamento
JOIN facultad fac ON dep.id_facultad = fac.id_facultad
ORDER BY fac.nombre, prog.nombre_programa, pro.id_proyecto;


-- Consulta 2: Listado detallado de proyectos con tipo, asignatura, programa, facultad, docente y estudiante
SELECT pro.id_proyecto AS codigo_proyecto,
       tip.tipo_proyecto AS nombre_tipo_proyecto,
       pro.titulo AS nombre_proyecto,
       fac.nombre AS nombre_facultad,
       prog.nombre_programa AS nombre_programa,
       asi.nombre AS nombre_asignatura,
       CONCAT(doc.nombre, ' ', doc.apellido) AS nombre_docente,
       CONCAT(est.nombre, ' ', est.apellido) AS nombre_estudiante
FROM proyecto pro
JOIN tipo_proyecto tip ON pro.id_tipo = tip.id_tipo_proyecto
JOIN grupo_proyecto grppr ON pro.id_proyecto = grppr.id_proyecto
JOIN grupo grp ON grppr.id_grupo = grp.id_grupo
JOIN profesor doc ON grp.id_profesor = doc.id_profesor
JOIN asignatura asi ON grp.id_asignatura = asi.id_asignatura
JOIN programa_academico prog ON asi.id_programa = prog.id_programa
JOIN departamento dep ON prog.id_departamento = dep.id_departamento
JOIN facultad fac ON dep.id_facultad = fac.id_facultad
JOIN estudiante_grupo estgrp ON grp.id_grupo = estgrp.id_grupo
JOIN estudiante est ON estgrp.id_estudiante = est.id_estudiante
ORDER BY pro.id_proyecto;


-- Consulta 3: Proyecto a grupo
SELECT pro.id_proyecto AS codigo_proyecto,
       pro.titulo AS titulo_proyecto,
       tip.tipo_proyecto AS nombre_tipo_proyecto,
       usu.correo AS evaluador_correo,
       eva.resultado AS puntaje_evaluacion,
       eva.observacion AS comentario_evaluacion,
       eva.criterio1, eva.criterio2, eva.criterio3, eva.criterio4,
       eva.criterio5, eva.criterio6, eva.criterio7, eva.criterio8,
       eva.criterio9, eva.criterio10
FROM evaluacion eva
JOIN proyecto pro ON eva.id_proyecto = pro.id_proyecto
JOIN tipo_proyecto tip ON pro.id_tipo = tip.id_tipo_proyecto
JOIN evaluador ev ON eva.id_evaluador = ev.id_evaluador
JOIN usuario usu ON ev.id_usuario = usu.id_usuario
ORDER BY pro.id_proyecto DESC, eva.resultado DESC;

-- Consulta 4: Total de proyectos por programa y facultad
SELECT 
    facu.nombre AS nombre_facultad,
    prog.nombre_programa,
    COUNT(DISTINCT pr.id_proyecto) AS total_proyectos
FROM facultad facu
JOIN departamento d ON d.id_facultad = facu.id_facultad
JOIN programa_academico prog ON prog.id_departamento = d.id_departamento
JOIN asignatura a ON a.id_programa = prog.id_programa
JOIN grupo g ON g.id_asignatura = a.id_asignatura
JOIN grupo_proyecto gp ON gp.id_grupo = g.id_grupo
JOIN proyecto pr ON pr.id_proyecto = gp.id_proyecto
GROUP BY facu.nombre, prog.nombre_programa
ORDER BY facu.nombre, prog.nombre_programa;


-- Consulta 5: Listado de estudiantes de la asignatura “Base de Datos I” (ET0187), Grupo 051
-- Nota: el código 'ET0187' no está en la base, así que filtramos solo por nombre y número de grupo
SELECT est.id_estudiante AS codigo_estudiante,
       est.nombre AS nombre_estudiante,
       est.apellido AS apellido_estudiante,
       asi.id_asignatura AS codigo_asignatura,
       asi.nombre AS nombre_asignatura,
       grp.numero_grupo AS numero_grupo
FROM estudiante est
JOIN estudiante_grupo estgrp ON est.id_estudiante = estgrp.id_estudiante
JOIN grupo grp ON estgrp.id_grupo = grp.id_grupo
JOIN asignatura asi ON grp.id_asignatura = asi.id_asignatura
WHERE asi.nombre = 'Base de Datos I'
  AND grp.numero_grupo = 51
ORDER BY est.apellido, est.nombre;

-- Consulta 6: Listado de asignaturas/grupos por tipos de proyecto, ordenado jerárquicamente
SELECT tip.tipo_proyecto AS nombre_tipo_proyecto,
       fac.nombre AS nombre_facultad,
       prog.nombre_programa AS nombre_programa,
       asi.nombre AS nombre_asignatura,
       grp.numero_grupo AS numero_grupo
FROM proyecto pro
JOIN tipo_proyecto tip ON pro.id_tipo = tip.id_tipo_proyecto
JOIN grupo_proyecto grppr ON pro.id_proyecto = grppr.id_proyecto
JOIN grupo grp ON grppr.id_grupo = grp.id_grupo
JOIN asignatura asi ON grp.id_asignatura = asi.id_asignatura
JOIN programa_academico prog ON asi.id_programa = prog.id_programa
JOIN departamento dep ON prog.id_departamento = dep.id_departamento
JOIN facultad fac ON dep.id_facultad = fac.id_facultad
ORDER BY tip.tipo_proyecto, fac.nombre, prog.nombre_programa, asi.nombre, grp.numero_grupo;


-- Consulta 7: Listado de cantidad de tipos de proyectos por facultad y programa
-- Ordenado por facultad, programa y tipo de proyecto

SELECT fac.id_facultad AS codigo_facultad,
       fac.nombre AS nombre_facultad,
       prog.id_programa AS codigo_programa,
       prog.nombre_programa AS nombre_programa,
       tip.id_tipo_proyecto AS codigo_tipo_proyecto,
       tip.tipo_proyecto AS nombre_tipo_proyecto,
       COUNT(DISTINCT pro.id_proyecto) AS cantidad_tipos_proyecto
FROM proyecto pro
-- Relacionamos con el tipo de proyecto
JOIN tipo_proyecto tip ON pro.id_tipo = tip.id_tipo_proyecto
-- Relacionamos con los grupos asociados al proyecto
JOIN grupo_proyecto grppr ON pro.id_proyecto = grppr.id_proyecto
JOIN grupo grp ON grppr.id_grupo = grp.id_grupo
-- Relacionamos con la asignatura
JOIN asignatura asi ON grp.id_asignatura = asi.id_asignatura
-- Relacionamos con el programa académico
JOIN programa_academico prog ON asi.id_programa = prog.id_programa
-- Relacionamos con el departamento y facultad
JOIN departamento dep ON prog.id_departamento = dep.id_departamento
JOIN facultad fac ON dep.id_facultad = fac.id_facultad
-- Agrupamos para contar cuántos proyectos distintos hay por combinación
GROUP BY fac.id_facultad, fac.nombre,
         prog.id_programa, prog.nombre_programa,
         tip.id_tipo_proyecto, tip.tipo_proyecto
-- Ordenamos por facultad, programa y tipo de proyecto
ORDER BY fac.id_facultad, prog.id_programa, tip.id_tipo_proyecto;


-- Consulta 8: Listado de evaluadores de los diferentes proyectos
-- Incluye códigos y descripciones, ordenado según lo pedido

SELECT CONCAT(ev.nombre, ' ', ev.apellido) AS nombre_evaluador,
       fac.id_facultad AS codigo_facultad,
       fac.nombre AS nombre_facultad,
       prog.id_programa AS codigo_programa,
       prog.nombre_programa AS nombre_programa,
       tip.id_tipo_proyecto AS codigo_tipo_proyecto,
       tip.tipo_proyecto AS nombre_tipo_proyecto,
       pro.id_proyecto AS codigo_proyecto,
       pro.titulo AS nombre_proyecto
FROM evaluacion eva
-- Relacionamos evaluación con usuario (evaluador)
JOIN usuario usu ON eva.id_usuario = usu.id_usuario
JOIN evaluador ev ON usu.id_usuario = ev.id_usuario
-- Relacionamos evaluación con proyecto
JOIN proyecto pro ON eva.id_proyecto = pro.id_proyecto
JOIN tipo_proyecto tip ON pro.id_tipo = tip.id_tipo_proyecto
-- Relacionamos proyecto con los grupos asociados
JOIN grupo_proyecto grppr ON pro.id_proyecto = grppr.id_proyecto
JOIN grupo grp ON grppr.id_grupo = grp.id_grupo
-- Relacionamos grupo con asignatura
JOIN asignatura asi ON grp.id_asignatura = asi.id_asignatura
-- Relacionamos asignatura con programa académico
JOIN programa_academico prog ON asi.id_programa = prog.id_programa
-- Relacionamos programa académico con facultad
JOIN departamento dep ON prog.id_departamento = dep.id_departamento
JOIN facultad fac ON dep.id_facultad = fac.id_facultad
-- Ordenamos según lo pedido
ORDER BY nombre_evaluador, fac.nombre, prog.nombre_programa, tip.tipo_proyecto, pro.titulo;

-- Consulta 9: General de evaluadores con resultados de evaluación
SELECT CONCAT_WS(' ', ev.nombre, ev.nombre_2, ev.apellido, ev.apellido_2) AS nombre_evaluador,
       COUNT(DISTINCT eva.id_proyecto) AS cantidad_proyectos_evaluados,
       AVG(eva.resultado) AS puntaje_promedio,
       MAX(eva.resultado) AS puntaje_maximo,
       MIN(eva.resultado) AS puntaje_minimo,
       SUM(eva.resultado) AS suma_puntajes
FROM evaluacion eva
JOIN evaluador ev ON eva.id_evaluador = ev.id_evaluador
JOIN usuario usu ON ev.id_usuario = usu.id_usuario
GROUP BY ev.id_evaluador, ev.nombre, ev.apellido, ev.nombre_2, ev.apellido_2
ORDER BY nombre_evaluador;

-- Consulta 10: Detallado de evaluadores con resultados
SELECT CONCAT_WS(' ', ev.nombre, ev.nombre_2, ev.apellido, ev.apellido_2) AS nombre_evaluador,
       pro.id_proyecto AS codigo_proyecto,
       pro.titulo AS titulo_proyecto,
       tip.id_tipo_proyecto AS codigo_tipo_proyecto,
       tip.tipo_proyecto AS nombre_tipo_proyecto,
       eva.resultado AS puntaje_otorgado,
       eva.observacion AS comentario_evaluacion
FROM evaluacion eva
JOIN evaluador ev ON eva.id_evaluador = ev.id_evaluador
JOIN usuario usu ON ev.id_usuario = usu.id_usuario
JOIN proyecto pro ON eva.id_proyecto = pro.id_proyecto
JOIN tipo_proyecto tip ON pro.id_tipo = tip.id_tipo_proyecto
ORDER BY nombre_evaluador, pro.id_proyecto;

-- Consulta 11: Usuarios del sistema con rol y permisos
SELECT usu.id_usuario AS codigo_usuario,
       usu.correo AS correo_usuario,
       usu.contrasena AS contrasena_usuario,
       rol.id_rol AS codigo_rol,
       rol.rol AS nombre_rol,
       per.crear AS permiso_crear,
       per.leer AS permiso_leer,
       per.actualizar AS permiso_actualizar,
       per.borrar AS permiso_borrar,
       per.leer_nota AS permiso_leer_nota,
       per.actualizar_nota AS permiso_actualizar_nota
FROM usuario usu
JOIN usuario_proyecto_rol upr ON usu.id_usuario = upr.id_usuario
JOIN rol rol ON upr.id_rol = rol.id_rol
JOIN permiso per ON rol.id_permiso = per.id_permiso
ORDER BY usu.id_usuario, rol.id_rol;

-- Consulta 12: Cantidad de proyectos evaluados por tipo y programa
SELECT tip.id_tipo_proyecto AS codigo_tipo_proyecto,
       tip.tipo_proyecto AS nombre_tipo_proyecto,
       prog.id_programa AS codigo_programa,
       prog.nombre_programa AS nombre_programa,
       COUNT(DISTINCT eva.id_evaluacion) AS cantidad_evaluaciones
FROM evaluacion eva
JOIN proyecto pro ON eva.id_proyecto = pro.id_proyecto
JOIN tipo_proyecto tip ON pro.id_tipo = tip.id_tipo_proyecto
JOIN grupo_proyecto grppr ON pro.id_proyecto = grppr.id_proyecto
JOIN grupo grp ON grppr.id_grupo = grp.id_grupo
JOIN asignatura asi ON grp.id_asignatura = asi.id_asignatura
JOIN programa_academico prog ON asi.id_programa = prog.id_programa
GROUP BY tip.id_tipo_proyecto, tip.tipo_proyecto, prog.id_programa, prog.nombre_programa
ORDER BY tip.tipo_proyecto, prog.nombre_programa;