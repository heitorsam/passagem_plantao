

<div class='col-md-12' style='text-align:left'>

    <div id="div_tabela_obs"></div>

</div>
<div class="col-md-12 input-group">
    <input type="text" class="form-control" style="border-radius: 5px 0px 0px 5px !important" maxlength="100" id="input_observacao">
    <button type="button" class="btn btn-primary" style="border-radius: 0px 5px 5px 0px !important" onclick="salvar_observacao('<?php echo $id ?>')" ><i class="fa-solid fa-floppy-disk"></i></button>
</div>

<script>

    $(document).ready(function() {
        $('#div_tabela_obs').load('configuracao/modal_passagem/ajax/ajax_tabela_obs_especial.php?id='+ <?php echo $id ?>);
    });

    function salvar_observacao(id){
        
        var obs = document.getElementById('input_observacao').value;
        
        if(obs != ''){
            $.ajax({
                url: "configuracao/modal_passagem/ajax/ajax_salvar_observacao.php",
                type: "POST",
                data: {
                    id: id,
                    obs: obs
                    },
                cache: false,
                success: function(dataResult){

                    document.getElementById('input_observacao').value = '';
                    $('#div_tabela_obs').load('configuracao/modal_passagem/ajax/ajax_tabela_obs_especial.php?id='+ id);
                }
            });   
        }else{
            document.getElementById('input_observacao').focus();
        }
    }

    function apagar_observacao(cd_obs){
        resultado = confirm("Deseja excluir a observação?");
        if(resultado == true){
            $.ajax({
                url: "configuracao/modal_passagem/ajax/ajax_apagar_observacao.php",
                type: "POST",
                data: {
                    cd_obs
                    },
                cache: false,
                success: function(dataResult){
                    $('#div_tabela_obs').load('configuracao/modal_passagem/ajax/ajax_tabela_obs_especial.php?id='+ <?php echo $id ?>);
                }
            });  
        }
    }

    function mudar_situacao(cd_obs, sn){
        resultado = confirm("Deseja mudar a situação?");
        if(resultado == true){
            $.ajax({
                url: "configuracao/modal_passagem/ajax/ajax_situacao_observacao.php",
                type: "POST",
                data: {
                    cd_obs,
                    sn: sn
                    },
                cache: false,
                success: function(dataResult){
                    $('#div_tabela_obs').load('configuracao/modal_passagem/ajax/ajax_tabela_obs_especial.php?id='+ <?php echo $id ?>);
                }
            }); 
        } 
    }


</script>