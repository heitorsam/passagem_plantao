<?php
  
    $consulta_evod = "SELECT DISTINCT hss.CD_DOCUMENTO_CLINICO, hss.CD_DOCUMENTO, hss.DS_DOCUMENTO,
                         hss.CD_PACIENTE, hss.CD_ATENDIMENTO,
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_CONDICOES_PELE_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS CONDICOES_DE_PELE,
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_DISP_CONTROLE_TROCA_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS DISP_CONTROLE_TROCA,
                         
                         SUBSTR(REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_EDEMA_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>'),4,200) AS SN_EDEMA,
                         
                         SUBSTR(REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_ESTADO_EDEMA_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>'),4,200) AS ESTADO_EDEMA,
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_CURATIVO_CP_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS CURATIVO,
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_CARACTERISTICAS_CP_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS CARACTERISTICAS,
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_SIST_GASTROINTESTINAL_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS SISTEMA_GASTROINTESTINAL,
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_CONSIDERACOES_SIST_GASTRO_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS CONSIDERACOES_GASTRO,
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_SIST_GENITURINARIO_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS SISTEMA_GENITURINARIO,
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_CONSIDERACOES_SIST_GENITURINARIO_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS CONSIDERACOES_GENITURINARIO,                         
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_HEMODINAMICAMENTE_TXT_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS HEMODINAMICAMENTE,
                         
                         SUBSTR(REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_USO_DVA_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>'),4,200) AS SN_USO_DVA,
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_DVA_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS QUAIS_VOLUMES,
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_NIVEL_CONSCIENCIA_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS NIVEL_CONSCIENCIA,
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_NIVEL_CONSCIENCIA_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS NIVEL_CONSCIENCIA,
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_CONSIDERACOES_SDC_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS CONSIDERACOES_CONSCIENCIA,
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_MODO_VENTILATORIO_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS MODO_VENTILATORIO,
                         
                         REPLACE((SELECT aux.DS_RESPOSTA FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR aux 
                         WHERE DS_IDENTIFICADOR = 'SC_EEPIA_CONSIDERACOES_MVENT_1' 
                         AND aux.CD_DOCUMENTO_CLINICO = hss.CD_DOCUMENTO_CLINICO),'\n','<br>') AS CONSIDERACOES_VENTILATORIO
                         
                         FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR hss
                         WHERE hss.CD_DOCUMENTO = 979
                         AND hss.CD_ATENDIMENTO = $var_atd
                         AND hss.CD_DOCUMENTO_CLINICO IN (SELECT MAX(doc.CD_DOCUMENTO_CLINICO)
                                                         FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR doc
                                                         WHERE doc.CD_DOCUMENTO = 979
                                                         AND doc.CD_ATENDIMENTO = $var_atd)";

    $result_consulta_evod = oci_parse($conn_ora,$consulta_evod);

    if(@$var_atd != ''){

        oci_execute(@$result_consulta_evod);
        $row_evod = oci_fetch_array(@$result_consulta_evod);
    }

?>

<div class='fnd_azul'><i class="fa-solid fa-hand-sparkles"></i> Condições da Pele</div>

<div class='row'>

    <div class='col-md-12' style='text-align:left'>

        Condições:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php echo $row_evod['CONDICOES_DE_PELE']; ?>

        </div>

        Dispositvo e Controle de Troca:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php echo $row_evod['DISP_CONTROLE_TROCA']; ?>

        </div>     

        Edema:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php echo $row_evod['SN_EDEMA'] . ' ' . $row_evod['ESTADO_EDEMA']; ?>

        </div>  

        Curativo:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php echo $row_evod['CURATIVO']; ?>

        </div>  

        Características:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php echo $row_evod['CARACTERISTICAS'];?>

        </div>  
        
    </div>

</div>

<br>

<div class='fnd_azul'><i class="fa-solid fa-teeth-open"></i> Sistema Gastrointestinal</div>

<div class='row'>

    <div class='col-md-12' style='text-align:left'>

        Condições:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php echo $row_evod['SISTEMA_GASTROINTESTINAL']; ?>

        </div>

        Considerações:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php echo $row_evod['CONSIDERACOES_GASTRO']; ?>

        </div>
       
    </div>

</div>

<br>

<div class='fnd_azul'><i class="fa-solid fa-vial"></i> Sistema Geniturinário</div>

<div class='row'>

    <div class='col-md-12' style='text-align:left'>

        Condições:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php echo $row_evod['SISTEMA_GENITURINARIO']; ?>

        </div>

        Considerações:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php echo $row_evod['CONSIDERACOES_GENITURINARIO']; ?>

        </div>
       
    </div>

</div>

<br>

<div class='fnd_azul'><i class="fa-solid fa-heart"></i> Hemodinamicamente</div>

<div class='row'>

    <div class='col-md-12' style='text-align:left'>

        Condições:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php 

                echo $row_evod['HEMODINAMICAMENTE'] . '</br>'; 

                echo 'Uso de DVA?: ' . $row_evod['SN_USO_DVA'] . '</br>';            
            
            ?>

        </div>

        Qual(is) e Volume:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php echo $row_evod['QUAIS_VOLUMES']; ?>

        </div>
       
    </div>

</div>

<br>

<div class='fnd_azul'><i class="fa-solid fa-brain"></i> Nível de Consciência:</div>

<div class='row'>

    <div class='col-md-12' style='text-align:left'>

        Condições:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php 

                echo $row_evod['NIVEL_CONSCIENCIA'];       
            
            ?>

        </div>

        Considerações:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php echo $row_evod['CONSIDERACOES_CONSCIENCIA']; ?>

        </div>
       
    </div>

</div>

<br>

<div class='fnd_azul'><i class="fa-solid fa-fan"></i> Modo Ventilatório:</div>

<div class='row'>

    <div class='col-md-12' style='text-align:left'>

        Condições:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php 

                echo $row_evod['MODO_VENTILATORIO'];       
            
            ?>

        </div>

        Considerações:
        <div style="margin-bottom: 6px; max-height: 120px;overflow:auto;border: solid 2px #CCCCCC;border-radius: 5px;padding: 12px 20px 12px 20px;background-color: #F8F8F8">

            <?php echo $row_evod['CONSIDERACOES_VENTILATORIO']; ?>

        </div>
       
    </div>

</div>