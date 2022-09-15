<?php

session_start();
include '../../conexao.php';

$var_del = $_POST['codigo'];    

echo $con_delete_dur = "DELETE FROM passagem_plantao.DURANTE dur
                        WHERE dur.CD_DURANTE = '$var_del'";



$result_delete_dur = oci_parse($conn_ora,$con_delete_dur);

oci_execute($result_delete_dur);

echo $con_delete_obs = "DELETE FROM passagem_plantao.OBSERVACAO_PACIENTE op
                        WHERE op.CD_DURANTE = '$var_del'";



$result_delete_obs = oci_parse($conn_ora,$con_delete_obs);

oci_execute($result_delete_obs);

?>