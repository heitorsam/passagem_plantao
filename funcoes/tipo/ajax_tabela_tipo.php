

<?php 
    include '../../conexao.php';

    $consulta="SELECT CD_TIPO AS CD, NM_TIPO AS NM FROM passagem_plantao.tipos_quadro";

    $resultado = oci_parse($conn_ora,$consulta);

    oci_execute($resultado);

?>

<div class="table-responsive col-md-12" style="padding: 0px !important;">

    <table class="table table-striped"  cellspacing="0" cellpadding="0">
        
        <thead>

            <tr>

                <th style="text-align: center;">Código</th>
                <th style="text-align: center;">Nome</th>
                <th style="text-align: center;">Ações</th>

            </tr>

        </thead>

        <tbody>

            <?php

                while(@$row = oci_fetch_array($resultado)){

                echo'</tr>';

                    echo '<td class="align-middle" style="text-align: center;">' . $row['CD'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row['NM'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">'; ?>
                        <button type="button" class="btn btn-adm" onclick="ajax_apagar_tipo('<?php echo $row['CD'] ?>')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    <?php 
                    echo '</td>';
                echo'</tr>';
                }  
            ?>

        </tbody>

    </table>

</div>

