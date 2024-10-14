<?php

$path_tablas = array(
    'Estudiantes' => '../datos/estudiantes_gud.csv',
    'Historial Academico' => '../datos/Notas_gud.csv',
    'Planes' => '../datos/planes_gud.csv',
    'Prerequisitos' => '../datos/Prerequisitos_gud.csv',
    'Academicos' => '../datos/Academicos_gud.csv',
    'Administrativos' => '../datos/Administrativos_gud.csv',
    'Carreras' => '../datos/Carreras_gud.csv',
    'Carreras facu' => '../datos/Carreras_facu_gud.csv',
    'Cursos' => '../datos/Cursos_gud.csv',
    "Cursos depa facu" => '../datos/Cursos_depa_facu_gud.csv',
    'Departamentos facu' => '../datos/Departamentos_facu_gud.csv',
    'Departamentos' => '../datos/Departamentos_gud.csv',
    'Estudiantes carrera plan' => '../datos/Estudiantes_carrera_plan_gud.csv',
    'Facultades' => '../datos/Facultades_gud.csv',
    'Oferta academica' => '../datos/Oferta_academica_gud.csv',
    'Personas' => '../datos/Personas_gud.csv',
    'Planes carrera' => '../datos/Planes_carrera_gud.csv'

);

$tablas_iniciales = array(
    'Facultades' => 'FacultadID SERIAL PRIMARY KEY, NombreFacultad VARCHAR(255)',
    'Carreras' => 'NombreCarrera VARCHAR(255) PRIMARY KEY',
    'Planes' => 'CodigoPlan INT PRIMARY KEY, NombrePlan VARCHAR(255), InicioVigencia DATE, Jornada VARCHAR(50), Modalidad VARCHAR(50), Sede VARCHAR(100), Grado VARCHAR(50)',
    'Carreras_facu' => 'ConexionID SERIAL PRIMARY KEY, NombreCarrera VARCHAR(255) REFERENCES carreras(NombreCarrera), FacultadID INT REFERENCES facultades(FacultadID)',
    'Planes_carreras' => 'ConexionID INT PRIMARY KEY, NombreCarrera VARCHAR(255) REFERENCES carreras(NombreCarrera), CodigoPlan INT REFERENCES planes(CodigoPlan)',
    'Departamentos' => 'CodigoDepartamento INT PRIMARY KEY, NombreDepartamento VARCHAR(255)',
    'Depa_facu' => 'ConexionID INT PRIMARY KEY, FacultadID INT REFERENCES facultades(FacultadID), CodigoDepartamento INT REFERENCES departamentos(CodigoDepartamento)',
    'Personas' => 'RUN INT PRIMARY KEY, DV VARCHAR(10), Nombres VARCHAR(255), ApellidoPaterno VARCHAR(255), ApellidoMaterno VARCHAR(255), MailInstitucional VARCHAR(255), MailPersonal VARCHAR(255), Telefono INT',
    'Estudiantes' => 'NumeroEstudiante INT PRIMARY KEY, RUN INT REFERENCES personas(RUN), Cohorte INT, Bloqueo VARCHAR(50), Causal_Bloqueo VARCHAR(255), Ultima_carga DATE, Fecha_logro DATE, Logro VARCHAR(255)',
    'Estudiante_carrera_plan' => 'ConexionID INT PRIMARY KEY, NumeroEstudiante INT REFERENCES estudiantes(NumeroEstudiante), CodigoPlan INT REFERENCES planes(CodigoPlan), NombreCarrera VARCHAR(255) REFERENCES carreras(NombreCarrera)',
    'Academicos' => 'RUN INT PRIMARY KEY REFERENCES personas(RUN), GradoAcademico VARCHAR(255), Jornada VARCHAR(50), JerarquiaAcademica VARCHAR(50), Contrato VARCHAR(50) Dedicacion INT',
    'Administrativos' => 'RUN INT PRIMARY KEY REFERENCES personas(RUN), GradoAcademico VARCHAR(255), Cargo VARCHAR(50), JerarquiaAcademica VARCHAR(50), Contrato VARCHAR(50), Dedicacion INT',
    'Cursos' => 'Sigla VARCHAR(255) PRIMARY KEY, NombreCurso VARCHAR(255), Caracter VARCHAR(50), Nivel INT, Ciclo INT',
    'Curso_plan' => 'ConexionID INT PRIMARY KEY, Sigla VARCHAR(255) REFERENCES cursos(Sigla), CodigoPlan INT REFERENCES planes(CodigoPlan)',
    'Curso_depa_facu' => 'ConexionID INT PRIMARY KEY, Sigla VARCHAR(255) REFERENCES cursos(Sigla), CodigoDepartamento INT REFERENCES departamentos(CodigoDepartamento), NombreFacultad VARCHAR(255) REFERENCES facultades(NombreFacultad)',
    'Historial_academico' => 'NotaID INT PRIMARY KEY, NumeroEstudiante INT REFERENCES estudiantes(NumeroEstudiante), Sigla VARCHAR(255) REFERENCES cursos(Sigla), Periodo_nota DATE, NotaFinal FLOAT, Calificacion VARCHAR(50), Convocatoria VARCHAR(50)',
    'Oferta_academica' => 'OfertaID INT PRIMARY KEY, Periodo DATE, Sede VARCHAR(100), Sigla VARCHAR(255) REFERENCES cursos(Sigla), Seccion INT, Duracion VARCHAR(50), Cupos INT, Inscritos INT, Hora_de_inicio VARCHAR(50), Hora_de_fin VARCHAR(50), Dia VARCHAR(50), Fecha_Inicio DATE, Fecha_Fin DATE, Lugar VARCHAR(255), Edificio VARCHAR(255), RUN INT REFERENCES academicos(RUN)',
    'Prerrequisitos' => 'PrerequisitosID INT PRIMARY KEY, Sigla VARCHAR(255) REFERENCES cursos(Sigla), Requisito1 VARCHAR(255), Requisito2 VARCHAR(255)'
);

?>