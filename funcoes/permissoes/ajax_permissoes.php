<?php
    include '../../conexao.php';
    session_start();
?>

<!-- DEPOIS SERA OCULTADO -->
<input type="hidden" value="<?php echo @$_SESSION['CD_USUARIO'] ?>" id="cd_usuario">

    <div class='row'>

        <div class='col-md-3' style='text-align:left'>

            Unidade de Internação:
            
            <div class='input-group'>
                
                <select class='form-control' style="border-radius: 5px 0px 0px 5px !important" id='frm_unid_inter' required>
                    
                <?php

                    echo $var_cod = @$_SESSION['CD_USUARIO'];

                    $consulta_unid_inter = "SELECT ui.CD_UNID_INT, ui.DS_UNID_INT
                                        FROM dbamv.unid_int ui
                                        WHERE ui.SN_ATIVO ='S'
                                        AND ui.CD_UNID_INT NOT IN (SELECT perm.CD_UNID_INT
                                                                    FROM passagem_plantao.permissoes perm
                                                                    WHERE perm.CD_USUARIO = '$var_cod') 
                                        ORDER BY ui.CD_UNID_INT ASC";

                    //UNIFICANDO CONSULTA COM A CONEXAO
                    $result_unid = oci_parse($conn_ora,$consulta_unid_inter);

                    //EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
                    oci_execute($result_unid);

                    echo "<option value=''>Selecione</option>";

                    while($row_unid = oci_fetch_array($result_unid)){

                        echo "<option value='" . $row_unid['CD_UNID_INT'] . "'>" . $row_unid['DS_UNID_INT'] . "</option>";
                    }

                ?>

                </select>

                <button type='submit' onclick="ajax_adicionar_permissao()" class='btn btn-primary' style="border-radius: 0px 5px 5px 0px !important"><i class="fas fa-plus"></i></button>

            </div>

        </div>
        <br>
        <br>

        <br>

    </div>



    </br>

<script>
    
</script>