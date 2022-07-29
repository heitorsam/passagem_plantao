<?php

session_start();
include '../../conexao.php';

$var_del = $_POST['codigo'];    

echo $con_del_permi = "DELETE FROM passagem_plantao.DURANTE dur
                        WHERE dur.CD_DURANTE = '$var_del'";



$result_del_permi = oci_parse($conn_ora,$con_del_permi);

oci_execute($result_del_permi);

?>