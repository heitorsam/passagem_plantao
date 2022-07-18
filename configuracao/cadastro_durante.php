<?php

session_start();
include '../conexao.php';

$var_frm_unid= $_POST['frm_unid'];
$var_frm_ep_sn = $_POST['frm_ep_sn'];
$var_frm_equip_desc = $_POST['frm_equip_desc'];
$var_frm_ce_sn = $_POST['frm_ce_sn'];
$var_frm_rl_sn = $_POST['frm_rl_sn'];
$var_frm_lac_desc = $_POST['frm_lac_desc'];
$var_frm_lt_sn = $_POST['frm_lt_sn'];
$var_frm_lt_motivo = $_POST['frm_lt_motivo'];
$var_frm_ft_mm = $_POST['frm_ft_mm'];
$var_frm_mm_motivo = $_POST['frm_mm_motivo'];
$var_frm_farm_sn = $_POST['frm_farm_sn'];
$var_frm_pp_sn = $_POST['frm_pp_sn'];
$var_frm_con_desc = $_POST['frm_con_desc'];
$var_frm_ip_sn = $_POST['frm_ip_sn'];
$var_frm_ip_desc = $_POST['frm_ip_desc'];

$var_adc_user_log = $_SESSION['usuarioLogin'];


echo $cons_pp = "INSERT INTO passagem_plantao.durante
                    SELECT passagem_plantao.seq_durante.NEXTVAL CD_DURANTE,
                    SYSDATE AS DT_PLANTAO,
                    '$var_frm_unid' AS CD_UNID_INT,
                    '$var_frm_ep_sn' AS EQUIP_SN,
                    '$var_frm_equip_desc' AS EQUIP_DESC,
                    '$var_frm_ce_sn' AS CAR_SN,
                    '$var_frm_rl_sn' AS REP_LAC_SN,
                    '$var_frm_lac_desc' AS LACRE_DESC,
                    '$var_frm_lt_sn' AS LT_BLOQ_SN,
                    '$var_frm_lt_motivo' AS LT_MOTIVO_DESC,
                    '$var_frm_ft_mm' AS FT_MM_SN,
                    '$var_frm_mm_motivo' AS MM_DESC,
                    '$var_frm_farm_sn' as FARM_SN,
                    '$var_frm_pp_sn' AS PPF_SN,
                    '$var_frm_con_desc' AS CONDUTA_DESC,
                    '$var_frm_ip_sn'AS IP_SN,
                    '$var_frm_ip_desc' AS IP_DESC,
                    '$var_adc_user_log' AS CD_USUARIO_CADASTRO,
                    SYSDATE HR_CADASTRO,
                    NULL CD_USUARIO_ULT_ALT,
                    NULL HR_ULT_ALT
                    FROM DUAL";

//UNIFICANDO CONSULTA COM A CONEXAO
$result_pp = oci_parse($conn_ora,$cons_pp);

//EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
$valida = oci_execute($result_pp);


if(!$valida){
    
    $erro =  oci_error($result_pp);
    $_SESSION['msgerro'] = htmlentities($erro['message']);

}else{

    $_SESSION['msg'] = 'Salvo com Sucesso!';
}


header("Location:../estrutura_passagem_plantao.php");

?>