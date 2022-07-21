<?php

session_start();
include '../conexao.php';

$var_del = $_GET['codigo'];    

$con_del_permi = "DELETE FROM passagem_plantao.permissoes PPP
                     WHERE PPP.CD_PERMISSAO = '$var_del'";

echo $con_del_permi;


$result_del_permi = oci_parse($conn_ora,$con_del_permi);

$valida = oci_execute($result_del_permi);

if(!$valida){

    $erro =  oci_error($result_del_permi);
    $_SESSION['msgerro'] = htmlentities($erro['message']);

}else{

    $_SESSION['msg'] = 'Apagado com Sucesso!';
}


header("Location:../estrutura_permissoes.php");


?>