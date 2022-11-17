<?php
    include '../../conexao.php';
    session_start();
 
    $var_frm_usuario = $_GET['cd_usuario'];
    $_SESSION['CD_USUARIO'] = '';

    $qtd_lista = "SELECT COUNT(*) AS QTD
                                    FROM dbasgu.USUARIOS usu
                                        WHERE usu.sn_ativo = 'S'
                                    AND CD_USUARIO = '$var_frm_usuario'
                                    ORDER BY 1 ASC
                                ";
                $result_lista = oci_parse($conn_ora, $qtd_lista);																									

                //EXECUTANDO A CONSULTA SQL (ORACLE)
                oci_execute($result_lista);   
                $QTD = oci_fetch_array($result_lista);  
    if($QTD['QTD'] != 0){
        $consulta_usuario = "SELECT usu.CD_USUARIO,
                                            usu.NM_USUARIO,
                                            usu.ds_observacao
                                    FROM dbasgu.USUARIOS usu
                                    WHERE usu.CD_USUARIO = UPPER('$var_frm_usuario')";

        $result_usuario = oci_parse($conn_ora,$consulta_usuario);

        oci_execute($result_usuario);

        $row_usu = oci_fetch_array($result_usuario);
    }
        $var_cod = @$row_usu['CD_USUARIO'];
        $var_nome = @$row_usu['NM_USUARIO'];
        $var_funcao = @$row_usu['DS_OBSERVACAO'];
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
<!--
<script>
    $(document).ready(function() {
        carregamento(1);
    });
</script>-->



