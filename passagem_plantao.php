<?php

    include 'cabecalho.php';

    $var_user = $_SESSION['usuarioLogin'];

    if(isset($_POST['frm_unid_inter_pp'])){


        @$var_exibir_pp = $_POST['frm_unid_inter_pp'];

        @$_SESSION['ss_unid_int_pp'] = $_POST['frm_unid_inter_pp'];


    }else{

        @$var_exibir_pp = 0;
        if(isset($_SESSION['ss_unid_int_pp'])){

            @$var_exibir_pp = $_SESSION['ss_unid_int_pp'];

        }else{

            @$var_exibir_pp = 0;

        }
    }
        

    if(isset($_POST['frm_dta'])){

        @$var_dt_sel = $_POST['frm_dta'];
        @$var_exibir_dt = date("d/m/Y", strtotime($var_dt_sel));
        @$_SESSION['ss_dt'] = $var_dt_sel;

    }else{

        if(isset($_SESSION['ss_dt'])){

            @$var_dt_sel = $_SESSION['ss_dt'];
            @$var_exibir_dt = date("d/m/Y", strtotime($var_dt_sel));

        }
    }

?>





<h11><i class="far fa-calendar-alt"></i> Passagem Plantão</h11>
<span class="espaco_pequeno" style="width: 6px"></span>
<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a></h27>
<div class="div_br"></div>
                    
<?php

    //CHAMANDO MENSAGENS
    include 'js/mensagens.php';

?>


<div class='row'>

    <div class='col-md-3' style='text-align:left'>
        Unidade de Internação
        <select class='form-control' id='unid_int'>
            
            <?php include 'configuracao/consulta_unid_int_pp.php'; ?>

        </select>
        </br>                          
    </div>

    <div class='col-md-2'>
        Data
        <input class='form-control' id='data' type='date'>
    </div>

    <div class="col-md-1" style="text-align: center">
        Agora:
        <input type="checkbox" style="height: 30px !important" class="form-control" id="ck_temp_real" onclick="btn_reserva('ck_temp_real', 'ck_reserva')">
    </div>

    <div class="col-md-1">
        Reservas:
        <input type="checkbox" style="height: 30px !important" class="form-control" id="ck_reserva" onclick="btn_reserva('ck_reserva', 'ck_temp_real')">
    </div>

    <div class="col-md-3">  
        <br>
        <button type="submit" class="btn btn-primary" onclick="ajax_buscar_plantao()" >
        <i class="fa-solid fa-magnifying-glass"></i>
        </button> 
        </br>                                
    </div>

</div>



<!--FORM DURANTE-->





    <!--LISTA DURANTE-->
    <div id="div_durante" style="display: none"></div>

    <div class="div_br"> </div>
    <div class="div_br"> </div>
    <div style="align-items: center; display: flex;">
        <span class="loader" id="loader"></span>
    </div>
<!--TABELA PASSAGEM-->
    <div id="div_plantao" style="display: none"></div>





<?php

    include 'rodape.php';

?>

<script>

    function btn_reserva(id1, id2){
        var x = document.getElementById(id1).checked
        if (x == true){
            document.getElementById(id2).checked = false
        }
    }

    var count_carregamento = 0;
        
    function carregamento(count){
        count_carregamento = count_carregamento + count;
        if(count_carregamento == 2){
            document.getElementById('loader').style.display = "none";
            document.getElementById('div_durante').style.display = "block";
            document.getElementById('div_plantao').style.display = "block";
        }
    }

    function ajax_buscar_plantao(){
        count_carregamento = 0;
        var data = document.getElementById('data').value;
        var unid_int = document.getElementById('unid_int').value;
        var ck_temp = document.getElementById('ck_temp_real').checked;
        var ck_reserva = document.getElementById('ck_reserva').checked;
        
        switch (ck_temp) {
            case true:
                ck_temp = 'S';
                break;
            case false:
                ck_temp = 'N';
        }

        switch (ck_reserva) {
            case true:
                ck_reserva = 'S';
                break;
            case false:
                ck_reserva = 'N';
        }

        if(data == ''){
            document.getElementById('data').focus();
        }else if(unid_int == ''){
            document.getElementById('unid_int').focus();
        }else{
            document.getElementById('div_durante').style.display = "none";
            document.getElementById('div_plantao').style.display = "none";
            document.getElementById('loader').style.display = "inline-block";
            if(ck_reserva == 'S'){
                $('#div_plantao').load('funcoes/plantao/ajax_tabela_plantao_r.php?data='+ data +'&unid_int='+ unid_int+'&sn_reserva='+ ck_reserva);
            }else{
                $('#div_durante').load('funcoes/plantao/ajax_tabela_durante.php?data='+ data +'&unid_int='+ unid_int );
                
                $('#div_plantao').load('funcoes/plantao/ajax_tabela_plantao.php?data='+ data +'&unid_int='+ unid_int+'&sn_temp='+ ck_temp);
            }
        }
    }

    function ajax_apagar_anotacao(codigo){
        var data = document.getElementById('data').value;
        var unid_int = document.getElementById('unid_int').value;
        var resultado = confirm("Tem certeza que deseja excluir?");
        if(resultado == true){
            $.ajax({
                    url: "funcoes/plantao/ajax_deletar_anotacao.php",
                    type: "POST",
                    data: {
                        codigo: codigo
                        },
                    cache: false,
                    success: function(dataResult){
                        $('#div_durante').load('funcoes/plantao/ajax_tabela_durante.php?data='+ data +'&unid_int='+ unid_int);
                    }
            });
        }

    }

    function ajax_cadastrar_anotacao(){
        
        
        var data = document.getElementById('data').value;
        var unid_int = document.getElementById('unid_int').value;
        var frm_dta = document.getElementById('frm_dta').value;
        var frm_unid = document.getElementById('frm_unid').value;
        var frm_ep_sn = document.getElementById('ep_sn').value;
        var frm_equip_desc = document.getElementById('qual').value;
        var frm_ce_sn = document.getElementById('ce_sn').value;
        var frm_rl_sn = document.getElementById('rl_sn').value;
        var frm_lac_desc = document.getElementById('lac_desc').value;
        var frm_lt_sn = document.getElementById('lt_sn').value;
        var frm_lt_motivo = document.getElementById('lt_motivo').value;
        var frm_ft_mm = document.getElementById('ft_mm').value;
        var frm_mm_motivo = document.getElementById('mm_motivo').value;
        var frm_farm_sn = document.getElementById('farm_sn').value;

        if(frm_ep_sn == ''){
            document.getElementById('ep_sn').focus();
        }else{
            if(frm_ep_sn == 'S' && frm_equip_desc == ''){
                document.getElementById('qual').focus();
            }else{
                if(frm_ce_sn == ''){
                    document.getElementById('ce_sn').focus();
                }else{
                    if(frm_ce_sn == 'S' && frm_rl_sn == ''){
                        document.getElementById('rl_sn').focus();
                    }else{
                        if(frm_ce_sn == 'S' && frm_rl_sn == 'N' && frm_lac_desc == ''){
                            document.getElementById('lac_desc').focus();
                        }else{
                            if(frm_lt_sn == ''){
                                document.getElementById('lt_sn').focus();
                            }else{
                                if(frm_lt_sn == 'S' && frm_lt_motivo == ''){
                                    document.getElementById('lt_motivo').focus();
                                }else{
                                    if(frm_ft_mm == ''){
                                        document.getElementById('ft_mm').focus();
                                    }else{
                                        if(frm_ft_mm == 'S' && frm_mm_motivo == ''){
                                            document.getElementById('mm_motivo').focus();
                                        }else{
                                            if(frm_ft_mm == 'S' && frm_farm_sn == ''){
                                                document.getElementById('farm_sn').focus();
                                            }else{
                                                $.ajax({
                                                    url: "configuracao/cadastro_durante.php",
                                                    type: "POST",
                                                    data: {
                                                        frm_dta: frm_dta,
                                                        frm_unid: frm_unid,
                                                        frm_ep_sn: frm_ep_sn,
                                                        frm_equip_desc: frm_equip_desc,
                                                        frm_ce_sn: frm_ce_sn,
                                                        frm_rl_sn: frm_rl_sn,
                                                        frm_lac_desc: frm_lac_desc,
                                                        frm_lt_sn: frm_lt_sn,
                                                        frm_lt_motivo: frm_lt_motivo,
                                                        frm_ft_mm: frm_ft_mm,
                                                        frm_mm_motivo: frm_mm_motivo,
                                                        frm_farm_sn: frm_farm_sn

                                                        },
                                                    cache: false,
                                                    success: function(dataResult){

                                                        $('#id_criar_dur').modal('hide');
                                                        $('.modal-backdrop').remove();
                                                        $('#div_durante').load('funcoes/plantao/ajax_tabela_durante.php?data='+ data +'&unid_int='+ unid_int);
                                                    }
                                                });
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    function ajax_editar_dur(){
      
        var cd_dur = document.getElementById('cd_dur').value;
        var frm_ep_sn = document.getElementById('ep_sn_e').value;
        var frm_equip_desc = document.getElementById('qual_e').value;
        var frm_ce_sn = document.getElementById('ce_sn_e').value;
        var frm_rl_sn = document.getElementById('rl_sn_e').value;
        var frm_lac_desc = document.getElementById('lac_desc_e').value;
        var frm_lt_sn = document.getElementById('lt_sn_e').value;
        var frm_lt_motivo = document.getElementById('lt_motivo_e').value;
        var frm_ft_mm = document.getElementById('ft_mm_e').value;
        var frm_mm_motivo = document.getElementById('mm_motivo_e').value;
        var frm_farm_sn = document.getElementById('farm_sn_e').value;

        if(frm_ep_sn == ''){
            document.getElementById('ep_sn_e').focus();
        }else{
            if(frm_ep_sn == 'S' && frm_equip_desc == ''){
                document.getElementById('qual_e').focus();
            }else{
                if(frm_ce_sn == ''){
                    document.getElementById('ce_sn_e').focus();
                }else{
                    if(frm_ce_sn == 'S' && frm_rl_sn == ''){
                        document.getElementById('rl_sn_e').focus();
                    }else{
                        if(frm_ce_sn == 'S' && frm_rl_sn == 'N' && frm_lac_desc == ''){
                            document.getElementById('lac_desc_e').focus();
                        }else{
                            if(frm_lt_sn == ''){
                                document.getElementById('lt_sn_e').focus();
                            }else{
                                if(frm_lt_sn == 'S' && frm_lt_motivo == ''){
                                    document.getElementById('lt_motivo_e').focus();
                                }else{
                                    if(frm_ft_mm == ''){
                                        document.getElementById('ft_mm_e').focus();
                                    }else{
                                        if(frm_ft_mm == 'S' && frm_mm_motivo == ''){
                                            document.getElementById('mm_motivo_e').focus();
                                        }else{
                                            if(frm_ft_mm == 'S' && frm_farm_sn == ''){
                                                document.getElementById('farm_sn_e').focus();
                                            }else{
                                                $.ajax({
                                                    url: "configuracao/editar_durante.php",
                                                    type: "POST",
                                                    data: {
                                                        
                                                        cd_dur: cd_dur,
                                                        frm_ep_sn: frm_ep_sn,
                                                        frm_equip_desc: frm_equip_desc,
                                                        frm_ce_sn: frm_ce_sn,
                                                        frm_rl_sn: frm_rl_sn,
                                                        frm_lac_desc: frm_lac_desc,
                                                        frm_lt_sn: frm_lt_sn,
                                                        frm_lt_motivo: frm_lt_motivo,
                                                        frm_ft_mm: frm_ft_mm,
                                                        frm_mm_motivo: frm_mm_motivo,
                                                        frm_farm_sn: frm_farm_sn

                                                        },
                                                    cache: false,
                                                    success: function(dataResult){
                                                        alert('Editado com sucesso!');
                                                        $('#id_editar_dur').modal('hide');
                                                        $('#div_durante').load('funcoes/plantao/ajax_tabela_durante.php?data='+ data +'&unid_int='+ unid_int);
                                                    }
                                                });
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

</script>