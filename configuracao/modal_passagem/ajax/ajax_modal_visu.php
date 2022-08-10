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
        <select class='form-control' disabled>
            
              <option value="S" selected> Sim </option>
              <option value="N"> Não </option>

        </select>
        </div>

        <div class='col-md-9' style='text-align:left'>

          Qual?:</br>
          <input minlength='5' disabled class="form-control" id='qual_v' value="<?php echo @$row_dur['EQUIP_DESC']; ?>">

        </div>
      <?php }else{ ?> 
        Equip. com Problema? </br>
        <select class='form-control' disabled>
            
              <option value="S" > Sim </option>
              <option value="N" selected> Não </option>

        </select>
        </div>

        <div class='col-md-9' style='text-align:left'>

          Qual?:</br>
          <input minlength='5' class="form-control" id='qual_v' disabled>

        </div>   
      <?php } ?>
    </div>
    </br>
  </div>
  <div class="tab-pane fade" id="nav-farm-edit" role="tabpanel" aria-labelledby="nav-farm-edit-tab">
                
    <div class='row'>
     
        <div class='col-md-3' style='text-align:left'>
        
          Utilizado Carrinho? </br>
          <select class='form-control' disabled>
            <?php if($row_dur['CAR_SN'] == 'S'){ ?>
              <option value=""> Selecione </option>
              <option value="S" selected> Sim </option>
              <option value="N"> Não </option>

          </select>

        </div>
      
        <div class='col-md-3' style='text-align:left'>

          Reposto/Lacrado? </br>
          <select class='form-control' disabled>

            <?php }else{ ?>

              <option value=""> Selecione </option>
              <option value="S" > Sim </option>
              <option value="N" selected> Não </option>
          </select>

        </div>
      
        <div class='col-md-3' style='text-align:left'>

          Reposto/Lacrado? </br>
          <select class='form-control' disabled >

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
            <input minlength='5' class="form-control" disabled  value="<?php echo @$row_dur['LACRE_DESC']; ?>">
          <?php }else{ ?>
            <input minlength='5' class="form-control" disabled >
          <?php } ?>
        </div>
      
      

      
                    
    </div>

    </br>
    <div class='row'>

      <div class='col-md-3' style='text-align:left'>

        Leito Bloqueado? </br>
        <select class='form-control' disabled>


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
          <input minlength='5' class="form-control" disabled value="<?php echo @$row_dur['LT_MOTIVO_DESC']; ?>" >
        <?php }else{ ?>
          <input minlength='5' class="form-control" disabled >
        <?php } ?>  
      </div>
    </div>
    </br>
    <div class="row">
      <div class='col-md-3' style='text-align:left'>

        Falta Medicamento? </br>
        <select class='form-control' disabled>

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
          <input minlength='5' class="form-control" disabled value="<?php echo @$row_dur['MM_DESC']; ?>">
        <?php }else{ ?>  
          <input minlength='5' class="form-control" disabled>
        <?php } ?>  
      </div>

      <div class='col-md-3' style='text-align:left'>

        Farmácia Avisada? </br>
        <?php if($row_dur['FARM_SN'] == 'S'){ ?>
          <select class='form-control' disabled>

            <option value=""> Selecione </option>
            <option value="S" selected> Sim </option>
            <option value="N"> Não </option>          
          </select>
        <?php }else{ ?>  
          <select class='form-control' disabled>

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
  </div>
  <div class="tab-pane fade" id="nav-inter-edit" role="tabpanel" aria-labelledby="nav-inter-edit-tab">
    <div class='col-md-12' style='text-align:left'>  
      <div id="div-inter-edit"></div>
    </div>
    </br>
  </div>
</div>
</br>


<script>

//HABILITAR CAMPO 'QUAL' DO EQUIPAMENTO COM PROBLEMA//

  function ajax_paciente(){

    var cd_dur = '<?php echo $var_cod_dur ?>';

    $('#div-paci-edit').load('configuracao/modal_passagem/ajax/ajax_paciente_v.php?cd_dur='+ cd_dur);

  };

  function ajax_intercorrencia(){

    var cd_dur = '<?php echo $var_cod_dur ?>';

    $('#div-inter-edit').load('configuracao/modal_passagem/ajax/ajax_inter_v.php?cd_dur='+ cd_dur);

  };

</script>