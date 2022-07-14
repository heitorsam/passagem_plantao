<?php

    $consulta_unid_inter = "SELECT ui.CD_UNID_INT, ui.DS_UNID_INT
                          FROM dbamv.unid_int ui
                          WHERE ui.SN_ATIVO ='S'
                          AND ui.CD_UNID_INT NOT IN (SELECT perm.CD_UNID_INT
                                                     FROM passagem_plantao.permissoes perm
                                                     WHERE perm.CD_USUARIO = '$var_cod') 
                          ORDER BY ui.CD_UNID_INT ASC";

    //UNIFICANDO CONSULTA COM A CONEXAO
    $result_unid = oci_parse($conn_ora,$consulta_unid_inter);

    //EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
    oci_execute($result_unid);

    echo "<option value=''>Selecione</option>";

    while($row_unid = oci_fetch_array($result_unid)){

        echo "<option value='" . $row_unid['CD_UNID_INT'] . "'>" . $row_unid['DS_UNID_INT'] . "</option>";
    }

?>