<?php

    $var_usu = $_SESSION['usuarioLogin'];

    echo $consulta_unid_inter_pp = "SELECT ui.CD_UNID_INT, ui.DS_UNID_INT
                                    FROM dbamv.unid_int ui
                                    WHERE ui.SN_ATIVO ='S'
                                    AND ui.CD_UNID_INT IN (SELECT perm.CD_UNID_INT
                                                        FROM passagem_plantao.permissoes perm
                                                        WHERE perm.CD_USUARIO = '$var_usu') 
                                    AND ui.CD_UNID_INT = $var_exibir_pp

                                    UNION ALL
    
                                    SELECT res.*
                                    FROM(SELECT ui.CD_UNID_INT, ui.DS_UNID_INT
                                         FROM dbamv.unid_int ui
                                         WHERE ui.SN_ATIVO ='S'
                                         AND ui.CD_UNID_INT IN (SELECT perm.CD_UNID_INT
                                                                FROM passagem_plantao.permissoes perm
                                                                WHERE perm.CD_USUARIO = '$var_usu') 
                                         AND ui.CD_UNID_INT <> $var_exibir_pp
                                         ORDER BY ui.CD_UNID_INT ASC) res";

    //UNIFICANDO CONSULTA COM A CONEXAO
    $result_unid_pp = oci_parse($conn_ora,$consulta_unid_inter_pp);

    //EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
    oci_execute($result_unid_pp);

    if($var_exibir_pp == 0){

        echo "<option value=''>Selecione</option>";

    }

    while($row_unid_pp = oci_fetch_array($result_unid_pp)){

        echo "<option value='" . $row_unid_pp['CD_UNID_INT'] . "'>" . $row_unid_pp['DS_UNID_INT'] . "</option>";
    }

?>