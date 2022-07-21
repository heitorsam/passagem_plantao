
<?php

    $con_exibir_durante = "SELECT TO_CHAR(dur.HR_CADASTRO,'DD/MM/YYYY HH24:MI:SS') AS HR_CADASTRO,  
                          usu.CD_USUARIO, usu.NM_USUARIO
                          FROM passagem_plantao.DURANTE dur
                          INNER JOIN dbasgu.USUARIOS usu
                            ON usu.CD_USUARIO = dur.CD_USUARIO_CADASTRO
                          WHERE TO_DATE('$var_exibir_dt','DD/MM/YYYY') = TRUNC(dur.DT_PLANTAO)";

    $result_exibir_dur = oci_parse($conn_ora,$con_exibir_durante);

    @oci_execute($result_exibir_dur);

?>

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
                        echo '<td class="align-middle" style="text-align: center;">' . '[VISUALIZAR] E [EXCLUIR]' . '</td>';
                        
                    echo'</tr>';
                    }
                                
                ?>

            </tbody>

        </table>

    </div>