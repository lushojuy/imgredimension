<?php 
echo '<pre>';
print_r($_FILES['archivo']);
echo '</pre>';
$temporal = $_FILES['archivo']['tmp_name'];
$nombre = $_FILES['archivo']['name'];

//foto original
if ($_FILES['archivo']['type'] == 'image/jpeg') {
	$original = imagecreatefromjpeg($temporal);
}else if($_FILES['archivo']['type'] == 'image/png'){
	$original = imagecreatefrompng($temporal);	
}else{
	die('No se pudo generar la imagen');
}
$ancho_original = imagesx($original);
$alto_original = imagesy($original);
//lienzo vacio (DESTINO)
$ancho_nvo = 700;
$alto_nvo = round($ancho_nvo * $alto_original / $ancho_original);


$copia = imagecreatetruecolor($ancho_nvo, $alto_nvo);

//copiar original ->copia
imagecopyresampled($copia, $original, 0, 0, 0, 0, $ancho_nvo, $alto_nvo, $ancho_original, $alto_original);
//exportar
imagejpeg($copia, "imagenes/".$nombre, 100);


 ?>

