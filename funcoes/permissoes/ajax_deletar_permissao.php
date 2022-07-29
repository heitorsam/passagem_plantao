<?php

    session_start();
    include '../../conexao.php';

    $var_del = $_POST['codigo'];    

    $con_del_permi = "DELETE FROM passagem_plantao.permissoes PPP
                        WHERE PPP.CD_PERMISSAO = '$var_del'";



    $result_del_permi = oci_parse($conn_ora,$con_del_permi);

    $valida = oci_execute($result_del_permi);

?>



