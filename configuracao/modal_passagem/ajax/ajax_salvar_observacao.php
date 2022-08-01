<?php 
    include '../../../conexao.php';

    session_start();

    $id = $_POST['id'];

    $obs = $_POST['obs'];

    $usuario = $_SESSION['usuarioLogin'];


    echo $cons_pp = "INSERT INTO passagem_plantao.OBSERVACAO_ESPECIAL
                    SELECT passagem_plantao.seq_obs_especial.NEXTVAL CD_OBSERVACAO,
                    '$id' AS CD_PACIENTE,
                    '$usuario' AS CD_USUARIO_CRIACAO,
                    SYSDATE AS HR_CRIACAO,
                    '$obs' AS OBSERVACAO,
                    'N' AS SN_SOLUCIONADO,
                    NULL HR_SOLUCIONADO,
                    NULL CD_USUARIO_SOLUCIONADO
                    FROM DUAL";

    //UNIFICANDO CONSULTA COM A CONEXAO
    $result_pp = oci_parse($conn_ora,$cons_pp);

    //EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
    oci_execute($result_pp);



?>