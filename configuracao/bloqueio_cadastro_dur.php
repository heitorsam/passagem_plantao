<?php

$var_user = $_SESSION['usuarioLogin'];


include 'conexao.php';



    $var_bloq_cad_dur = "SELECT COUNT (dur.dt_plantao) AS QTD
                         FROM passagem_plantao.durante dur
                         WHERE dur.cd_usuario_cadastro = '$var_user'
                         and dur.cd_unid_int = '$var_unid_inter'
                         and TO_CHAR(dur.dt_plantao, 'DD/MM/YYYY') = '$var_dt_sel'";

                         
    @$result_bloq_cad_dur = oci_parse($conn_ora,$var_bloq_cad_dur);

    @oci_execute($result_bloq_cad_dur );

    echo $row_quantidade ['QTD'];

?>







<!--COLOCAR SESSÃO LOGIN SEGUNDA FEIRA, ADICIONAR VARIAVEL DE DATA.-->