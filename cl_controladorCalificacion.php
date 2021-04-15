<?php
include_once('templates/iniciar-html.php');
include_once('templates/menu.php');
include_once("Publicacion.php");
include_once("Usuarios.php");

$ModeloUsuarios = new Usuarios();
//Validar la sesion si es cliente o tecnico
$ModeloUsuarios->validateSessionClientes();

$pregunta1 = $_GET['pregunta1'];

echo $pregunta1;

//header('Location: index-Clientes.php');
include_once('templates/terminar-html.php');