<?php
require('../../../plugins/fpdf/fpdf.php');

$cveImpa = (!empty($_GET["cveImpa"]))? $_GET["cveImpa"] : "";
$fecha = (!empty($_GET["fecha"]))? $_GET["fecha"] : "";

if ($cveImpa == "" || $fecha == "") {
    echo "Oh no, ha ocurrido un error";
    exit;
}

require('../../conexion.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo de la SEP
        $this->Image('../../../img/logo_sep.png', 9, 6, 62, 23);
        // Logo de la TecNM
        $this->Image('../../../img/logo_tecNM.png', 85, 6, 40, 23);
        // Logo del ITSMT
        $this->Image('../../../img/logo_itsmt.png', 176, 7, 25, 25);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 16);
        //esto es un solto de linea
        $this->Ln(20);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, utf8_decode('INSTITUTO TECNOLÓGICO SUPERIOR DE MARTÍNEZ DE LA TORRE'), 0, 0, 'C');
        // Salto de línea
        $this->Ln(10);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);

//190 px es el total de ancho de la tabla
$pdf->Cell(35, 10, utf8_decode('PERIODO ESCOLAR'), 0, 0, 'C');
$pdf->Cell(5); // da un espacio de 5 px
$pdf->Cell(35, 10, utf8_decode('CICLO DE ESTUDIOS'), 0, 0, 'C');
$pdf->Cell(5); // da un espacio de 5 px
$pdf->Cell(110, 10, utf8_decode('DEPARTAMENTO ACADEMICO'), 0, 0, 'C');

$pdf->Ln(7);

$pdf->SetFont('Arial', '', 8);

$sql = "SELECT fecha_inicio_semestre, fecha_fin_semestre, nombre_asignatura, cveImpa_Asig, cveGrupo, RFC, nombre_persona, apellido_pa, apellido_ma FROM asignatura
        NATURAL JOIN impartir_asignatura
        NATURAL JOIN profesor
        NATURAL JOIN personal_escolar
        NATURAL JOIN usuario
        WHERE cveImpa_Asig = ?";
$stmt = $conexion -> prepare($sql);
$stmt -> bind_param("s", $cveImpa);
$stmt -> execute();
$resultado = $stmt -> get_result();

if ($row = $resultado -> fetch_object()) {
    $pdf->Cell(35, 5, utf8_decode($row->fecha_inicio_semestre . '-' . $row->fecha_fin_semestre), 1, 0, 'C');
    $pdf->Cell(5);
    $pdf->Cell(35, 5, utf8_decode('LICENCIATURA'), 1, 0, 'C');
    $pdf->Cell(5);
    $pdf->Cell(110, 5, utf8_decode('DEPARTAMENTO DE RECURSOS HUMANOS'), 1, 0, 'C');
}

$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 8);

$pdf->Cell(150, 10, utf8_decode('MATERIA'), 0, 0, 'C');
$pdf->Cell(20, 10, utf8_decode('CLAVE'), 0, 0, 'C');
$pdf->Cell(20, 10, utf8_decode('GRUPO'), 0, 0, 'C');

$pdf->Ln(7);

$pdf->SetFont('Arial', '', 8);

$sql = "SELECT fecha_inicio_semestre, fecha_fin_semestre, nombre_asignatura, cveImpa_Asig, cveGrupo, RFC, nombre_persona, apellido_pa, apellido_ma FROM asignatura
        NATURAL JOIN impartir_asignatura
        NATURAL JOIN profesor
        NATURAL JOIN personal_escolar
        NATURAL JOIN usuario
        WHERE cveImpa_Asig = ?";
$stmt = $conexion -> prepare($sql);
$stmt -> bind_param("s", $cveImpa);
$stmt -> execute();
$resultado = $stmt -> get_result();

if($row = $resultado->fetch_object()) {
    $pdf->Cell(150, 5, utf8_decode($row -> nombre_asignatura), 1, 0, 'C');
    $pdf->Cell(20, 5, utf8_decode($row -> cveImpa_Asig), 1, 0, 'C');
    $pdf->Cell(20, 5, utf8_decode($row -> cveGrupo), 1, 0, 'C');
}
$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 8);

$pdf->Cell(40, 10, utf8_decode('RFC'), 0, 0, 'C');
$pdf->Cell(100, 10, utf8_decode('CATEDRATICO'), 0, 0, 'C');
$pdf->Cell(50, 10, utf8_decode('MES DE ASISTENCIA'), 0, 0, 'C');

$pdf->Ln(7);

$pdf->SetFont('Arial', '', 8);

$sql = "SELECT fecha_inicio_semestre, fecha_fin_semestre, nombre_asignatura, cveImpa_Asig, cveGrupo, RFC, nombre_persona, apellido_pa, apellido_ma FROM asignatura
        NATURAL JOIN impartir_asignatura
        NATURAL JOIN profesor
        NATURAL JOIN personal_escolar
        NATURAL JOIN usuario
        WHERE cveImpa_Asig = ?";
$stmt = $conexion -> prepare($sql);
$stmt -> bind_param("s", $cveImpa);
$stmt -> execute();
$resultado = $stmt -> get_result();

if($row = $resultado->fetch_object()){
    $pdf->Cell(40, 5, utf8_decode($row -> RFC), 1, 0, 'C');
    $pdf->Cell(100, 5, utf8_decode($row -> nombre_persona . ' ' . $row -> apellido_pa . ' ' . $row -> apellido_ma), 1, 0, 'C');
    $pdf->Cell(50, 5, utf8_decode('MAYO'), 1, 0, 'C');
}
$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 8);

$pdf->Cell(27, 10, utf8_decode('LUNES'), 0, 0, 'C');
$pdf->Cell(27, 10, utf8_decode('MARTES'), 0, 0, 'C');
$pdf->Cell(27, 10, utf8_decode('MIERCOLES'), 0, 0, 'C');
$pdf->Cell(27, 10, utf8_decode('JUEVES'), 0, 0, 'C');
$pdf->Cell(27, 10, utf8_decode('VIERNES'), 0, 0, 'C');
$pdf->Cell(27, 10, utf8_decode('SABADO'), 0, 0, 'C');
$pdf->Cell(28, 10, utf8_decode('ALUMNOS'), 0, 0, 'C');

$pdf->Ln(7);

$pdf->SetFont('Arial', '', 7);

date_default_timezone_set('America/Mexico_City');
$dia = date('w');

for ($i = 1; $i <= 6; $i++) {
    if ($i == $dia) {
        $pdf->Cell(27, 5, utf8_decode('09:00 - 10:00 / 1BLC'), 1, 0, 'C');
    } else {
        $pdf->Cell(27, 5, utf8_decode(''), 1, 0, 'C');
    }
}
/*
$pdf->Cell(27,5, utf8_decode(''),1,0,'C');
$pdf->Cell(27,5, utf8_decode(''),1,0,'C');
$pdf->Cell(27,5, utf8_decode(''),1,0,'C');
$pdf->Cell(27,5, utf8_decode(''),1,0,'C');
$pdf->Cell(27,5, utf8_decode(''),1,0,'C');
$pdf->Cell(27,5, utf8_decode(''),1,0,'C');*/
$pdf->Cell(28, 5, utf8_decode('25'), 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 8);

$pdf->Cell(5, 5, utf8_decode('No'), 1, 0, 'C');
$pdf->Cell(8, 5, utf8_decode('R'), 1, 0, 'C');
$pdf->Cell(25, 5, utf8_decode('No. DE CONTROL'), 1, 0, 'C');
$pdf->Cell(58, 5, utf8_decode('NOMBRE DEL ALUMNO'), 1, 0, 'C');

$pdf->SetFont('Arial', 'B', 4);

for ($i = 1; $i <= 31; $i++) {
    $pdf->Cell(2, 5, utf8_decode($i), 1, 0, 'C');
}

$pdf->SetFont('Arial', 'B', 8);

$pdf->Cell(10, 5, utf8_decode('CALF'), 1, 0, 'C');
$pdf->Cell(22, 5, utf8_decode('FIRMA'), 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 6);

// APARTIR DE AQUI EMPIEZA LA INFORMACIÓN DEL PASE DE LISTA DE LOS ESTUDIANTES
$pdf->Cell(5, 5, utf8_decode('1'), 'B', 0, 'C');
$pdf->Cell(8, 5, utf8_decode('**'), 'B', 0, 'C');
$pdf->Cell(25, 5, utf8_decode('210i0001'), 'B', 0, 'C');
$pdf->Cell(58, 5, utf8_decode(mb_strtoupper('Brandon Hernández López', 'UTF-8')), 'B', 0, 'C');
$pdf->SetFont('Arial', '', 4);
for ($i = 1; $i <= 31; $i++) {
    $pdf->Cell(2, 5, utf8_decode('X'), 1, 0, 'C');
}
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(10, 5, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(22, 5, utf8_decode(''), 'B', 1, 'C');




$pdf->Output();
