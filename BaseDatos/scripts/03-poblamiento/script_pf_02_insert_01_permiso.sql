-- permiso 
INSERT INTO permiso (crear, leer, actualizar, borrar, leer_nota, actualizar_nota) VALUES
(true, true, true, true, true, true),       -- id 1 → Evaluador
(false, true, false, false, true, false),   -- id 2 → Estudiante
(true, true, true, false, true, false),     -- id 3 → Docente
(true, false, false, false, true, false);   -- id 4 → Administrador