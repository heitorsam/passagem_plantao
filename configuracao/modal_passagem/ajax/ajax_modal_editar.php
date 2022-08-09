<?php

  include '../../../conexao.php';

  $sn_readonly = '';

  $var_cod_dur = $_GET['cd_dur'];

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





<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-equip-edit-tab" data-toggle="tab" data-target="#nav-equip-edit" type="button" role="tab" aria-controls="nav-equip-edit" aria-selected="true" style="color: #fff; background-color: #3185c1;">Equipamentos</button>
    <button class="nav-link" id="nav-farm-edit-tab" data-toggle="tab" data-target="#nav-farm-edit" type="button" role="tab" aria-controls="nav-farm-edit" aria-selected="false" style="color: #fff; background-color: #3185c1;">Farmácia</button>
    <button class="nav-link" id="nav-paci-edit-tab" data-toggle="tab" onclick="ajax_paciente()" data-target="#nav-paci-edit" type="button" role="tab" aria-controls="nav-paci-edit" aria-selected="false" style="color: #fff; background-color: #3185c1;">Paciente</button>
    <button class="nav-link" id="nav-inter-edit-tab" data-toggle="tab" onclick="ajax_intercorrencia()" data-target="#nav-inter-edit" type="button" role="tab" aria-controls="nav-inter-edit" aria-selected="false" style="color: #fff; background-color: #3185c1;">Intercorrência</button>
  </div>
</nav>
</br>
<div class="tab-content" id="nav-tabContent">
  <input type="text" id="cd_dur" value = "<?php echo $var_cod_dur ?>" hidden>
  <div class="tab-pane fade show active" id="nav-equip-edit" role="tabpanel" aria-labelledby="nav-equip-edit-tab">
    <div class="row">

      <div class='col-md-3' style='text-align:left'>
      <?php if($row_dur['EQUIP_SN'] == 'S'){ ?>
        Equip. com Problema? </br>
        <select class='form-control' onchange="habilitar_campo('ep_sn_e','qual_e','')" id='ep_sn_e'>
            
              <option value="S" selected> Sim </option>
              <option value="N"> Não </option>

        </select>
        </div>

        <div class='col-md-9' style='text-align:left'>

          Qual?:</br>
          <input minlength='5' class="form-control" id='qual_e' value="<?php echo @$row_dur['EQUIP_DESC']; ?>">

        </div>
      <?php }else{ ?> 
        Equip. com Problema? </br>
        <select class='form-control' onchange="habilitar_campo('ep_sn_e','qual_e','')" id='ep_sn_e'>
            
              <option value="S" > Sim </option>
              <option value="N" selected> Não </option>

        </select>
        </div>

        <div class='col-md-9' style='text-align:left'>

          Qual?:</br>
          <input minlength='5' class="form-control" id='qual_e' disabled>

        </div>   
      <?php } ?>
    </div>
    </br>
  </div>
  <div class="tab-pane fade" id="nav-farm-edit" role="tabpanel" aria-labelledby="nav-farm-edit-tab">
                
    <div class='row'>
     
        <div class='col-md-3' style='text-align:left'>
        
          Utilizado Carrinho? </br>
          <select class='form-control' onchange="habilitar_campo('ce_sn_e','rl_sn_e','lac_desc_e')" id='ce_sn_e'>
            <?php if($row_dur['CAR_SN'] == 'S'){ ?>
              <option value=""> Selecione </option>
              <option value="S" selected> Sim </option>
              <option value="N"> Não </option>

          </select>

        </div>
      
        <div class='col-md-3' style='text-align:left'>

          Reposto/Lacrado? </br>
          <select class='form-control' onchange="habilitar_campo_lacre('rl_sn_e','lac_desc_e','')" id='rl_sn_e'>

            <?php }else{ ?>

              <option value=""> Selecione </option>
              <option value="S" > Sim </option>
              <option value="N" selected> Não </option>
          </select>

        </div>
      
        <div class='col-md-3' style='text-align:left'>

          Reposto/Lacrado? </br>
          <select class='form-control' disabled onchange="habilitar_campo_lacre('rl_sn_e','lac_desc_e','')" id='rl_sn_e'>

            <?php } ?>
      
            <!-- FIM IF CONSULTA -->

          


            <?php if($row_dur['REP_LAC_SN'] == 'S'){ ?>                               

              <option value=""> Selecione </option>
              <option value="S" selected> Sim </option>
              <option value="N"> Não </option>
            <?php }else{ ?>
              <option value=""> Selecione </option>
              <option value="S" > Sim </option>
              <option value="N" selected> Não </option>
            <?php } ?>

          </select>

        </div>

        <div class='col-md-3' style='text-align:left'>

          Informe o Lacre:</br>
          <?php if($row_dur['REP_LAC_SN'] == 'N'){ ?> 
            <input minlength='5' class="form-control" id='lac_desc_e'  value="<?php echo @$row_dur['LACRE_DESC']; ?>">
          <?php }else{ ?>
            <input minlength='5' class="form-control" id='lac_desc_e' disabled >
          <?php } ?>
        </div>
      
      

      
                    
    </div>

    </br>
    <div class='row'>

      <div class='col-md-3' style='text-align:left'>

        Leito Bloqueado? </br>
        <select class='form-control' onchange="habilitar_campo('lt_sn_e','lt_motivo_e','')" id='lt_sn_e'>


        <?php if($row_dur['LT_BLOQ_SN'] == 'S'){ ?>
          <option value=""> Selecione </option>
          <option value="S" selected> Sim </option>
          <option value="N"> Não </option>
                                

        <?php }else{ ?>  

          <option value=""> Selecione </option>
          <option value="S"> Sim </option>
          <option value="N" selected> Não </option>

        <?php } ?>  


        </select>

      </div>

      <div class='col-md-3' style='text-align:left'>

        Motivo:</br>
        <?php if($row_dur['LT_BLOQ_SN'] == 'S'){ ?>
          <input minlength='5' class="form-control" id='lt_motivo_e' value="<?php echo @$row_dur['LT_MOTIVO_DESC']; ?>" >
        <?php }else{ ?>
          <input minlength='5' class="form-control" id='lt_motivo_e' disabled >
        <?php } ?>  
      </div>
    </div>
    </br>
    <div class="row">
      <div class='col-md-3' style='text-align:left'>

        Falta Medicamento? </br>
        <select class='form-control' onchange="habilitar_campo('ft_mm_e','mm_motivo_e','farm_sn_e');habilitar_campo('ft_mm_e','farm_sn_e','')" id='ft_mm_e'>

          <?php if($row_dur['FT_MM_SN'] == 'S'){ ?>
            <option value=""> Selecione </option>
            <option value="S" selected> Sim </option>
            <option value="N" > Não </option>
                                
          <?php }else{ ?>  

            <option value=""> Selecione </option>
            <option value="S"> Sim </option>
            <option value="N" selected> Não </option>

          <?php } ?>  

        </select>

      </div>

      <div class='col-md-3' style='text-align:left'>

        Qual?:</br>
        <?php if($row_dur['FT_MM_SN'] == 'S'){ ?>
          <input minlength='5' class="form-control" id='mm_motivo_e' value="<?php echo @$row_dur['MM_DESC']; ?>">
        <?php }else{ ?>  
          <input minlength='5' class="form-control" id='mm_motivo_e' disabled>
        <?php } ?>  
      </div>

      <div class='col-md-3' style='text-align:left'>

        Farmácia Avisada? </br>
        <?php if($row_dur['FARM_SN'] == 'S'){ ?>
          <select class='form-control' id='farm_sn_e' >

            <option value=""> Selecione </option>
            <option value="S" selected> Sim </option>
            <option value="N"> Não </option>          
          </select>
        <?php }else{ ?>  
          <select class='form-control' id='farm_sn_e' disabled>

            <option value=""> Selecione </option>
            <option value="S"> Sim </option>
            <option value="N" selected> Não </option>
          </select>
          <?php } ?>  


       

      </div>

    </div>
    </br>
  </div>
  <div class="tab-pane fade" id="nav-paci-edit" role="tabpanel" aria-labelledby="nav-paci-edit-tab">
    <div class='col-md-12' style='text-align:left'>  
      <div id="div-paci-edit"></div>
    </div>
    <div class="col-md-12 input-group">
      <input type="text" class="form-control" style="border-radius: 5px 0px 0px 5px !important" maxlength="200" id="input_observacao_paci_e">
      <button type="button" class="btn btn-primary" style="border-radius: 0px 5px 5px 0px !important" onclick="salvar_observacao_paci_e()" ><i class="fa-solid fa-floppy-disk"></i></button>
    </div>
  </div>
  <div class="tab-pane fade" id="nav-inter-edit" role="tabpanel" aria-labelledby="nav-inter-edit-tab">
    <div class='col-md-12' style='text-align:left'>  
      <div id="div-inter-edit"></div>
    </div>
    <div class="col-md-12 input-group">
      <input type="text" class="form-control" style="border-radius: 5px 0px 0px 5px !important" maxlength="200" id="input_observacao_inter_e">
      <button type="button" class="btn btn-primary" style="border-radius: 0px 5px 5px 0px !important" onclick="salvar_observacao_inter_e()" ><i class="fa-solid fa-floppy-disk"></i></button>
    </div>
    </br>
  </div>
</div>
</br>


<script>

//HABILITAR CAMPO 'QUAL' DO EQUIPAMENTO COM PROBLEMA//

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

  function habilitar_campo_lacre(input1, input2, input3){

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

    if(var_input == 'S'){
      if(input3 != ''){
        var_input3.disabled = true;
        var_input3.value = '';
      }
      var_input2.disabled = true;
      var_input2.value = '';
    }

    if(var_input == 'N'){

      var_input2.disabled = false;

    }

  };

  function ajax_paciente(){

    var cd_dur = '<?php echo $var_cod_dur ?>';

    $('#div-paci-edit').load('configuracao/modal_passagem/ajax/ajax_paciente_e.php?cd_dur='+ cd_dur);

  };

  function ajax_intercorrencia(){

    var cd_dur = '<?php echo $var_cod_dur ?>';

    $('#div-inter-edit').load('configuracao/modal_passagem/ajax/ajax_inter_e.php?cd_dur='+ cd_dur);

  };


  function salvar_observacao_paci_e(){
      
    var obs = document.getElementById('input_observacao_paci_e').value;

    var cd_dur = '<?php echo $var_cod_dur ?>';


    if(obs != ''){
        $.ajax({
            url: "configuracao/modal_passagem/ajax/ajax_salvar_observacao_paci_e.php",
            type: "POST",
            data: {
                obs: obs,
                cd_dur: cd_dur
                },
            cache: false,
            success: function(dataResult){
                document.getElementById('input_observacao_paci_e').value = '';
                $('#div-paci-edit').load('configuracao/modal_passagem/ajax/ajax_paciente_e.php?cd_dur='+ cd_dur);
            }
        });   
    }else{
        document.getElementById('input_observacao_paci').focus();
    }
  };

  function apagar_observacao_paci(cd_obs){
    var cd_dur = '<?php echo $var_cod_dur ?>';
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
        
          $('#div-paci-edit').load('configuracao/modal_passagem/ajax/ajax_paciente_e.php?cd_dur='+ cd_dur);
        }
      });  
    }
  };

  function salvar_observacao_inter_e(){
      
    var obs = document.getElementById('input_observacao_inter_e').value;
    var cd_dur = '<?php echo $var_cod_dur ?>';

    if(obs != ''){
        $.ajax({
            url: "configuracao/modal_passagem/ajax/ajax_salvar_observacao_inter_e.php",
            type: "POST",
            data: {
                obs: obs,
                cd_dur: cd_dur
                },
            cache: false,
            success: function(dataResult){
                document.getElementById('input_observacao_inter_e').value = '';
                $('#div-inter-edit').load('configuracao/modal_passagem/ajax/ajax_inter_e.php?cd_dur='+ cd_dur);
            }
        });   
    }else{
        document.getElementById('input_observacao_paci').focus();
    }
  };

  function apagar_observacao_inter(cd_obs){
    var cd_dur = '<?php echo $var_cod_dur ?>';
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
          $('#div-inter-edit').load('configuracao/modal_passagem/ajax/ajax_inter_e.php?cd_dur='+ cd_dur);
        }
      });  
    }
  };



</script>