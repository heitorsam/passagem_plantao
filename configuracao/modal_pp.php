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



                  <div class='row'>

                      <input class='form-control' id='frm_dta' type='date' value='<?php echo $var_exibir_dt; ?>' hidden>

                      <div class='col-md-3' style='text-align:left' hidden>

                        Descrição Unidade: </br>
                        <input class="form-control" id='frm_unid' type="text" value="<?php echo $var_exibir_pp ?>" readonly>

                      </div>

                      <div class='col-md-3' style='text-align:left'>

                          Equip. com Problema? </br>
                          <select class='form-control' onchange="habilitar('ep_sn','qual')" id='ep_sn'>

                              <!-- IF CONSULTA -->
                              <?php if(isset($var_cod_dur)){ ?>

                                <!-- IF SIM OU NAO -->
                                <?php if($row_dur['EQUIP_SN'] == 'S'){ ?>

                                  <option value="S"> Sim </option>

                                <?php }else{ ?>

                                  <option value="N"> Não </option>

                                <?php } ?>
                                <!-- FIM IF SIM OU NAO -->                                 

                              <?php }else{ ?>  

                                <option value=""> Selecione </option>
                                <option value="S"> Sim </option>
                                <option value="N"> Não </option>

                              <?php } ?>  
                              <!-- FIM IF CONSULTA -->

                          </select>


                      </div>

                      <div class='col-md-9' style='text-align:left'>

                        Qual?:</br>
                        <input minlength='5' class="form-control" id='qual' disabled value="<?php echo @$row_dur['EQUIP_DESC']; ?>" <?php echo $sn_readonly; ?>>

                      </div>
                      </br>
                  </div>
                  </br>

                  <div class='row'>

                  
                  <div class='col-md-3' style='text-align:left'>

                    Utilizado Carrinho? </br>
                    <select class='form-control' onchange="habilitar1()" id='ce_sn'>

                      <!-- IF CONSULTA -->
                      <?php if(isset($var_cod_dur)){ ?>

                          <!-- IF SIM OU NAO -->
                          <?php if($row_dur['CAR_SN'] == 'S'){ ?>

                        <option value="S"> Sim </option>

                        <?php }else{ ?>

                        <option value="N"> Não </option>

                        <?php } ?>
                        <!-- FIM IF SIM OU NAO -->                                 

                        <?php }else{ ?>  

                      <option value=""> Selecione </option>
                      <option value="S"> Sim </option>
                      <option value="N"> Não </option>

                      <?php } ?>  
                      <!-- FIM IF CONSULTA -->

                    </select>

                  </div>

                    <div class='col-md-3' style='text-align:left'>

                      Reposto/Lacrado? </br>
                      <select class='form-control' disabled onchange="habilitar2()" id='rl_sn'>

                      <!-- IF CONSULTA -->
                      <?php if(isset($var_cod_dur)){ ?>

                      <!-- IF SIM OU NAO -->
                      <?php if($row_dur['REP_LAC_SN'] == 'S'){ ?>

                      <option value="S"> Sim </option>

                      <?php }else{ ?>

                      <option value="N"> Não </option>

                      <?php } ?>
                      <!-- FIM IF SIM OU NAO -->                                 

                      <?php }else{ ?>  

                        <option value=""> Selecione </option>
                        <option value="S"> Sim </option>
                        <option value="N"> Não </option>

                      <?php } ?>  

                      </select>

                    </div>

                    <div class='col-md-3' style='text-align:left'>

                      Informe o Lacre:</br>
                      <input minlength='5' class="form-control" id='lac_desc' disabled value="<?php echo @$row_dur['LACRE_DESC']; ?>" <?php echo $sn_readonly; ?>>

                    </div>

                    <div class='col-md-3' style='text-align:left'>

                      Leito Bloqueado? </br>
                      <select class='form-control' onchange="habilitar3()" id='lt_sn'>

                      <!-- IF CONSULTA -->
                      <?php if(isset($var_cod_dur)){ ?>

                      <!-- IF SIM OU NAO -->
                      <?php if($row_dur['LT_BLOQ_SN'] == 'S'){ ?>

                      <option value="S"> Sim </option>

                      <?php }else{ ?>

                      <option value="N"> Não </option>

                      <?php } ?>
                      <!-- FIM IF SIM OU NAO -->                                 

                      <?php }else{ ?>  

                        <option value=""> Selecione </option>
                        <option value="S"> Sim </option>
                        <option value="N"> Não </option>

                      <?php } ?>  


                      </select>

                    </div>

                  </div>

                  </br>
                  <div class='row'>

                    <div class='col-md-3' style='text-align:left'>

                      Motivo:</br>
                      <input minlength='5' class="form-control" id='lt_motivo' disabled value="<?php echo @$row_dur['LT_MOTIVO_DESC']; ?>" <?php echo $sn_readonly; ?>>

                    </div>

                    <div class='col-md-3' style='text-align:left'>

                      Falta Medicamento? </br>
                      <select class='form-control' onchange="habilitar4(); habilitar5()" id='ft_mm'>

                      <!-- IF CONSULTA -->
                      <?php if(isset($var_cod_dur)){ ?>

                      <!-- IF SIM OU NAO -->
                      <?php if($row_dur['FT_MM_SN'] == 'S'){ ?>

                      <option value="S"> Sim </option>

                      <?php }else{ ?>

                      <option value="N"> Não </option>

                      <?php } ?>
                      <!-- FIM IF SIM OU NAO -->                                 

                      <?php }else{ ?>  

                        <option value=""> Selecione </option>
                        <option value="S"> Sim </option>
                        <option value="N"> Não </option>

                      <?php } ?>  

                      </select>

                    </div>

                    <div class='col-md-3' style='text-align:left'>

                    Qual?:</br>
                    <input minlength='5' class="form-control" id='mm_motivo' disabled value="<?php echo @$row_dur['MM_DESC']; ?>" <?php echo $sn_readonly; ?>>

                    </div>

                    <div class='col-md-3' style='text-align:left'>

                      Farmácia Avisada? </br>
                      <select class='form-control' id='farm_sn' disabled>

                      <!-- IF CONSULTA -->
                      <?php if(isset($var_cod_dur)){ ?>

                      <!-- IF SIM OU NAO -->
                      <?php if($row_dur['FARM_SN'] == 'S'){ ?>

                      <option value="S"> Sim </option>

                      <?php }else{ ?>

                      <option value="N"> Não </option>

                      <?php } ?>
                      <!-- FIM IF SIM OU NAO -->                                 

                      <?php }else{ ?>  

                        <option value=""> Selecione </option>
                        <option value="S"> Sim </option>
                        <option value="N"> Não </option>

                      <?php } ?>  


                      </select>

                    </div>

                  </div>

                  </br>
                  <div class='row'>

                    <div class='col-md-4' style='text-align:left'>

                      Problemas com Paciente? </br>
                      <select class='form-control' onchange="habilitar6()" id='pp_sn'>

                      <!-- IF CONSULTA -->
                      <?php if(isset($var_cod_dur)){ ?>

                      <!-- IF SIM OU NAO -->
                      <?php if($row_dur['PPF_SN'] == 'S'){ ?>

                      <option value="S"> Sim </option>

                      <?php }else{ ?>

                      <option value="N"> Não </option>

                      <?php } ?>
                      <!-- FIM IF SIM OU NAO -->                                 

                      <?php }else{ ?>  

                        <option value=""> Selecione </option>
                        <option value="S"> Sim </option>
                        <option value="N"> Não </option>

                      <?php } ?>

                      </select>

                    </div>

                  </div>
                  <br>

                  <div class='row'>

                    <div class='col-md-12' style='text-align:left'>

                    Conduta:</br>

                    <textarea minlength='5' class='textarea' style="width: 100%;" id='con_desc' disabled value="<?php echo $row_dur ['CONDUTA_DESC']; ?>" <?php echo $sn_readonly; ?>></textarea>

                    </div>

                  </div>

                  </br>
                  <div class='row'>

                    <div class='col-md-3' style='text-align:left'>

                        Intercorrência? </br>
                        <select class='form-control' onchange="habilitar7()" id='ip_sn'>

                        <!-- IF CONSULTA -->
                        <?php if(isset($var_cod_dur)){ ?>

                        <!-- IF SIM OU NAO -->
                        <?php if($row_dur['IP_SN'] == 'S'){ ?>

                        <option value="S"> Sim </option>

                        <?php }else{ ?>

                        <option value="N"> Não </option>

                        <?php } ?>
                        <!-- FIM IF SIM OU NAO -->                                 

                        <?php }else{ ?>  

                          <option value=""> Selecione </option>
                          <option value="S"> Sim </option>
                          <option value="N"> Não </option>

                          <?php } ?>

                        </select>

                      </div>
                      
                      <div class='col-md-12' style='text-align:left'>
                      <br>

                      Desfecho:</br>
                      <textarea minlength='5' class='textarea' style="width: 100%;" id='ip_desc' disabled value="<?php echo $row_dur ['IP_DESC']; ?>" <?php echo $sn_readonly; ?>></textarea>
                      </div>

                  </div>

                    </br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Fechar</button>
                        
                        
                        <?php if(!isset($var_cod_dur)){ ?>
                          <button onclick="ajax_cadastrar_anotacao()" data-dismiss="modal" aria-label="Close" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button> 
                        <?php } ?>
                        
                      </div>
            </div>
        </div>
    </div>
</div>

<script>



  function habilitar(input, input2){

    var var_input = document.getElementById(input).value;
    var var_input2 = document.getElementById(input2);

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