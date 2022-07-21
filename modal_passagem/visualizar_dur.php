<?php

  $sn_readonly = '';

  //SE FOR EXIBICAO
  if(isset($var_cod_dur)){ 

     $cons_dur = "SELECT dur.* 
                 FROM passagem_plantao.DURANTE dur
                 WHERE dur.CD_DURANTE = $var_cod_dur";


    $result_dur = oci_parse($conn_ora,$cons_dur);

    @oci_execute($result_dur);

    $row_dur_detalhe = oci_fetch_array($result_dur);

    $sn_readonly = 'readonly';

  }

                          
?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_modal<?php echo $var_cod_dur; ?>">
<i class="fa-solid fa-eye"></i><?php $var_cod_dur; ?>
</button>

<div class="modal fade" id="edit_modal<?php echo $var_cod_dur; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                <!-- IF CONSULTA -->
                                <?php if(isset($var_cod_dur)){ ?>

                                  <!-- IF SIM OU NAO -->
                                  <?php if($row_dur_detalhe['EQUIP_SN'] == 'S'){ ?>

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

                          Qual?</br>
                          <input class="form-control" name='frm_equip_desc' id='qual' disabled value="<?php echo @$row_dur_detalhe['EQUIP_DESC']; ?>" <?php echo $sn_readonly; ?>>

                        </div>
                        </br>
                    </div>
                    </br>

                    <div class='row'>

                    
                    <div class='col-md-3' style='text-align:left'>

                      Utilizado Carrinho? </br>
                      <select class='form-control' name='frm_ce_sn' onchange="habilitar1()" id='ce_sn'>

                        <!-- IF CONSULTA -->
                        <?php if(isset($var_cod_dur)){ ?>

                           <!-- IF SIM OU NAO -->
                           <?php if($row_dur_detalhe['CAR_SN'] == 'S'){ ?>

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
                        <select class='form-control' name='frm_rl_sn' disabled onchange="habilitar2()" id='rl_sn'>

                        <!-- IF CONSULTA -->
                        <?php if(isset($var_cod_dur)){ ?>

                        <!-- IF SIM OU NAO -->
                        <?php if($row_dur_detalhe['REP_LAC_SN'] == 'S'){ ?>

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

                        Informe o Lacre</br>
                        <input class="form-control" name='frm_lac_desc' id='lac_desc' disabled value="<?php echo @$row_dur_detalhe['LACRE_DESC']; ?>" <?php echo $sn_readonly; ?>>

                      </div>

                      <div class='col-md-3' style='text-align:left'>

                        Leito Bloqueado? </br>
                        <select class='form-control' name='frm_lt_sn' onchange="habilitar3()" id='lt_sn'>

                        <!-- IF CONSULTA -->
                        <?php if(isset($var_cod_dur)){ ?>

                        <!-- IF SIM OU NAO -->
                        <?php if($row_dur_detalhe['LT_BLOQ_SN'] == 'S'){ ?>

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

                        Motivo</br>
                        <input class="form-control" name='frm_lt_motivo'id='lt_motivo' disabled value="<?php echo @$row_dur_detalhe['LT_MOTIVO_DESC']; ?>" <?php echo $sn_readonly; ?>>

                      </div>

                      <div class='col-md-3' style='text-align:left'>

                        Falta Medicamento? </br>
                        <select class='form-control' name='frm_ft_mm' onchange="habilitar4(); habilitar5()" id='ft_mm'>

                        <!-- IF CONSULTA -->
                        <?php if(isset($var_cod_dur)){ ?>

                        <!-- IF SIM OU NAO -->
                        <?php if($row_dur_detalhe['FT_MM_SN'] == 'S'){ ?>

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

                      Qual?</br>
                      <input class="form-control" name='frm_mm_motivo'id='mm_motivo' disabled value="<?php echo @$row_dur_detalhe['MM_DESC']; ?>" <?php echo $sn_readonly; ?>>

                      </div>

                      <div class='col-md-3' style='text-align:left'>

                        Farmácia Avisada? </br>
                        <select class='form-control' name='frm_farm_sn' id='farm_sn' disabled>

                        <!-- IF CONSULTA -->
                        <?php if(isset($var_cod_dur)){ ?>

                        <!-- IF SIM OU NAO -->
                        <?php if($row_dur_detalhe['FARM_SN'] == 'S'){ ?>

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
                        <select class='form-control' name='frm_pp_sn' onchange="habilitar6()" id='pp_sn'>

                        <!-- IF CONSULTA -->
                        <?php if(isset($var_cod_dur)){ ?>

                        <!-- IF SIM OU NAO -->
                        <?php if($row_dur_detalhe['PPF_SN'] == 'S'){ ?>

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

                      
                      <div class='col-md-8' style='text-align:left'>

                      Conduta</br>
                      <input class="form-control" name='frm_con_desc' id='con_desc' disabled value="<?php echo @$row_dur_detalhe['CONDUTA_DESC']; ?>" <?php echo $sn_readonly; ?>>

                      </div>

                    </div>

                    </br>
                    <div class='row'>

                      <div class='col-md-3' style='text-align:left'>

                          Intercorrência? </br>
                          <select class='form-control' name='frm_ip_sn' onchange="habilitar7()" id='ip_sn'>

                          <!-- IF CONSULTA -->
                          <?php if(isset($var_cod_dur)){ ?>

                          <!-- IF SIM OU NAO -->
                          <?php if($row_dur_detalhe['IP_SN'] == 'S'){ ?>

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
                        
                        <div class='col-md-9' style='text-align:left'>

                        Desfecho</br>
                        <input class="form-control" name='frm_ip_desc' id='ip_desc' disabled value="<?php echo @$row_dur_detalhe['IP_DESC']; ?>" <?php echo $sn_readonly; ?>>

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

//HABILITAR CAMPO 'QUAL' DO EQUIPAMENTO COM PROBLEMA//

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

//HABILITAR CAMPO 'REPOSTO /LACRADO' DO EQUIPAMENTO COM PROBLEMA//

function habilitar1(){

 
var input3 = document.getElementById("ce_sn").value;
var input4 = document.getElementById("rl_sn");

if(input3 == ''){
  input4.disabled = true;
}

if(input3 == 'N'){
  input4.disabled = true;
}

if(input3 == 'S'){
  input4.disabled = false;
}


};


//HABILITAR CAMPO 'INFORME O LACRE' DO EQUIPAMENTO COM PROBLEMA//

function habilitar2(){

 
var input5 = document.getElementById("rl_sn").value;
var input6 = document.getElementById("lac_desc");

if(input5 == ''){
  input6.disabled = true;
}

if(input5 == 'N'){
  input6.disabled = true;
}

if(input5 == 'S'){
  input6.disabled = false;
}


};

//HABILITAR CAMPO 'LEITO' DO EQUIPAMENTO COM PROBLEMA//


function habilitar3(){

 
var input7 = document.getElementById("lt_sn").value;
var input8 = document.getElementById("lt_motivo");

if(input7 == ''){
  input8.disabled = true;
}

if(input7 == 'N'){
  input8.disabled = true;
}

if(input7 == 'S'){
  input8.disabled = false;
}


};

//HABILITAR CAMPO 'FALTA DE MEDICAMENTO' DO EQUIPAMENTO COM PROBLEMA//

function habilitar4(){

 
var input9 = document.getElementById("ft_mm").value;
var input10 = document.getElementById("mm_motivo");

if(input9 == ''){
  input10.disabled = true;
}

if(input9 == 'N'){
  input10.disabled = true;
}

if(input9 == 'S'){
  input10.disabled = false;
}


};

function habilitar5(){

 
var input11 = document.getElementById("ft_mm").value;
var input12 = document.getElementById("farm_sn");

if(input11 == ''){
  input12.disabled = true;
}

if(input11 == 'N'){
  input12.disabled = true;
}

if(input11 == 'S'){
  input12.disabled = false;
}


};

function habilitar6(){

 
var input13 = document.getElementById("pp_sn").value;
var input14 = document.getElementById("con_desc");

if(input13 == ''){
  input14.disabled = true;
}

if(input13 == 'N'){
  input14.disabled = true;
}

if(input13 == 'S'){
  input14.disabled = false;
}


};

function habilitar7(){

 
var input15 = document.getElementById("ip_sn").value;
var input16 = document.getElementById("ip_desc");

if(input15 == ''){
  input16.disabled = true;
}

if(input15 == 'N'){
  input16.disabled = true;
}

if(input15 == 'S'){
  input16.disabled = false;
}


};
</script>