    <?php

                        $consulta_info_ger ="SELECT 
                        atd.CD_ATENDIMENTO,
                        unid.CD_UNID_INT, 
                        unid.DS_UNID_INT , 
                        lt.CD_LEITO, 
                        lt.DS_RESUMO,
                        pac.NM_PACIENTE, 
                        TO_CHAR(pac.DT_NASCIMENTO, 'DD/MM/YYYY') AS NASCIMENTO,
                        FLOOR((SYSDATE - pac.DT_NASCIMENTO) / 365.242199) AS IDADE,
                        conv.CD_CONVENIO, 
                        conv.NM_CONVENIO
                        FROM dbamv.ATENDIME atd
                        INNER JOIN dbamv.PACIENTE pac
                        ON pac.CD_PACIENTE = atd.CD_PACIENTE
                        INNER JOIN dbamv.CONVENIO conv
                        ON conv.CD_CONVENIO = atd.CD_CONVENIO
                        INNER JOIN dbamv.LEITO lt
                        ON lt.CD_LEITO = atd.CD_LEITO
                        INNER JOIN dbamv.UNID_INT unid
                        On unid.CD_UNID_INT = lt.CD_UNID_INT
                        WHERE atd.TP_ATENDIMENTO = 'I'
                        AND lt.CD_UNID_INT = $var_exibir_pp
                        AND atd.DT_ALTA IS NULL
                        AND atd.DT_ALTA_MEDICA IS NULL
                        AND atd.CD_ATENDIMENTO = ".$row_exibir_pac['CD_ATENDIMENTO'];

                        $result_consulta_info = oci_parse($conn_ora,$consulta_info_ger);

                        oci_execute($result_consulta_info);

                        $row_info = oci_fetch_array($result_consulta_info);


 ?>
                        
    
    <div class='row'>

        <div class='col-md-2' style='text-align:left'>

            Leito:
            <input class='form-control' name='frm_leito' type='text' value="<?php echo $row_info['DS_RESUMO']; ?>" readonly> 

        </div>

        <div class='col-md-4' style='text-align:left'>

            Nome:
            <input class='form-control' name='frm_nome' type='text' value= "<?php echo $row_info['NM_PACIENTE']; ?>" readonly> 

        </div>

        <div class='col-md-2' style='text-align:left'>

            Nascimento:
            <input class='form-control' name='frm_nascimento' type='text' value="<?php echo $row_info['NASCIMENTO']; ?>" readonly> 

        </div>

        <div class='col-md-1' style='text-align:left'>

            Idade:
            <input class='form-control' name='frm_idade' type='text' value="<?php echo $row_info['IDADE']; ?>" readonly> 

        </div>

        <div class='col-md-3' style='text-align:left'>

            Convenio:
            <input class='form-control' name='frm_idade' type='text' value="<?php echo $row_info['NM_CONVENIO']; ?>" readonly> 

        </div>
    
    </div>
