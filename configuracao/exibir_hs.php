    <?php


        $con_exibir_hs="SELECT PPD.CD_DURANTE,
                        PPD.CD_UNID_INT, 
                        UI.DS_UNID_INT, 
                        PPD.CD_USUARIO_CADASTRO, 
                        USU.NM_USUARIO,
                        TO_CHAR(PPD.HR_CADASTRO, 'DD/MM/YYYY HH24:MI:SS') AS DIA
                        FROM passagem_plantao.durante PPD
                        INNER JOIN dbamv.unid_int UI
                            ON UI.CD_UNID_INT = PPD.CD_UNID_INT
                        INNER JOIN dbasgu.usuarios USU
                            ON PPD.CD_USUARIO_CADASTRO = USU.CD_USUARIO
                        WHERE PPD.CD_UNID_INT = '$var_unid_inter'
                        AND TO_CHAR(PPD.HR_CADASTRO, '/MM/YYYY') = TO_CHAR(TO_DATE('$var_date' || '-01', 'YYYY-MM-DD'),'/MM/YYYY')";



        $result_exibir_hs = oci_parse($conn_ora,$con_exibir_hs);

        @oci_execute($result_exibir_hs);


    ?>

    <div class="table-responsive col-md-12" style="padding: 0px !important;">
    
        <table class="table table-striped" cellspacing="0" cellpadding="0">

             <thead>

                <tr>

                    <th style="text-align: center;">Unidade de Internação</th>
                    <th style="text-align: center;">Usuario</th>
                    <th style="text-align: center;">Nome</th>
                    <th style="text-align: center;">Dia</th>
                    <th style="text-align: center;">Opções</th>


                </tr>

            </thead>

            <tbody>

                <?php

                    while(@$row_exibir_hs = oci_fetch_array($result_exibir_hs)){
                    
                        echo'</tr>';

                        echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_hs['DS_UNID_INT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_hs['CD_USUARIO_CADASTRO'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_hs['NM_USUARIO'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_exibir_hs['DIA'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">';
                        echo '<a type="button" class="btn btn-adm"
                        href="cons_hs.php?codigo='. $row_exibir_hs['CD_DURANTE'] . '&cod_int='. $row_exibir_hs['CD_UNID_INT'] .'">'. ' 
                        <i class="fa-solid fa-paper-plane"></i></a>'; 
                         echo '</td>';

                        echo'</tr>';
                    }
                ?>

            </tbody>

        </table>
            

    </div>
