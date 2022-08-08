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
<button type="button" class="btn btn-adm" data-toggle="modal" data-target="#id_criar_dur">
<i class="fa-solid fa-pencil"></i> Durante o Plantão
</button>

<div class="modal fade" id="id_criar_dur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Durante o Plantão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" >

              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-equip-tab" data-toggle="tab" data-target="#nav-equip" type="button" role="tab" aria-controls="nav-equip" aria-selected="true" style="color: #fff; background-color: #3185c1;">Equipamentos</button>
                  <button class="nav-link" id="nav-farm-tab" data-toggle="tab" data-target="#nav-farm" type="button" role="tab" aria-controls="nav-farm" aria-selected="false" style="color: #fff; background-color: #3185c1;">Farmácia</button>
                  <button class="nav-link" id="nav-paci-tab" data-toggle="tab" onclick="ajax_paciente()" data-target="#nav-paci" type="button" role="tab" aria-controls="nav-paci" aria-selected="false" style="color: #fff; background-color: #3185c1;">Paciente</button>
                  <button class="nav-link" id="nav-inter-tab" data-toggle="tab" onclick="ajax_intercorrencia()" data-target="#nav-inter" type="button" role="tab" aria-controls="nav-inter" aria-selected="false" style="color: #fff; background-color: #3185c1;">Intercorrência</button>
                </div>
              </nav>
              </br>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-equip" role="tabpanel" aria-labelledby="nav-equip-tab">
                  <div class="row">
                    <input class='form-control' id='frm_dta' type='date' value='<?php echo $var_exibir_dt; ?>' hidden>
                    <div class='col-md-3' style='text-align:left' hidden>

                      Descrição Unidade: </br>
                      <input class="form-control" id='frm_unid' type="text" value="<?php echo $var_exibir_pp ?>" readonly>

                    </div>

                    <div class='col-md-3' style='text-align:left'>

                      Equip. com Problema? </br>
                      <select class='form-control' onchange="habilitar_campo('ep_sn','qual','')" id='ep_sn'>

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
                    
                  </div>
                  </br>
                </div>
                <div class="tab-pane fade" id="nav-farm" role="tabpanel" aria-labelledby="nav-farm-tab">
                
                  <div class='row'>

                    <div class='col-md-3' style='text-align:left'>

                      Utilizado Carrinho? </br>
                      <select class='form-control' onchange="habilitar_campo('ce_sn','rl_sn','lac_desc')" id='ce_sn'>

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
                      <select class='form-control' disabled onchange="habilitar_campo('rl_sn','lac_desc','')" id='rl_sn'>

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
                  </div>
                  </br>
                  <div class="row">
                    <div class='col-md-3' style='text-align:left'>

                      Leito Bloqueado? </br>
                      <select class='form-control' onchange="habilitar_campo('lt_sn','lt_motivo','')" id='lt_sn'>

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

                    <div class='col-md-3' style='text-align:left'>

                      Motivo:</br>
                      <input minlength='5' class="form-control" id='lt_motivo' disabled value="<?php echo @$row_dur['LT_MOTIVO_DESC']; ?>" <?php echo $sn_readonly; ?>>

                    </div>
                  </div>
                  </br>
                  <div class="row">
                    <div class='col-md-3' style='text-align:left'>

                      Falta Medicamento? </br>
                      <select class='form-control' onchange="habilitar_campo('ft_mm','mm_motivo','farm_sn');habilitar_campo('ft_mm','farm_sn','')" id='ft_mm'>

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
                </div>
                <div class="tab-pane fade" id="nav-paci" role="tabpanel" aria-labelledby="nav-paci-tab">
                  <div class='col-md-12' style='text-align:left'>  
                    <div id="div-paci"></div>
                  </div>
                  <div class="col-md-12 input-group">
                    <input type="text" class="form-control" style="border-radius: 5px 0px 0px 5px !important" maxlength="200" id="input_observacao_paci">
                    <button type="button" class="btn btn-primary" style="border-radius: 0px 5px 5px 0px !important" onclick="salvar_observacao_paci()" ><i class="fa-solid fa-floppy-disk"></i></button>
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-inter" role="tabpanel" aria-labelledby="nav-inter-tab">
                  <div class='col-md-12' style='text-align:left'>  
                    <div id="div-inter"></div>
                  </div>
                  <div class="col-md-12 input-group">
                    <input type="text" class="form-control" style="border-radius: 5px 0px 0px 5px !important" maxlength="200" id="input_observacao_inter">
                    <button type="button" class="btn btn-primary" style="border-radius: 0px 5px 5px 0px !important" onclick="salvar_observacao_inter()" ><i class="fa-solid fa-floppy-disk"></i></button>
                  </div>
                  </br>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Fechar</button>
                  
                <?php if(!isset($var_cod_dur)){ ?>
                  <button onclick="ajax_cadastrar_anotacao()" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button> 
                <?php } ?>
                  
              </div>
            </div>
            </br>
        </div>
    </div>
</div>

<script>

  function habilitar_campo(input1, input2, input3){

    var var_input = document.getElementById(input1).value;
    var var_input2 = document.getElementById(input2);
    if(input3 != ''){
      var var_input3 = document.getElementById(input3);
    }

    if(var_input == ''){
      if(input3 != ''){
        var_input3.disabled = true;
      }
      var_input2.disabled = true;
      var_input2.value = '';
    }

    if(var_input == 'N'){
      if(input3 != ''){
        var_input3.disabled = true;
        var_input3.value = '';
      }
      var_input2.disabled = true;
      var_input2.value = '';
    }

    if(var_input == 'S'){

      var_input2.disabled = false;

    }

  };

  function ajax_paciente(){
    var setor = document.getElementById('frm_unid').value;
    var data = document.getElementById('frm_dta').value;

    $('#div-paci').load('configuracao/modal_passagem/ajax/ajax_paciente.php?setor='+ setor+'&data='+data);

  };

  function ajax_intercorrencia(){
    var setor = document.getElementById('frm_unid').value;
    var data = document.getElementById('frm_dta').value;

    $('#div-inter').load('configuracao/modal_passagem/ajax/ajax_inter.php?setor='+ setor+'&data='+data);

  };


  function salvar_observacao_paci(){
        
    var obs = document.getElementById('input_observacao_paci').value;
    var setor = document.getElementById('frm_unid').value;
    var data = document.getElementById('frm_dta').value;

    
    if(obs != ''){
        $.ajax({
            url: "configuracao/modal_passagem/ajax/ajax_salvar_observacao_paci.php",
            type: "POST",
            data: {
                setor: setor,
                obs: obs
                },
            cache: false,
            success: function(dataResult){
                document.getElementById('input_observacao_paci').value = '';
                $('#div-paci').load('configuracao/modal_passagem/ajax/ajax_paciente.php?setor='+ setor +'&data='+data);
            }
        });   
    }else{
        document.getElementById('input_observacao_paci').focus();
    }
  };

  function apagar_observacao_paci(cd_obs){
    resultado = confirm("Deseja excluir a observação?");
    if(resultado == true){
      $.ajax({
        url: "configuracao/modal_passagem/ajax/ajax_apagar_observacao_paci.php",
        type: "POST",
        data: {
            cd_obs
            },
        cache: false,
        success: function(dataResult){
          var setor = document.getElementById('frm_unid').value;
          var data = document.getElementById('frm_dta').value;

          $('#div-paci').load('configuracao/modal_passagem/ajax/ajax_paciente.php?setor='+ setor +'&data='+data);
        }
      });  
    }
  };

  function salvar_observacao_inter(){
        
      var obs = document.getElementById('input_observacao_inter').value;
      var setor = document.getElementById('frm_unid').value;
      var data = document.getElementById('frm_dta').value;
  
      
      if(obs != ''){
          $.ajax({
              url: "configuracao/modal_passagem/ajax/ajax_salvar_observacao_inter.php",
              type: "POST",
              data: {
                  setor: setor,
                  obs: obs
                  },
              cache: false,
              success: function(dataResult){
                
                  document.getElementById('input_observacao_inter').value = '';
                  $('#div-inter').load('configuracao/modal_passagem/ajax/ajax_inter.php?setor='+ setor+'&data='+data);
              }
          });   
      }else{
          document.getElementById('input_observacao_paci').focus();
      }
    };
    
    function apagar_observacao_inter(cd_obs){
      resultado = confirm("Deseja excluir a observação?");
      if(resultado == true){
        $.ajax({
          url: "configuracao/modal_passagem/ajax/ajax_apagar_observacao_inter.php",
          type: "POST",
          data: {
              cd_obs
              },
          cache: false,
          success: function(dataResult){
            var setor = document.getElementById('frm_unid').value;
            var data = document.getElementById('frm_dta').value;
            $('#div-inter').load('configuracao/modal_passagem/ajax/ajax_inter.php?setor='+ setor+'&data='+data);
          }
        });  
      }
    };

</script>