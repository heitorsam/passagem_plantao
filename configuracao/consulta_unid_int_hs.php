<?php

    $var_usu = $_SESSION['usuarioLogin'];

    $consulta_unid_inter_hs = "SELECT ui.CD_UNID_INT, ui.DS_UNID_INT
                               FROM dbamv.unid_int ui
                               WHERE ui.SN_ATIVO ='S'
                               AND ui.CD_UNID_INT IN (SELECT perm.CD_UNID_INT
                                                      FROM passagem_plantao.permissoes perm
                                                      WHERE perm.CD_USUARIO = '$var_usu') 
                          ORDER BY ui.CD_UNID_INT ASC";

    //UNIFICANDO CONSULTA COM A CONEXAO
    $result_unid_hs = oci_parse($conn_ora,$consulta_unid_inter_hs);

    //EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
    oci_execute($result_unid_hs);

    echo "<option value=''>Selecione</option>";

    while($row_unid_hs = oci_fetch_array($result_unid_hs)){

        echo "<option value='" . $row_unid_hs['CD_UNID_INT'] . "'>" . $row_unid_hs['DS_UNID_INT'] . "</option>";
    }

?>