<?php

$path_tablas = array(
    'spotify' => '../data/Spotify-Songs.csv',
    'usuarios' => '../data/usuarios.csv',
);

$tablas_iniciales = array(
    'facultades' => 'FacultadID SERIAL PRIMARY KEY, NombreFacultad VARCHAR(255)',
    'carreras' => 'NombreCarrera VARCHAR(255) PRIMARY KEY',
    'planes' => 'CodigoPlan INT PRIMARY KEY, NombrePlan VARCHAR(255), InicioVigencia DATE, Jornada VARCHAR(50), Modalidad VARCHAR(50), Sede VARCHAR(100), Grado VARCHAR(50)',
    'carreras_facu' => 'ConexionID SERIAL PRIMARY KEY, NombreCarrera VARCHAR(255) REFERENCES carreras(NombreCarrera), FacultadID INT REFERENCES facultades(FacultadID)',
    'planes_carreras' => 'ConexionID INT PRIMARY KEY, NombreCarrera VARCHAR(255) REFERENCES carreras(NombreCarrera), CodigoPlan INT REFERENCES planes(CodigoPlan)',
    'departamentos' => 'CodigoDepartamento INT PRIMARY KEY, NombreDepartamento VARCHAR(255)',
    'depa_facu' => 'ConexionID INT PRIMARY KEY, FacultadID INT REFERENCES facultades(FacultadID), CodigoDepartamento INT REFERENCES departamentos(CodigoDepartamento)',
    'personas' => 'RUN INT PRIMARY KEY, DV VARCHAR(10), Nombres VARCHAR(255), ApellidoPaterno VARCHAR(255), ApellidoMaterno VARCHAR(255), MailInstitucional VARCHAR(255), MailPersonal VARCHAR(255), Telefono INT, Estamento VARCHAR(50)',
    'estudiantes' => 'NumeroEstudiante INT PRIMARY KEY, RUN INT REFERENCES personas(RUN), Cohorte INT, Bloqueo VARCHAR(50), Causal_Bloqueo VARCHAR(255), Ultima_carga DATE, Fecha_logro DATE, Logro VARCHAR(255)',
    'estudiante_carrera_plan' => 'ConexionID INT PRIMARY KEY, NumeroEstudiante INT REFERENCES estudiantes(NumeroEstudiante), CodigoPlan INT REFERENCES planes(CodigoPlan), NombreCarrera VARCHAR(255) REFERENCES carreras(NombreCarrera)',
    'academicos' => 'RUN INT PRIMARY KEY REFERENCES personas(RUN), GradoAcademico VARCHAR(255), Jornada VARCHAR(50), JerarquiaAcademica VARCHAR(50), Contrato VARCHAR(50)',
    'administrativos' => 'RUN INT PRIMARY KEY REFERENCES personas(RUN), GradoAcademico VARCHAR(255), Cargo VARCHAR(50), JerarquiaAcademica VARCHAR(50), Contrato VARCHAR(50)',
    'cursos' => 'Sigla VARCHAR(255) PRIMARY KEY, NombreCurso VARCHAR(255), Caracter VARCHAR(50), Nivel INT, Ciclo INT',
    'curso_plan' => 'ConexionID INT PRIMARY KEY, Sigla VARCHAR(255) REFERENCES cursos(Sigla), CodigoPlan INT REFERENCES planes(CodigoPlan)',
    'curso_depa_facu' => 'ConexionID INT PRIMARY KEY, Sigla VARCHAR(255) REFERENCES cursos(Sigla), CodigoDepartamento INT REFERENCES departamentos(CodigoDepartamento), NombreFacultad VARCHAR(255) REFERENCES facultades(NombreFacultad)',
    'historial_academico' => 'NotaID INT PRIMARY KEY, NumeroEstudiante INT REFERENCES estudiantes(NumeroEstudiante), Sigla VARCHAR(255) REFERENCES cursos(Sigla), Periodo_nota DATE, NotaFinal FLOAT, Calificacion VARCHAR(50), Convocatoria VARCHAR(50)',
    'oferta_academica' => 'OfertaID INT PRIMARY KEY, Periodo DATE, Sede VARCHAR(100), Sigla VARCHAR(255) REFERENCES cursos(Sigla), Seccion INT, Duracion VARCHAR(50), Cupos INT, Inscritos INT, Hora_de_inicio VARCHAR(50), Hora_de_fin VARCHAR(50), Dia VARCHAR(50), Fecha_Inicio DATE, Fecha_Fin DATE, Lugar VARCHAR(255), Edificio VARCHAR(255), RUN INT REFERENCES academicos(RUN)',
    'prerrequisitos' => 'PrerequisitosID INT PRIMARY KEY, Sigla VARCHAR(255) REFERENCES cursos(Sigla), Requisito1 VARCHAR(255), Requisito2 VARCHAR(255)'
);

?>