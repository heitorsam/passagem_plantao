<?php

$con_exibir_permi ="SELECT perm.CD_USUARIO, perm.CD_UNID_INT, UI.DS_UNID_INT, perm.CD_PERMISSAO
                    FROM passagem_plantao.permissoes perm
                    INNER JOIN dbamv.unid_int UI
                        ON UI.CD_UNID_INT = perm.CD_UNID_INT
                    WHERE perm.CD_USUARIO = '$var_cod'
                    ORDER BY ui.DS_UNID_INT ASC";

$result_exibir_permi = oci_parse($conn_ora,$con_exibir_permi);

oci_execute($result_exibir_permi);

?>

    <div class="table-responsive col-md-12" style="padding: 0px !important;">

        <table class="table table-striped" cellspacing="0" cellpadding="0">

            <thead>

                <tr>

                <th style="text-align: center;">Usuario</th>
                <th style="text-align: center;">Codigo Unidade</th>
                <th style="text-align: center;">Unidade de Internacao</th>
                <th style="text-align: center;">Opções</th>

                </tr>

            </thead>

            <tbody>

                <?php
                
                while($row_exibir = oci_fetch_array($result_exibir_permi)){
                
                    echo'</tr>';
                    
                    echo '<td class="align-middle" style="text-align: center;">' . $row_exibir['CD_USUARIO'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row_exibir['CD_UNID_INT'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row_exibir['DS_UNID_INT'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">';
                    echo '<a type="button" class="btn btn-adm"
                        href="configuracao/deletar_permissoes.php?codigo='. $row_exibir['CD_PERMISSAO'] . '">'. ' 
                        <i class="fa-solid fa-trash-can"></i></a>'; 
                    echo '</td>';
                }

                
                
                ?>

            </tbody>

        </table>


    </div>