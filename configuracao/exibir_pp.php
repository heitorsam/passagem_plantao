
<?php

    $con_exibir_paciente="SELECT 
                          lt_set.CD_ATENDIMENTO, 
                          lt_set.CD_PACIENTE, 
                          pac.NM_PACIENTE, 
                          pac.TP_SEXO, 
                          FLOOR((SYSDATE - pac.DT_NASCIMENTO) / 365.242199) AS IDADE,
                          pac.NM_MAE,
                          atd.CD_LEITO, 
                          lt_set.DS_RESUMO,
                          lt_set.CD_UNID_INT, 
                          uni.DS_UNID_INT
                          FROM dbamv.ATENDIME atd
                          INNER JOIN (SELECT mi.CD_ATENDIMENTO, atd.CD_PACIENTE, mi.CD_LEITO,
                                      mi.CD_LEITO_ANTERIOR, lt.DS_LEITO,
                                      unid.CD_UNID_INT, unid.DS_UNID_INT,
                                      st.CD_SETOR, st.NM_SETOR, lt.DS_RESUMO,
                                      mi.HR_MOV_INT AS DT_ENTRADA,
                                      NVL(NVL((SELECT MIN(HR_MOV_INT) -1/(24*60*60)
                                          FROM MOV_INT
                                          WHERE CD_ATENDIMENTO = mi.CD_ATENDIMENTO
                                          AND CD_LEITO_ANTERIOR = mi.CD_LEITO
                                          AND HR_MOV_INT >= mi.HR_MOV_INT), atd.DT_ALTA),SYSDATE) AS DT_SAIDA
                                      FROM dbamv.MOV_INT mi
                                      INNER JOIN dbamv.LEITO lt
                                      ON lt.CD_LEITO = mi.CD_LEITO
                                      INNER JOIN dbamv.ATENDIME atd
                                      ON atd.CD_ATENDIMENTO = mi.CD_ATENDIMENTO
                                      INNER JOIN dbamv.UNID_INT unid
                                      ON unid.CD_UNID_INT = lt.CD_UNID_INT
                                      INNER JOIN dbamv.SETOR st
                                      ON st.CD_SETOR = unid.CD_SETOR
                                      WHERE mi.CD_ATENDIMENTO IS NOT NULL
                                      AND mi.TP_MOV IN ('I','O')
                          ) lt_set
                          ON atd.CD_ATENDIMENTO = lt_set.CD_ATENDIMENTO
                          INNER JOIN dbamv.PACIENTE pac
                          ON pac.CD_PACIENTE = lt_set.CD_PACIENTE
                          INNER JOIN dbamv.UNID_INT uni
                          ON uni.CD_UNID_INT = lt_set.CD_UNID_INT
                          WHERE lt_set.CD_UNID_INT = $var_exibir_pp
                          AND '$var_exibir_dt'  BETWEEN lt_set.DT_ENTRADA AND lt_set.DT_SAIDA";

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
                    echo '<td class="align-middle" style="text-align: center;">';

                        include 'configuracao/modal_paciente.php';

                     echo '</td>';
                 

                        

                    echo'</tr>';
                    }
                                
                ?>

            </tbody>

        </table>

    </div>