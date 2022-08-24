

<?php 
    include '../../conexao.php';

    session_start();

    $var_exibir_dt = $_GET['data'];

    $var_exibir_pp = $_GET['unid_int'];

    $ck_temp = $_GET['sn_reserva'];

    $con_exibir_paciente="SELECT lt.ds_leito,
                                TO_CHAR(mi.hr_mov_int, 'DD/MM/YYYY'),
                                pc.nm_paciente,
                                pc.NM_PACIENTE,
                                pc.TP_SEXO,
                                at.CD_PACIENTE,
                                FLOOR((SYSDATE - pc.DT_NASCIMENTO) / 365.242199) AS IDADE,
                                pc.NM_MAE,
                                lt.CD_LEITO,
                                lt.DS_RESUMO,
                                unid.DS_UNID_INT,
                                lt.CD_UNID_INT
                            FROM dbamv.LEITO lt
                            INNER JOIN dbamv.MOV_INT mi
                            ON mi.cd_leito = lt.cd_leito
                            INNER JOIN dbamv.atendime at
                            ON mi.cd_atendimento = at.cd_atendimento
                            INNER JOIN dbamv.paciente pc
                            ON pc.cd_paciente = at.cd_paciente
                            INNER JOIN dbamv.UNID_INT unid
                            ON unid.CD_UNID_INT = lt.CD_UNID_INT

                            WHERE lt.tp_situacao <> 'I'
                            AND lt.tp_ocupacao = 'R'
                            AND lt.cd_unid_int = 1
                            AND TO_CHAR(mi.hr_mov_int, 'YYYY-MM-DD') = '$var_exibir_dt'
                        ORDER BY lt.DS_RESUMO ASC";

    $result_exibir_pac = oci_parse($conn_ora,$con_exibir_paciente);

    oci_execute($result_exibir_pac);

?>

<div class="table-responsive col-md-12" onload="carregamento()" style="padding: 0px !important;">

    <table class="table table-striped"  cellspacing="0" cellpadding="0">
        
        <thead>

            <tr>
                <th style="text-align: center;">Prontuario</th>
                <th style="text-align: center;">Paciente</th>
                <th style="text-align: center;">Sexo</th>
                <th style="text-align: center;">Idade</th>
                <th style="text-align: center;">Mãe</th>
                <th style="text-align: center;">Resumo</th>
                <th style="text-align: center;">Unidade de Internação</th>
            </tr>

        </thead>

        <tbody>

            <?php

                while(@$row_exibir_pac = oci_fetch_array($result_exibir_pac)){

                echo'</tr>';

                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['CD_PACIENTE'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['NM_PACIENTE'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['TP_SEXO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['IDADE'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['NM_MAE'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['DS_RESUMO'] . '</td>';
                echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['DS_UNID_INT'] . '</td>';
             

                    

                echo'</tr>';
                }
                include '../../configuracao/modal_paciente.php';    
            ?>

        </tbody>

    </table>

</div>

<script>
    $(document).ready(function() {
        carregamento(2);
    });


</script>

