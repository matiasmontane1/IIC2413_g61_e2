<?php 
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php"); 
    exit(); 
}

include('templates/header.html'); 
?>

<body>
  <div class="user">
  <h1 class="title">Bananer</h1>
  <p class="description">Aquí podrás encontrar información sobre la universidad.</p>

  <h2 class="subtitle">consulta aprobacion curso periodo</h2>
  <p class="prompt">Ingresa el largo del top de canciones:</p>

  <form class="form" action="consultas/consulta_aprobacion_curso_periodo.php" method="post">
    <input class="form-input" type="text" required placeholder="Ingresa el periodo" name="periodo" min="1" title="Debe ser en formato AÑO-SEMESTRE"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>
  <br>
  <br>

  <h2 class="subtitle">consulta cantidad de estudiantes vigentes</h2>
  <p class="prompt">Ingresa el largo del top de canciones:</p>


  <h2 class="subtitle">consulta porcentaje de aprobacion</h2>
  <p class="prompt">Ingresa el largo del top de canciones:</p>


  <h2 class="subtitle">consulta promedio de porcentaje de aprobacion historico agrupado por profesor</h2>
  <p class="prompt">Ingresa el largo del top de canciones:</p>


  <h2 class="subtitle">consulta propuesta de toma de ramos 2025-1</h2>
  <p class="prompt">Ingresa el largo del top de canciones:</p>
  <form class="form" action="consultas/consulta_historial_academico.php" method="post">
    <input class="form-input" type="text" required placeholder="numero de estudiante" name="numeroEstudiante"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>
  <br>
  <br>

  <h2 class="subtitle">consulta historial academico</h2>
  <p class="prompt">Ingresa el largo del top de canciones:</p>
  <form class="form" action="consultas/consulta_estudiantes_nivel.php" method="post">
    <input class="form-button" type="submit" value="Buscar">
  </form>
  <br>
  <br>


  <p class="prompt">Ingresa el nombre de un artista:</p>
  <form class="form" action="consultas/consulta_canciones_por_artista.php" method="post">
    <input class="form-input" type="text" required placeholder="Ingresa un nombre" name="artista"> 
    <br>
    <input class="form-button" type="submit" value="Buscar">
  </form>
  <br>
  <br>
  <form method="POST" action="consultas/logout.php">
    <button type="submit" class="form-button">Volver a Iniciar Sesión</button>
  </form>
  </div>
</body>
</html>