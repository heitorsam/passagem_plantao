<?php 
    include '../../../conexao.php';

    session_start();

    $cd_obs = $_POST['cd_obs'];

    $sn = $_POST['sn'];

    $usuario = $_SESSION['usuarioLogin'];


    echo $cons_pp = "UPDATE passagem_plantao.OBSERVACAO_ESPECIAL SET 
                                        SN_SOLUCIONADO = '$sn', 
                                        HR_SOLUCIONADO = SYSDATE, 
                                        CD_USUARIO_SOLUCIONADO = '$usuario' 
                                        WHERE CD_OBSERVACAO = $cd_obs";

    //UNIFICANDO CONSULTA COM A CONEXAO
    $result_pp = oci_parse($conn_ora,$cons_pp);

    //EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
    oci_execute($result_pp);



?>