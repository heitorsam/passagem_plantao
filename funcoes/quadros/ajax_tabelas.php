<?php 

    include '../../conexao.php';

    session_start();

    $cd_unid_int = $_GET['unid_int'];

    $consulta = "SELECT qe.CD_ANOTACAO AS CD,
                        TO_CHAR(qe.dt_anotacao, 'DD/MM/YYYY HH24:MI') AS DATA,
                        qe.cd_leito,
                        (SELECT dbamv.FNC_ABREVIA_NOME_LPGD(pc.nm_paciente)
                        FROM dbamv.paciente pc
                        WHERE pc.cd_paciente = qe.cd_paciente) AS nm_paciente,
                        qe.obs,
                        qe.cor,
                        tp.nm_tipo AS NM
                        FROM passagem_plantao.quadro_enf qe
                        INNER JOIN passagem_plantao.tipos_quadro tp
                        ON tp.cd_tipo = qe.tp_anotacao
                    WHERE qe.cd_unid_int = '$cd_unid_int'
                    ORDER BY qe.dt_anotacao desc";

    
    $result = oci_parse($conn_ora, $consulta);

    oci_execute($result);


    
?>

<div class="row justify-content-center" style="width: 100%; margin: 0 auto;">

    <div class="col-md-12 quadro_categorias">   

    <div style="font-size: 20px; border-bottom: solid 1px #3185c1; border-bottom-style: dashed; text-align: center; color: #3d3d3d;"> Quadro </div>

        <div class="row justify-content-center">
            
            </br></br></br>
            </br></br></br>

            <?php

                while($row = oci_fetch_array($result)){
                    ?>
                    <div class="align-middle col-md-2 quadro_post_it" style="background-color: <?php echo $row['COR'] ?>">
                        <div class='quadro_pin' style='height: 24px; width: 24px; margin: 0 auto;' onclick="ajax_apagar_anotacao('<?php echo $row['CD'] ?>')"> <img src='img/outros/pin_santa_casa_sjc.png'> </div>
                        <?php 
                        echo '</br><b>' . $row['NM'] . '</b></br>';
                        echo $row['DATA'] . '</br>';
                        echo $row['CD_LEITO'] .' - '. $row['NM_PACIENTE'] .'</br>';
                        echo $row['OBS']. '</br></br>';
 
                    echo '</div>';
                }
                            
            ?>

        </div>

            
    </div>

</div>

