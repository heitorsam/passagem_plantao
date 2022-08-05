<?php

session_start();
include '../conexao.php';

$var_frm_data= $_POST['frm_dta'];
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

$var_adc_user_log = $_SESSION['usuarioLogin'];


$nextval="SELECT passagem_plantao.seq_durante.NEXTVAL AS CD_durante
                        FROM DUAL";
$result_nextval = oci_parse($conn_ora,$nextval);

//EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
oci_execute($result_nextval);

$row_nextval = oci_fetch_array($result_nextval);

$nextval = $row_nextval['CD_DURANTE'];

echo $cons_pp = "INSERT INTO passagem_plantao.durante
                    SELECT $nextval AS CD_DURANTE,
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
                    NULL AS PPF_SN,
                    NULL AS CONDUTA_DESC,
                    NULL AS IP_SN,
                    NULL AS IP_DESC,
                    '$var_adc_user_log' AS CD_USUARIO_CADASTRO,
                    SYSDATE HR_CADASTRO,
                    NULL CD_USUARIO_ULT_ALT,
                    NULL HR_ULT_ALT
                    FROM DUAL";

//UNIFICANDO CONSULTA COM A CONEXAO
$result_pp = oci_parse($conn_ora,$cons_pp);

//EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
oci_execute($result_pp);

$cons_paciente = "UPDATE passagem_plantao.OBSERVACAO_PACIENTE op 
                    SET op.CD_DURANTE = $nextval 
                    WHERE op.CD_USUARIO_CRIACAO = '$var_adc_user_log' 
                    AND TO_CHAR(op.hr_criacao, 'DD/MM/YYYY') = TO_CHAR(SYSDATE,'DD/MM/YYYY')
                    AND op.CD_DURANTE IS NULL";

$result_paciente = oci_parse($conn_ora,$cons_paciente);

//EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
oci_execute($result_paciente);

$cons_intercorrencia = "UPDATE passagem_plantao.OBSERVACAO_INTERCORRENCIA oi 
                    SET oi.CD_DURANTE = $nextval 
                    WHERE oi.CD_USUARIO_CRIACAO = '$var_adc_user_log' 
                    AND TO_CHAR(oi.hr_criacao, 'DD/MM/YYYY') = TO_CHAR(SYSDATE,'DD/MM/YYYY')
                    AND oi.CD_DURANTE IS NULL";

$result_intercorrencia = oci_parse($conn_ora,$cons_intercorrencia);

//EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
oci_execute($result_intercorrencia);
?>