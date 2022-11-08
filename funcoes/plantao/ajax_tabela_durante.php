<?php 
    include '../../conexao.php';

    session_start();

    $var_exibir_dt = $_GET['data'];

    $var_exibir_pp = $_GET['unid_int'];

    $ck_temp = $_GET['sn_temp'];

    $ck_res = $_GET['sn_reserva'];


    @$con_exibir_durante = "SELECT dur.CD_DURANTE, 
                        TO_CHAR(dur.HR_CADASTRO,'DD/MM/YYYY HH24:MI:SS') AS HR_CADASTRO,  
                        usu.CD_USUARIO, usu.NM_USUARIO
                        FROM passagem_plantao.DURANTE dur
                        INNER JOIN dbasgu.USUARIOS usu
                            ON usu.CD_USUARIO = dur.CD_USUARIO_CADASTRO
                        WHERE TO_DATE('$var_exibir_dt','YYYY-MM-DD') = TRUNC(dur.DT_PLANTAO)
                        AND dur.CD_UNID_INT = $var_exibir_pp
                        ORDER BY 1 DESC";

    @$result_exibir_dur = oci_parse($conn_ora,$con_exibir_durante);

    @oci_execute($result_exibir_dur);         

    @$var_bloq_cad_dur = "SELECT COUNT (dur.dt_plantao) AS QTD
                        FROM passagem_plantao.durante dur
                        WHERE dur.cd_usuario_cadastro = '$var_user'
                        and dur.cd_unid_int = '$var_exibir_pp'
                        and TO_CHAR(dur.dt_plantao, 'DD/MM/YYYY') = '$var_exibir_dt'";

                        
    @$result_bloq_cad_dur = oci_parse($conn_ora,$var_bloq_cad_dur);

    @oci_execute($result_bloq_cad_dur);

    @$row_quantidade = oci_fetch_array($result_bloq_cad_dur);

    @$qtd_durante = $row_quantidade['QTD'];
    
?>

<?php 
    if($ck_temp == 'S'){
        include '../../configuracao/modal_pp.php';

    }else{
        $aux_sel = date('d/m/Y', strtotime($var_exibir_dt));
        $hoje = date('d/m/Y'); 
    
        if($aux_sel == $hoje AND $qtd_durante == 0){
    
            include '../../configuracao/modal_pp.php';
    
        }else{
    
            //echo 'Não é Igual';
        
        }
    }

    

    

?>

<div class="div_br"> </div>
<div class="div_br"> </div>
<?php if($ck_res == 'N'){ ?>
<div class="table-responsive col-md-7" style="padding: 0px !important;">

    <table class="table table-striped" cellspacing="0" cellpadding="0">
        
        <thead>

            <tr>

                <th style="text-align: center;">Hora Cadastro</th>
                <th style="text-align: center;">Login</th>
                <th style="text-align: center;">Nome</th>
                <th style="text-align: center;">Ações</th>

            </tr>

        </thead>

        <tbody>

            <?php

                while(@$row_dur = oci_fetch_array($result_exibir_dur)){

                echo'</tr>';

                    echo '<td class="align-middle" style="text-align: center;">' . $row_dur['HR_CADASTRO'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row_dur['CD_USUARIO'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row_dur['NM_USUARIO'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">';

                    $var_cod_dur = $row_dur['CD_DURANTE'];
                    
                    $aux_sel = date('d/m/Y', strtotime($var_exibir_dt));
                    $hoje = date('d/m/Y'); 
                    $usuario_log = $row_dur['CD_USUARIO'];
                    $usu_session = $_SESSION['usuarioLogin'];
                    
                    if($aux_sel == $hoje AND $usuario_log == $usu_session ){?>
                        <a class="btn btn-primary" onclick="ajax_editar_anotacao('<?php echo $row_dur['CD_DURANTE'] ?>')" >
                        <i class="fa-solid fa-pen"></i></a>
                        <a class="btn btn-adm" onclick="ajax_apagar_anotacao('<?php echo $row_dur['CD_DURANTE'] ?>')">
                        <i class="fas fa-trash"></i></a>

                    <?php
                    
                    }
                    ?>
                    <a class="btn btn-primary" onclick="ajax_visu_durante('<?php echo  $row_dur['CD_DURANTE'] ?>')">
                    <i class="fa-solid fa-eye"></i></a>
                <?php 
                echo'</tr>';
                }
                            
            ?>

        </tbody>

    </table>

</div>
<?php } 
 
    include '../../configuracao/modal_passagem/visu_durante.php';
    
    include '../../configuracao/modal_passagem/editar_dur.php';

    


?>

<script>
    $(document).ready(function() {
        carregamento(1);
    });

    function ajax_editar_anotacao(cd_dur){
        $('#id_editar_dur').modal('show');
        $('#div_editar').load('configuracao/modal_passagem/ajax/ajax_modal_editar.php?cd_dur='+ cd_dur);

    }

    function ajax_visu_durante(cd_dur){
        $('#div_visu_dur').load('configuracao/modal_passagem/ajax/ajax_modal_visu.php?cd_dur='+ cd_dur);
        $('#id_visu_dur').modal('show');

    }
</script>