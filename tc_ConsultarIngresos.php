<?php
include_once("Usuarios.php");
include_once("Ingresos.php");

$usuario = new Usuarios();
//Validar la sesion si es cliente o tecnico
$usuario->validateSessionTecnicos();

include_once('templates/iniciar-html.php');
include_once('templates/menu.php');

$nMes = $_GET['nMes'];

date_default_timezone_set('America/Bogota');

$ingresos = new Ingresos();
$idTecnico = $usuario->getId();
$mesesStr = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

$arrEstimado = array();
$arrGanancias = array();

for ($i = 1; $i < 13; $i++) {
    $inicioMes = date("Y-" . $i . "-" . "01");
    $finMes = new DateTime($inicioMes);

    $ganancias = $ingresos->calcular_ganancia_mensual($idTecnico, $inicioMes, $finMes->format('Y-m-t'));
    $estimado = $ingresos->calcular_estimado_mensual($idTecnico, $inicioMes, $finMes->format('Y-m-t'));

    array_push($arrEstimado, $estimado[0] + $ganancias[0]);
    array_push($arrGanancias, $ganancias[0]);
}
?>

<div class="container">
    <div class="publicacion-title">
        <br>
        <h1>Consultar ingresos mensuales</h1>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12">
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="form-calendar-container">
                
                    <div class="title">
                        <h3>Ingresos para el mes de <?php echo $mesesStr[$nMes - 1]; ?></h3>
                    </div>
                
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Este es el estimado de ingresos que usted ganará en <?php echo $mesesStr[$nMes - 1]; ?></h5>

                        
                        
                        <p class="card-text" style="font-size:200%;"> <?php echo "$ ".number_format(intval($arrEstimado[$nMes - 1]), 0, ",", "."); ?> </p>
                    </div>
                </div><br>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Este es el total de ingresos que usted ha obtenido en <?php echo $mesesStr[$nMes - 1]; ?></h5>
                        
                        <p class="card-text" style="font-size:200%;"> <?php echo "$ ".number_format(intval(($arrGanancias[$nMes - 1]) * 1), 0, ",", "."); ?> </p>
                    </div>
                </div><br>
                <div>
                    <a href="tc_ConsultarIngresos.php?nMes=<?php $mesAnterior = ($nMes - 1);
                                                            if ($mesAnterior >= 1) {
                                                                echo $mesAnterior;
                                                            } else {
                                                                echo 1;
                                                            } ?>" class="btn btn-primary">
                        Mes anterior
                    </a>



                    <a href="tc_ConsultarIngresos.php?nMes=<?php $mesSiguente = ($nMes + 1);
                                                            if ($mesSiguente <= 12) {
                                                                echo $mesSiguente;
                                                            } else {
                                                                echo 12;
                                                            } ?>" class="btn btn-primary">
                        Mes siguiente
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 col-xs-12">
        </div>
    </div>



</div>

<?php
include_once('templates/terminar-html.php');
?>