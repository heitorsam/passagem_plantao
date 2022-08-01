<?php
$id;
$consulta_obs = "SELECT obs.cd_observacao,
                        obs.cd_paciente,
                        pc.cd_paciente,
                        obs.observacao,
                        obs.cd_usuario_criacao,
                        obs.hr_criacao,
                        obs.sn_solucionado
                        FROM passagem_plantao.OBSERVACAO_ESPECIAL obs
                        INNER JOIN dbamv.paciente pc
                        ON pc.cd_paciente = obs.cd_paciente
                        WHERE obs.CD_PACIENTE = '$id'";

$result_obs = oci_parse($conn_ora, $consulta_obs);
oci_execute($result_obs);

?>


<div class='col-md-12' style='text-align:left'>

    <div id="div_tabela_obs"></div>

</div>

<script>

    $(document).ready(function() {
        //alert('teste');
    });


</script>