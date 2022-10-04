

<?php 
    include '../../conexao.php';

    session_start();

    $var_exibir_dt = $_GET['data'];

    $var_exibir_pp = $_GET['unid_int'];

    $ck_temp = $_GET['sn_reserva'];

    $con_exibir_paciente="SELECT res.*
                               FROM(

                               
                               SELECT 
                               lt.DS_LEITO,
                               TO_CHAR(mi.HR_MOV_INT, 'DD/MM/YYYY HH24:MI') as ENTRADA,
                               CASE
                               WHEN atd.CD_ATENDIMENTO IS NULL THEN
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
                               mi.CD_ATENDIMENTO,
                               esp.DS_ESPECIALID
                               FROM dbamv.LEITO lt
                               
                               INNER JOIN dbamv.MOV_INT mi
                               ON mi.CD_LEITO = lt.CD_LEITO
                               
                               INNER JOIN dbamv.ATENDIME atd
                               ON atd.CD_ATENDIMENTO = mi.CD_ATENDIMENTO
                               
                               LEFT JOIN dbamv.PACIENTE pac
                               ON pac.CD_PACIENTE = atd.CD_PACIENTE
                               
                               INNER JOIN dbamv.UNID_INT unid
                               ON unid.CD_UNID_INT = lt.CD_UNID_INT
                               
                               LEFT JOIN dbamv.ESPECIALID esp
                               ON esp.CD_ESPECIALID = atd.CD_ESPECIALID
                               
                               WHERE mi.TP_MOV = 'R'
                               AND lt.TP_OCUPACAO = 'R'
                               
                               AND mi.CD_MOV_INT IN (SELECT CD_MOV_INT
                                                   FROM dbamv.MOV_INT
                                                   WHERE TRUNC(DT_MOV_INT) = TRUNC(SYSDATE)
                                                   AND TP_MOV = 'R')
                                AND mi.CD_MOV_INT IN (SELECT MAX(CD_MOV_INT)
                                FROM dbamv.MOV_INT
                                WHERE CD_LEITO = mi.CD_LEITO)

                                AND mi.CD_MOV_INT IN (SELECT MAX(CD_MOV_INT)
                                FROM dbamv.MOV_INT                                 
                                WHERE CD_ATENDIMENTO = atd.CD_ATENDIMENTO)
                               
                               UNION ALL
                                     
                               SELECT
                               lt.DS_LEITO,
                               TO_CHAR(rl.DT_PREV_INTERNACAO, 'DD/MM/YYYY HH24:MI') as ENTRADA,
                               NVL(pac.NM_PACIENTE,rl.NM_PACIENTE) AS NM_PACIENTE,
                               pac.TP_SEXO,
                               pac.CD_PACIENTE,
                               FLOOR((SYSDATE - pac.DT_NASCIMENTO) / 365.242199) AS IDADE,
                               lt.CD_LEITO,
                               lt.DS_RESUMO,
                               unid.DS_UNID_INT,
                               lt.CD_UNID_INT,
                               rl.CD_ATENDIMENTO,
                               esp.DS_ESPECIALID
                               
                                  FROM RES_LEI rl
                               
                               LEFT JOIN dbamv.LEITO lt
                               ON lt.CD_LEITO = rl.CD_LEITO
                               
                               LEFT JOIN dbamv.PACIENTE pac
                               ON pac.CD_PACIENTE = rl.CD_PACIENTE
                               
                               LEFT JOIN dbamv.UNID_INT unid
                               ON unid.CD_UNID_INT = lt.CD_UNID_INT
                               
                               LEFT JOIN dbamv.ESPECIALID esp
                               ON esp.CD_ESPECIALID = rl.CD_ESPECIALID
                                   
                               WHERE rl.CD_ATENDIMENTO IS NULL
                               AND TRUNC(SYSDATE) BETWEEN TRUNC(rl.DT_RESERVA) AND TRUNC(rl.DT_PREV_ALTA)) res
                               
                               WHERE res.CD_UNID_INT = $var_exibir_pp
                               ORDER BY res.NM_PACIENTE ASC";

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
                echo '<td class="align-middle" style="text-align: center;">';  ?>
                <button type="button" class="btn btn-primary" onclick="modal_paciente('<?php echo $row_exibir_pac['CD_PACIENTE'] ?>', '<?php echo @$row_exibir_pac['CD_ATENDIMENTO'] ?>', '<?php echo $var_exibir_dt ?>')" data-toggle="modal" data-target="#modal_paciente">
                <i class="fa-solid fa-eye"></i>
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

