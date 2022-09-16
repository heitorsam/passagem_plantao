

<?php 
    include '../../conexao.php';

    session_start();

    $var_exibir_dt = $_GET['data'];

    $var_exibir_pp = $_GET['unid_int'];

    $ck_temp = $_GET['sn_reserva'];

    $con_exibir_paciente="SELECT lt.ds_leito,
                                    TO_CHAR(mi.hr_mov_int, 'DD/MM/YYYY HH24:MI') as entrada,
                                    CASE
                                    WHEN atd.cd_atendimento IS NULL THEN
                                    'RESERVA SEM ATENDIMENTO'
                                    ELSE
                                    pac.NM_PACIENTE
                                    END AS NM_PACIENTE,
                                    pac.TP_SEXO,
                                    pac.CD_PACIENTE,
                                    FLOOR((SYSDATE - pac.DT_NASCIMENTO) / 365.242199) AS IDADE,
                                    lt.CD_LEITO,
                                    lt.DS_RESUMO,
                                    unid.DS_UNID_INT,
                                    lt.CD_UNID_INT,
                                    mi.cd_atendimento,
                                    esp.ds_especialid
                                FROM dbamv.LEITO lt
                                INNER JOIN dbamv.MOV_INT mi
                                ON mi.cd_leito = lt.cd_leito
                                LEFT JOIN dbamv.atendime atd
                                ON atd.cd_atendimento = mi.cd_atendimento
                                LEFT JOIN dbamv.paciente pac
                                ON pac.cd_paciente = atd.cd_paciente
                                INNER JOIN dbamv.UNID_INT unid
                                ON unid.CD_UNID_INT = lt.CD_UNID_INT
                                INNER JOIN dbamv.especialid esp
                                ON esp.cd_especialid = atd.cd_especialid
                                WHERE mi.tp_mov = 'R'
                                AND lt.cd_unid_int = $var_exibir_pp
                                AND lt.tp_ocupacao = 'R'
                                AND mi.cd_mov_int in (SELECT cd_mov_int
                                                        FROM dbamv.mov_int
                                                    WHERE TRUNC(dt_mov_int) between TRUNC(sysdate - 1) and
                                                            TRUNC(sysdate)
                                                        AND tp_mov = 'R')
                                ORDER BY lt.DS_RESUMO ASC
                                ";

    $result_exibir_pac = oci_parse($conn_ora,$con_exibir_paciente);

    oci_execute($result_exibir_pac);

?>

<div class="table-responsive col-md-12" onload="carregamento()" style="padding: 0px !important;">

<table class="table table-striped"  cellspacing="0" cellpadding="0">
        
        <thead>

            <tr>

                <th style="text-align: center;">Entrada Prevista</th>
                <th style="text-align: center;">Atendimento</th>
                <th style="text-align: center;">Prontuario</th>
                <th style="text-align: center;">Paciente</th>
                <th style="text-align: center;">Sexo</th>
                <th style="text-align: center;">Idade</th>
                <th style="text-align: center;">Especialidade</th>
                <th style="text-align: center;">Resumo</th>
                <th style="text-align: center;">Unidade de Internação</th>
                <th style="text-align: center;">Ações</th>

            </tr>

        </thead>

        <tbody>

            <?php

                while(@$row_exibir_pac = oci_fetch_array($result_exibir_pac)){

                echo'</tr>';

                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['ENTRADA'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">' . @$row_exibir_pac['CD_ATENDIMENTO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['CD_PACIENTE'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['NM_PACIENTE'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['TP_SEXO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['IDADE'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['DS_ESPECIALID'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['DS_RESUMO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['DS_UNID_INT'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">';  
                if(@$row_exibir_pac['CD_ATENDIMENTO'] == ''){
                    echo '<button disabled type="button" class="btn btn-primary"> <i class="fa-solid fa-eye"></i>';
                    
                    
                }else{   
                    ?>
                <button type="button" class="btn btn-primary" onclick="modal_paciente('<?php echo $row_exibir_pac['CD_PACIENTE'] ?>', '<?php echo @$row_exibir_pac['CD_ATENDIMENTO'] ?>', '<?php echo $var_exibir_dt ?>')" data-toggle="modal" data-target="#modal_paciente">
                <i class="fa-solid fa-eye"></i>
                <?php } ?>
                </button>
                    

                <?php echo '</td>';
             

                    

                echo'</tr>';
                }
                include '../../configuracao/modal_paciente.php';    
            ?>

        </tbody>

    </table>

    </table>

</div>

<script>
    $(document).ready(function() {
        carregamento(2);
    });
    function modal_paciente(id, atd, dt) {
        $('#div_modal_paciente').load('funcoes/plantao/ajax_modal_paciente.php?id='+ id +'&atd='+ atd +'&dt='+ dt);
    }

</script>

