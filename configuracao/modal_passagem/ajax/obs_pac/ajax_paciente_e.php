<?php 
    include '../../../conexao.php';


?>


<?php 
    include '../../../conexao.php';

    session_start();

    $cd_dur = $_GET['cd_dur'];

    $adm = $_SESSION['sn_administrador'];
    
    $usuario = $_SESSION['usuarioLogin'];
    
    $consulta_obs = "SELECT op.CD_OBSERVACAO,
                                op.observacao,
                                op.cd_usuario_criacao,
                                TO_CHAR(op.hr_criacao, 'DD/MM/YYYY HH24:MI') AS HR_CRIACAO
                            FROM passagem_plantao.observacao_paciente op
                            WHERE op.cd_durante = $cd_dur";

    $result_obs = oci_parse($conn_ora, $consulta_obs);
    oci_execute($result_obs);


?>

<div class="table-responsive col-md-12" style="padding: 0px !important;">

    <table class="table table-striped" cellspacing="0" cellpadding="0">
        
        <thead>

            <tr>

                <th style="text-align: center;">Observação</th>
                <th style="text-align: center;">Usuário</th>
                <th style="text-align: center;">Hora da Criação</th>
                <th style="text-align: center;">Opções</th>
            </tr>

        </thead>

        <tbody>

            <?php

                while(@$row_dur = oci_fetch_array($result_obs)){

                    echo'</tr>';

                        echo '<td class="align-middle" style="text-align: center;">' . $row_dur['OBSERVACAO'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_dur['CD_USUARIO_CRIACAO'] . ' </td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_dur['HR_CRIACAO'] . ' </td>';
                        if($row_dur['CD_USUARIO_CRIACAO'] == $usuario){
                            echo '<td class="align-middle" style="text-align: center;">'; ?> 
                            <button type="button" onclick="apagar_observacao_paci('<?php echo $row_dur['CD_OBSERVACAO'] ?>')" class="btn btn-adm" ><i class="fa-solid fa-trash"></i></button>
                            <?php echo'</td>';
                        }
                    echo'</tr>';
                }
                            
            ?>

        </tbody>

    </table>

</div>
