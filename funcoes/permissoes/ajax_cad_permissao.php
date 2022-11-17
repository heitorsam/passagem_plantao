<?php

    session_start();
    include '../../conexao.php';

    $var_adc_frm_cd_usuario = $_POST['cd_usuario'];
    $var_adc_frm_unid_inter = $_POST['setor'];
    $var_adc_user_log = $_SESSION['usuarioLogin'];

    $qtd_lista = "SELECT COUNT(*) AS QTD
                    FROM dbasgu.USUARIOS usu
                        WHERE usu.sn_ativo = 'S'
                    AND CD_USUARIO = '$var_adc_frm_cd_usuario'
                    ORDER BY 1 ASC
                                ";
                $result_lista = oci_parse($conn_ora, $qtd_lista);																									

                //EXECUTANDO A CONSULTA SQL (ORACLE)
                oci_execute($result_lista);   
                $QTD = oci_fetch_array($result_lista);       






    if($var_adc_frm_cd_usuario != '' && $QTD['QTD'] != 0){
        $consulta_unid_inter = "INSERT INTO passagem_plantao.PERMISSOES
                                SELECT passagem_plantao.Seq_Permissoes.NEXTVAL CD_PERMISSAO,
                                '$var_adc_frm_cd_usuario' AS CD_USUARIO,
                                '$var_adc_frm_unid_inter' AS CD_UNID_INT,
                                '$var_adc_user_log' AS CD_USUARIO_CADASTRO,
                                SYSDATE HR_CADASTRO,
                                NULL CD_USUARIO_ULT_ALT,
                                NULL HR_ULT_ALT
                                FROM DUAL";

        //UNIFICANDO CONSULTA COM A CONEXAO
        $result_unid = oci_parse($conn_ora,$consulta_unid_inter);

        //EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
        $valida = oci_execute($result_unid);

        if(!$valida){
        
        }else{
            $con_exibir_permi ="SELECT perm.CD_USUARIO, perm.CD_UNID_INT, UI.DS_UNID_INT, perm.CD_PERMISSAO
            FROM passagem_plantao.permissoes perm
            INNER JOIN dbamv.unid_int UI
                ON UI.CD_UNID_INT = perm.CD_UNID_INT
            WHERE perm.CD_USUARIO = '$var_adc_frm_cd_usuario'
            ORDER BY ui.DS_UNID_INT ASC";

            $result_exibir_permi = oci_parse($conn_ora,$con_exibir_permi);

            oci_execute($result_exibir_permi);
        }
    }

?>


