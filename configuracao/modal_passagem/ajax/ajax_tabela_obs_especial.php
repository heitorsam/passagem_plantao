<?php 
    include '../../../conexao.php';

    session_start();

    $id = @$_GET['id'];

    $dt = $_SESSION['data'];

    $adm = $_SESSION['sn_administrador'];
    
    $consulta_obs = "SELECT obs.cd_observacao,
    obs.cd_paciente,
    pc.cd_paciente,
    obs.observacao,
    obs.cd_usuario_criacao,
    TO_CHAR(obs.hr_criacao, 'DD/MM/YYYY HH24:MI') AS hr_criacao,
    obs.sn_solucionado
    FROM passagem_plantao.OBSERVACAO_ESPECIAL obs
    INNER JOIN dbamv.paciente pc
    ON pc.cd_paciente = obs.cd_paciente
    WHERE obs.CD_PACIENTE = '$id'
    AND TO_CHAR(obs.hr_criacao, 'DD-MM-YYYY') = TO_CHAR(TO_DATE('$dt', 'YYYY-MM-DD'), 'DD-MM-YYYY')";

    $result_obs = oci_parse($conn_ora, $consulta_obs);
    oci_execute($result_obs);

    $consulta_obs_dt = "SELECT obs.cd_observacao,
        obs.cd_paciente,
        pc.cd_paciente,
        obs.observacao,
        obs.cd_usuario_criacao,
        TO_CHAR(obs.hr_criacao, 'DD/MM/YYYY HH24:MI') AS hr_criacao,
        obs.sn_solucionado
    FROM passagem_plantao.OBSERVACAO_ESPECIAL obs
    INNER JOIN dbamv.paciente pc
    ON pc.cd_paciente = obs.cd_paciente
    WHERE obs.CD_PACIENTE = '192101'
    AND TO_CHAR(obs.hr_criacao, 'DD-MM-YYYY') < TO_CHAR(TO_DATE('$dt', 'YYYY-MM-DD'), 'DD-MM-YYYY')
    AND obs.sn_solucionado = 'N'";

    $result_obs_dt = oci_parse($conn_ora, $consulta_obs_dt);
    oci_execute($result_obs_dt);

?>

<div class="table-responsive col-md-12" style="padding: 0px !important;">

    <table class="table table-striped" cellspacing="0" cellpadding="0">
        
        <thead>

            <tr>

                <th style="text-align: center;">Observação</th>
                <th style="text-align: center;">Usuário</th>
                <th style="text-align: center;">Hora da Criação</th>
                <th style="text-align: center;">Solucionado</th>
                <?php if($adm == 'S'){ ?>
                <th style="text-align: center;">Opções</th>
                <?php } ?>
            </tr>

        </thead>

        <tbody>

            <?php

                while(@$row_dur = oci_fetch_array($result_obs)){

                echo'</tr>';

                    echo '<td class="align-middle" style="text-align: center;">' . $row_dur['OBSERVACAO'] . '</td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row_dur['CD_USUARIO_CRIACAO'] . ' </td>';
                    echo '<td class="align-middle" style="text-align: center;">' . $row_dur['HR_CRIACAO'] . ' </td>';
                    if($row_dur['SN_SOLUCIONADO'] == 'S'){ ?>
                        <td class="align-middle" onclick="mudar_situacao('<?php echo $row_dur['CD_OBSERVACAO'] ?>', 'N')" style="text-align: center;"><i style="color: green;" class="fa-solid fa-check"></i></td>
                    <?php }else{ ?>
                        <td class="align-middle" onclick="mudar_situacao('<?php echo $row_dur['CD_OBSERVACAO'] ?>', 'S')" style="text-align: center;"><i style="color: red;" class="fa-solid fa-xmark"></i></td>
                    <?php }
                    if($adm == 'S'){
                        echo '<td class="align-middle" style="text-align: center;">'; ?> 
                        <button type="button" onclick="apagar_observacao('<?php echo $row_dur['CD_OBSERVACAO'] ?>')" class="btn btn-adm" ><i class="fa-solid fa-trash"></i></button>
                        <?php echo'</td>';
                    }
                echo'</tr>';
                }

                while(@$row_dur_dt = oci_fetch_array($result_obs_dt)){

                    echo'</tr>';
    
                        echo '<td class="align-middle" style="text-align: center;">' . $row_dur_dt['OBSERVACAO'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_dur_dt['CD_USUARIO_CRIACAO'] . ' </td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_dur_dt['HR_CRIACAO'] . ' </td>';
                        if($row_dur_dt['SN_SOLUCIONADO'] == 'S'){ ?>
                            <td class="align-middle" onclick="mudar_situacao('<?php echo $row_dur_dt['CD_OBSERVACAO'] ?>', 'N')" style="text-align: center;"><i style="color: green;" class="fa-solid fa-check"></i></td>
                        <?php }else{ ?>
                            <td class="align-middle" onclick="mudar_situacao('<?php echo $row_dur_dt['CD_OBSERVACAO'] ?>', 'S')" style="text-align: center;"><i style="color: red;" class="fa-solid fa-xmark"></i></td>
                        <?php }
                        if($adm == 'S'){
                            echo '<td class="align-middle" style="text-align: center;">'; ?> 
                            <button type="button" onclick="apagar_observacao('<?php echo $row_dur_dt['CD_OBSERVACAO'] ?>')" class="btn btn-adm" ><i class="fa-solid fa-trash"></i></button>
                            <?php echo'</td>';
                        }
                    echo'</tr>';
                }
                            
            ?>

        </tbody>

    </table>

</div>
