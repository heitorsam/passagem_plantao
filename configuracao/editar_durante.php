<?php

session_start();
include '../conexao.php';

$cd_dur = $_POST['cd_dur'];
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

$var_adc_user_log = $_SESSION['usuarioLogin'];

//EXECUTANDO A CONSULTA NA CONEXAO INFORMADA


echo $cons_update = "UPDATE passagem_plantao.DURANTE op 
SET op.EQUIP_SN = '$var_frm_ep_sn',
op.EQUIP_DESC = '$var_frm_equip_desc',
op.CAR_SN = '$var_frm_ce_sn',
op.REP_LAC_SN = '$var_frm_rl_sn',
op.LACRE_DESC = '$var_frm_lac_desc',
op.LT_BLOQ_SN = '$var_frm_lt_sn',
op.LT_MOTIVO_DESC = '$var_frm_lt_motivo',
op.FT_MM_SN = '$var_frm_ft_mm',
op.MM_DESC = '$var_frm_mm_motivo',
op.FARM_SN = '$var_frm_farm_sn'

WHERE op.CD_DURANTE = $cd_dur";

//UNIFICANDO CONSULTA COM A CONEXAO
$result_update = oci_parse($conn_ora,$cons_update);

//EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
oci_execute($result_update);


?>