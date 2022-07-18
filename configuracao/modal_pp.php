<?php

  $sn_readonly = '';

  //SE FOR EXIBICAO
  if(isset($var_cod_dur)){ 

    $cons_dur = "SELECT dur.* 
                 FROM passagem_plantao.DURANTE dur
                 WHERE dur.CD_DURANTE = $var_cod_dur";


    $result_dur = oci_parse($conn_ora,$cons_dur);

    @oci_execute($result_dur);

    $row_dur = oci_fetch_array($result_dur);

    $sn_readonly = 'readonly';

  }

                          
?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-adm" data-toggle="modal" data-target="#edit_modal">
<i class="fa-solid fa-pencil"></i> Durante o Plantão
</button>

<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Durante o Plantão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style='margin: 0 auto !important;'>

                <form method='POST' action='configuracao/cadastro_durante.php'>

                    <div class='row'>

                        <div class='col-md-3' style='text-align:left'>

                          Unid </br>
                          <input class="form-control" name='frm_unid' type="text" value="<?php echo $var_exibir_pp ?>" readonly>

                        </div>
                        
                        <div class='col-md-3' style='text-align:left'>

                            Equip. com Problema? </br>
                            <select class='form-control' name='frm_ep_sn' onchange="habilitar()" id='ep_sn'>

                                <option value=""> Selecione </option>
                                <option value="S"> Sim </option>
                                <option value="N"> Não </option>

                            </select>


                        </div>

                        <div class='col-md-3' style='text-align:left'>

                          Qual?</br>
                          <input class="form-control" name='frm_equip_desc' id='qual' disabled value="<?php echo @$row_dur['EQUIP_DESC']; ?>" <?php echo $sn_readonly; ?>>

                        </div>
                        </br>
                    </div>
                    </br>

                    <div class='row'>

                    
                    <div class='col-md-3' style='text-align:left'>

                      Utilizado Carrinho? </br>
                      <select class='form-control' name='frm_ce_sn'>

                        <option value=""> Selecione </option>
                        <option value="S"> Sim </option>
                        <option value="N"> Não </option>

                      </select>

                    </div>

                      <div class='col-md-3' style='text-align:left'>

                        Reposto/Lacrado? </br>
                        <select class='form-control' name='frm_rl_sn'>

                          <option value=""> Selecione </option>
                          <option value="S"> Sim </option>
                          <option value="N"> Não </option>

                        </select>

                      </div>

                      <div class='col-md-3' style='text-align:left'>

                        Informe o Lacre</br>
                        <input class="form-control" name='frm_lac_desc' value="<?php echo @$row_dur['LACRE_DESC']; ?>" <?php echo $sn_readonly; ?>>

                      </div>

                      <div class='col-md-3' style='text-align:left'>

                        Leito Bloqueado? </br>
                        <select class='form-control' name='frm_lt_sn'>

                          <option value=""> Selecione </option>
                          <option value="S"> Sim </option>
                          <option value="N"> Não </option>

                        </select>

                      </div>

                    </div>

                    </br>
                    <div class='row'>

                      <div class='col-md-3' style='text-align:left'>

                        Motivo</br>
                        <input class="form-control" name='frm_lt_motivo'value="<?php echo @$row_dur['LT_MOTIVO_DESC']; ?>" <?php echo $sn_readonly; ?>>

                      </div>

                      <div class='col-md-3' style='text-align:left'>

                        Falta Medicamento? </br>
                        <select class='form-control' name='frm_ft_mm'>

                          <option value=""> Selecione </option>
                          <option value="S"> Sim </option>
                          <option value="N"> Não </option>

                        </select>

                      </div>

                      <div class='col-md-3' style='text-align:left'>

                      Qual?</br>
                      <input class="form-control" name='frm_mm_motivo'value="<?php echo @$row_dur['MM_DESC']; ?>" <?php echo $sn_readonly; ?>>

                      </div>

                      <div class='col-md-3' style='text-align:left'>

                        Farmácia Avisada? </br>
                        <select class='form-control' name='frm_farm_sn'>

                          <option value=""> Selecione </option>
                          <option value="S"> Sim </option>
                          <option value="N"> Não </option>

                        </select>

                      </div>

                    </div>

                    </br>
                    <div class='row'>

                      <div class='col-md-4' style='text-align:left'>

                        Problemas com Paciente? </br>
                        <select class='form-control' name='frm_pp_sn'>

                          <option value=""> Selecione </option>
                          <option value="S"> Sim </option>
                          <option value="N"> Não </option>

                        </select>

                      </div>

                      
                      <div class='col-md-8' style='text-align:left'>

                      Conduta</br>
                      <input class="form-control" name='frm_con_desc'value="<?php echo @$row_dur['CONDUTA_DESC']; ?>" <?php echo $sn_readonly; ?>>

                      </div>

                    </div>

                    </br>
                    <div class='row'>

                      <div class='col-md-3' style='text-align:left'>

                          Intercorrência? </br>
                          <select class='form-control' name='frm_ip_sn'>

                            <option value=""> Selecione </option>
                            <option value="S"> Sim </option>
                            <option value="N"> Não </option>

                          </select>

                        </div>
                        
                        <div class='col-md-9' style='text-align:left'>

                        Desfecho</br>
                        <input class="form-control" name='frm_ip_desc'value="<?php echo @$row_dur['IP_DESC']; ?>" <?php echo $sn_readonly; ?>>

                        </div>

                    </div>

                      </br>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Fechar</button>
                          <?php if(!isset($var_cod_dur)){ ?>
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button> 
                          <?php } ?>
                        </div>
            
    
                </form>


            </div>
        </div>
    </div>
</div>

<script>
function habilitar(){

 
	var input = document.getElementById("ep_sn").value;
  var input2 = document.getElementById("qual");

  if(input == ''){
    input2.disabled = true;
  }

  if(input == 'N'){
    input2.disabled = true;
  }

  if(input == 'S'){
    input2.disabled = false;
  }


};
</script>