
<?php

    $con_exibir_paciente="SELECT atd.CD_ATENDIMENTO, 
                                atd.CD_PACIENTE, 
                                pac.NM_PACIENTE, 
                                pac.TP_SEXO, 
                                FLOOR((SYSDATE - pac.DT_NASCIMENTO) / 365.242199) AS IDADE,
                                pac.NM_MAE,
                                atd.CD_LEITO, 
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
                            WHERE uni.CD_UNID_INT = $var_exibir_pp
                            AND atd.CD_LEITO IS NOT NULL
                            AND atd.DT_ALTA IS NULL
                            AND atd.DT_ALTA_MEDICA IS NULL";

    $result_exibir_pac = oci_parse($conn_ora,$con_exibir_paciente);

    @oci_execute($result_exibir_pac);

?>

    <div class="table-responsive col-md-12" style="padding: 0px !important;">

        <table class="table table-striped" cellspacing="0" cellpadding="0">
            
            <thead>

                <tr>

                    <th style="text-align: center;">Atendimento</th>
                    <th style="text-align: center;">Prontuario</th>
                    <th style="text-align: center;">Paciente</th>
                    <th style="text-align: center;">Sexo</th>
                    <th style="text-align: center;">Idade</th>
                    <th style="text-align: center;">Mãe</th>
                    <th style="text-align: center;">Leito</th>
                    <th style="text-align: center;">Resumo</th>
                    <th style="text-align: center;">Unidade de Internação</th>
                    <th style="text-align: center;">Ações</th>
                    <th style="text-align: center;">Status</th>

                </tr>

            </thead>

            <tbody>

                <?php

                    while(@$row_exibir_pac = oci_fetch_array($result_exibir_pac)){

                    echo'</tr>';

                    echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['CD_ATENDIMENTO'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['CD_PACIENTE'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['NM_PACIENTE'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['TP_SEXO'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['IDADE'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['NM_MAE'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['CD_LEITO'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['DS_RESUMO'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_pac['DS_UNID_INT'] . '</td>';

                    echo'</tr>';
                    }
                                
                ?>

            </tbody>

        </table>

    </div>