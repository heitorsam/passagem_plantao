

<?php 
    include '../../conexao.php';

    session_start();


    $var_exibir_pp = $_GET['unid_int'];

    $con_exibir_paciente="SELECT 
                        atd.CD_ATENDIMENTO, 
                        atd.CD_PACIENTE, 
                        pac.NM_PACIENTE, 
                        pac.TP_SEXO, 
                        FLOOR((SYSDATE - pac.DT_NASCIMENTO) / 365.242199) AS IDADE,
                        pac.NM_MAE,
                        lt.CD_LEITO, 
                        lt.DS_RESUMO,
                        lt.CD_UNID_INT, 
                        uni.DS_UNID_INT
                        FROM dbamv.ATENDIME atd
                        INNER JOIN dbamv.PACIENTE pac
                            ON pac.CD_PACIENTE = atd.CD_PACIENTE
                        INNER JOIN dbamv.LEITO lt
                            ON lt.CD_LEITO = atd.CD_LEITO
                        INNER JOIN dbamv.UNID_INT uni
                            ON uni.CD_UNID_INT = lt.CD_UNID_INT
                        WHERE lt.CD_UNID_INT = $var_exibir_pp
                        AND atd.DT_ALTA IS NULL
                        AND atd.DT_ALTA_MEDICA IS NULL
                        ORDER BY lt.DS_RESUMO ASC";

    $result_exibir_pac = oci_parse($conn_ora,$con_exibir_paciente);

    oci_execute($result_exibir_pac);

?>

<div class="row">
    <?php

        while($row_exibir_pac = oci_fetch_array($result_exibir_pac)){

    ?>
        
            <div class="col-md-12 fnd_azul" id="div_<?php echo $row_exibir_pac['CD_PACIENTE']; ?>">
                <?php echo '<div style="display: block" id="seta-'. $row_exibir_pac['CD_PACIENTE'].'" onclick="abrir_div('. $row_exibir_pac['CD_PACIENTE'] .')">
                        '. $row_exibir_pac['CD_ATENDIMENTO'].' - '. $row_exibir_pac['NM_PACIENTE'].'    
                        <h5><i class="fas fa-chevron-right" ></i></h5>
                        </div>
                        <div style="display: none" id="baixo-'. $row_exibir_pac['CD_PACIENTE'].'" onclick="abrir_div('. $row_exibir_pac['CD_PACIENTE'] .')">
                        '. $row_exibir_pac['CD_ATENDIMENTO'].' - '. $row_exibir_pac['NM_PACIENTE'].'   
                            <h5><i class="fas fa-chevron-down"></i></h5>
                        </div>';
                ;?>
            </div>
            <div style="display: none" class="col-md-12" id="div_h_<?php echo $row_exibir_pac['CD_PACIENTE']; ?>">
                
            </div>
        
        
    
    <?php 
        }
    ?>
</div>
<script>

    function abrir_div(id){
        var seta = document.getElementById('seta-'+id);
        if(seta.style.display == 'block'){
            document.getElementById('seta-'+id).style.display = 'none';
            document.getElementById('baixo-'+id).style.display = 'block';
            document.getElementById('div_h_'+id).style.display = 'block';
            $('#div_h_'+id).load('funcoes/historico/modal_passagem/ajax/ajax_tabela_obs_especial.php?id='+ id);

        }else{
            document.getElementById('seta-'+id).style.display = 'block';
            document.getElementById('baixo-'+id).style.display = 'none';
            document.getElementById('div_h_'+id).style.display = 'none';

        }
    }
</script>

