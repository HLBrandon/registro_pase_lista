<?php

date_default_timezone_set('America/Mexico_City');

$db_name = 'pase_lista_itsmt';

$backup_file = 'backup_' . date('d-m-Y_H.i') . '.sql';

$comando = "mysqldump -u root -h localhost --add-drop-database --databases --routines $db_name>$backup_file";

exec($comando);

header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"" . basename($backup_file) . "\"");
readfile($backup_file);
exit;
