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
                        CASE qe.tp_anotacao
                            WHEN 'H' THEN
                            'HEMODINAMICA'
                            WHEN 'T' THEN
                            'TRANSPORTE'
                            WHEN 'E' THEN
                            'EXAME'
                            WHEN 'P' THEN
                            'PROCEDIMENTO'
                            ELSE
                            'ERRO DE CADASTRO'
                        END AS tp_anotacao
                    FROM passagem_plantao.quadro_enf qe
                    WHERE qe.cd_unid_int = '$cd_unid_int'";

    $consulta_h = $consulta;

    $consulta_h .=  "AND qe.tp_anotacao = 'H'
                        ORDER BY DATA desc";

    $consulta_t = $consulta;

    $consulta_t .=  "AND qe.tp_anotacao = 'T'
                        ORDER BY DATA desc";

    $consulta_e = $consulta;

    $consulta_e .=  "AND qe.tp_anotacao = 'E'
                        ORDER BY DATA desc";

    $consulta_p = $consulta;

    $consulta_p .=  "AND qe.tp_anotacao = 'P'
                        ORDER BY DATA desc";
                    
    
    $result_h = oci_parse($conn_ora, $consulta_h);

    $result_t = oci_parse($conn_ora, $consulta_t);

    $result_e = oci_parse($conn_ora, $consulta_e);

    $result_p = oci_parse($conn_ora, $consulta_p);

    oci_execute($result_h);

    oci_execute($result_t);

    oci_execute($result_e);
    
    oci_execute($result_p);
    ;
    
?>
<div class="row">
    <div class="row col-md-5" style="padding: 0px !important; border-color: #ccbd9d; border: solid 5px #ccbd9d;background-color: #927151;font-size: 12px">
        <div class="col-md-12" style="text-align: center !important; border-color: #ccbd9d; border: solid 5px #ccbd9d;background-color: #ccbd9d; font-size: 15px !important">Hemodialise</div>

        <?php
            while($row_h = oci_fetch_array($result_h)){

                echo '<div class="align-middle col-md-3" style="background-color:'. $row_h['COR'] .';color: #fff;border: solid 5px #927151  !important"></br>' . $row_h['DATA'];
                ?>
                <a class="btn" style="background-color: <?php echo $row_h['COR'] ?> !important;color: #fff !important;border-color:<?php echo $row_h['COR'] ?> !important" onclick="ajax_apagar_anotacao('<?php echo $row_h['CD'] ?>')">
                <i class="fas fa-trash"></i></a> 
                <?php
                echo $row_h['CD_LEITO'] .' - '. $row_h['NM_PACIENTE'] .'</br>';
                echo $row_h['OBS'] .'</br>';
                echo '</br>';
                echo '</div>';
            }
                        
        ?>

            
    </div>

    <div class="col-md-1"></div>

    <div class="row col-md-5" style="padding: 0px !important; border-color: #ccbd9d; border: solid 5px #ccbd9d;background-color: #927151; font-size: 12px">
        <div class="col-md-12" style="text-align: center !important; border-color: #ccbd9d; border: solid 5px #ccbd9d;background-color: #ccbd9d; font-size: 15px !important">Transporte</div>
        <?php
            while($row_t = oci_fetch_array($result_t)){

                echo '<div class="align-middle col-md-3" style="background-color:'. $row_t['COR'] .';color: #fff;border: solid 5px #927151  !important"></br>' . $row_t['DATA'];
                ?>
                <a class="btn" style="background-color: <?php echo $row_t['COR'] ?> !important;color: #fff !important;border-color:<?php echo $row_t['COR'] ?> !important" onclick="ajax_apagar_anotacao('<?php echo $row_t['CD'] ?>')">
                <i class="fas fa-trash"></i></a> 
                <?php
                echo $row_t['CD_LEITO'] .' - '. $row_t['NM_PACIENTE'] .'</br>';
                echo $row_t['OBS'] .'</br>';
                echo '</br>';
                echo '</div>';
            }
                        
        ?>

            
    </div>

</div>
        </br>
<div class="row">
    <div class="row col-md-5" style="padding: 0px !important; border-color: #ccbd9d; border: solid 5px #ccbd9d;background-color: #927151;font-size: 12px">
        <div class="col-md-12" style="text-align: center !important; border-color: #ccbd9d; border: solid 5px #ccbd9d;background-color: #ccbd9d; font-size: 15px !important">Exames</div>
        <?php
            while($row_e = oci_fetch_array($result_e)){

                echo '<div class="align-middle col-md-3" style="background-color:'. $row_e['COR'] .';color: #fff;border: solid 5px #927151  !important"></br>' . $row_e['DATA'];
                ?>
                <a class="btn" style="background-color: <?php echo $row_e['COR'] ?> !important;color: #fff !important;border-color:<?php echo $row_e['COR'] ?> !important" onclick="ajax_apagar_anotacao('<?php echo $row_e['CD'] ?>')">
                <i class="fas fa-trash"></i></a> 
                <?php
                echo $row_e['CD_LEITO'] .' - '. $row_e['NM_PACIENTE'] .'</br>';
                echo $row_e['OBS'] .'</br>';
                echo '</br>';
                echo '</div>';
            }
                        
        ?>

            
    </div>

    <div class="col-md-1"></div>

    <div class="row col-md-5" style="padding: 0px !important; border-color: #ccbd9d; border: solid 5px #ccbd9d;background-color: #927151;font-size: 12px">
        <div class="col-md-12" style="text-align: center !important; border-color: #ccbd9d; border: solid 5px #ccbd9d;background-color: #ccbd9d; font-size: 15px !important">Procedimento</div>

        <?php
            while($row_p = oci_fetch_array($result_p)){

                echo '<div class="align-middle col-md-3" style="background-color:'. $row_p['COR'] .';color: #fff;border: solid 5px #927151  !important"></br>' . $row_p['DATA'];
                ?>
                <a class="btn" style="background-color: <?php echo $row_p['COR'] ?> !important;color: #fff !important;border-color:<?php echo $row_p['COR'] ?> !important" onclick="ajax_apagar_anotacao('<?php echo $row_p['CD'] ?>')">
                <i class="fas fa-trash"></i></a> 
                <?php
                echo $row_p['CD_LEITO'] .' - '. $row_p['NM_PACIENTE'] .'</br>';
                echo $row_p['OBS'] .'</br>';
                echo '</br>';
                echo '</div>';
            }
                        
        ?>

            
    </div>
</div>

