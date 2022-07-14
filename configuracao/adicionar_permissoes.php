<?php

session_start();
include '../conexao.php';

$var_adc_frm_cd_usuario = $_POST['frm_cd_usuario'];
$var_adc_frm_unid_inter = $_POST['frm_unid_inter'];
$var_adc_user_log = $_SESSION['usuarioLogin'];

echo $consulta_unid_inter = "INSERT INTO passagem_plantao.PERMISSOES
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
    
    $erro =  oci_error($result_unid);
    $_SESSION['msgerro'] = htmlentities($erro['message']);

}else{

    $_SESSION['msg'] = 'Cadastrado com Sucesso!';
}


header("Location:../estrutura_permissoes.php");

?>
