<?php

session_start();
include '../conexao.php';

$var_deletar = $_GET['codigo'];    

$con_del_durante = "DELETE FROM passagem_plantao.DURANTE dur
                     WHERE dur.CD_DURANTE = '$var_deletar'
                     AND dur.CD_USUARIO_CADASTRO = '$var_user'";

echo $con_del_durante;


$result_del_durante = oci_parse($conn_ora,$con_del_durante);

$valida = oci_execute($result_del_durante);

if(!$valida){

    $erro =  oci_error($result_del_durante);
    $_SESSION['msgerro'] = htmlentities($erro['message']);

}else{

    $_SESSION['msg'] = 'Apagado com Sucesso!';
}


header("Location:../estrutura_passagem_plantao.php");


?>