<?php
    include '../../conexao.php';
    session_start();
 
    $var_frm_usuario = $_GET['cd_usuario'];
    $_SESSION['CD_USUARIO'] = '';

    $consulta_usuario = "SELECT usu.CD_USUARIO, usu.NM_USUARIO,
    prest.CD_TIP_PRESTA, tp.NM_TIP_PRESTA
    FROM dbamv.PRESTADOR prest
    INNER JOIN dbamv.TIP_PRESTA tp
    ON tp.CD_TIP_PRESTA = prest.CD_TIP_PRESTA
    INNER JOIN dbasgu.USUARIOS usu
    ON usu.CD_PRESTADOR = prest.CD_PRESTADOR
    WHERE usu.CD_USUARIO = UPPER('$var_frm_usuario')
    AND prest.TP_SITUACAO = 'A'
    AND prest.CD_TIP_PRESTA = 4
    ORDER BY prest.NM_PRESTADOR ASC";

    $result_usuario = oci_parse($conn_ora,$consulta_usuario);

    oci_execute($result_usuario);

    $row_usu = oci_fetch_array($result_usuario);

    $var_cod = @$row_usu['CD_USUARIO'];
    $var_nome = @$row_usu['NM_USUARIO'];
    $var_funcao = @$row_usu['NM_TIP_PRESTA'];
    if($var_cod != ''){
        $_SESSION['CD_USUARIO'] = $var_cod;
    }

?>

<div class='col-md-2'>

    Usuário:
    <input class='form-control' value="<?php echo $var_cod ?>" id="usuario" type='text' readonly>

</div>

<div class='col-md-3'>

    Nome:
    <input class='form-control' value="<?php echo $var_nome ?>" id="nome" type='text' readonly>

</div>

<div class='col-md-2'>

    Função:
    <input class='form-control' value="<?php echo $var_funcao ?>" id="funcao" type='text' readonly>

</div>

<br>

<script>
    $(document).ready(function() {
        carregamento(1);
    });
</script>



