<?php 

    include '../../conexao.php';

    session_start();

    $usuario = $_SESSION['usuarioLogin'];

    $leito = $_POST['leito'];

    $tipo = $_POST['tipo'];

    $cor = $_POST['cor'];

    $observacao = $_POST['obs'];

    $dia = $_POST['dia'];

    $nextval="SELECT passagem_plantao.seq_obs_quadro.NEXTVAL AS CD_ANOTACAO
                        FROM DUAL";
    $result_nextval = oci_parse($conn_ora,$nextval);

    //EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
    oci_execute($result_nextval);

    $row_nextval = oci_fetch_array($result_nextval);

    $nextval = $row_nextval['CD_ANOTACAO'];

    $consulta = "INSERT INTO passagem_plantao.QUADRO_ENF (CD_ANOTACAO, CD_LEITO, CD_PACIENTE, CD_UNID_INT, OBS, COR, DT_ANOTACAO, TP_ANOTACAO, CD_USUARIO_CADASTRO, HR_CADASTRO, CD_USUARIO_ULT_ALT, HR_ULT_ALT)
                    (SELECT $nextval AS CD_ANOTACAO,
                    '$leito' AS CD_LEITO,
                    (SELECT DISTINCT pc.Cd_Paciente FROM dbamv.PACIENTE pc
                    INNER JOIN dbamv.atendime at
                        ON at.cd_paciente = pc.cd_paciente
                    INNER JOIN dbamv.mov_int mov
                        ON mov.cd_atendimento = at.cd_atendimento
                    INNER JOIN dbamv.leito lt
                    ON lt.cd_leito = mov.cd_leito
                    WHERE at.dt_alta is null
                    AND lt.ds_enfermaria = '$leito'
                    AND lt.tp_ocupacao in ('I','O')) AS CD_PACIENTE,
                    (SELECT lt.cd_unid_int FROM dbamv.LEITO lt
                        WHERE lt.ds_enfermaria = '$leito') AS CD_UNID_INT,
                    '$observacao' AS OBS,
                    '$cor' AS COR,
                    TO_DATE('$dia','YYYY-MM-DD HH24:MI') AS DT_ANOTACAO,
                    '$tipo' AS TP_ANOTACAO,
                    '$usuario' AS CD_USUARIO_CADASTRO,
                    SYSDATE AS HR_CADASTRO,
                    NULL AS CD_USUARIO_ULT_ALT,
                    NULL AS HR_ULT_ALT FROM DUAL)";

    $result = oci_parse($conn_ora, $consulta);
    oci_execute($result);


?>