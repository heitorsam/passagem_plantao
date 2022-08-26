<?php

include 'cabecalho.php';

include 'conexao.php';


?>

                    
<h11><i class="fa-solid fa-table"></i>  Quadros</h11>
<span class="espaco_pequeno" style="width: 6px"></span>
<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a></h27>
<div class="div_br"></div>

<div class='row'>

    <div class='col-md-3'>

        Unidade de Internação
        <select class='form-control' id="unid_int">
            
            <?php include 'configuracao/consulta_unid_int_hs.php'; ?>

        </select>
                    
    </div>

    <div class="col-md-3">  
        
        <br>
        <button class="btn btn-primary" onclick="ajax_pesquisar()"><i class="fa-solid fa-magnifying-glass"></i></button> 

    </div>

</div>

</br>

<div id="div_input"></div>

</br>

<div id="div_tabela"></div>


<?php

    include 'rodape.php';

?>


<script>

    var unid_int = 0

    function ajax_pesquisar(){

        unid_int = document.getElementById('unid_int').value;

        if(unid_int == ''){

            document.getElementById('unid_int').focus();

        }else{
            
            $('#div_input').load('funcoes/quadros/ajax_input.php?unid_int='+ unid_int);
            ajax_tabela(unid_int);

        }
    }

    function ajax_tabela(unid_int){
        $('#div_tabela').load('funcoes/quadros/ajax_tabelas.php?unid_int='+ unid_int);

    }

    function ajax_tabela_t_h(){
        var var_leito = document.getElementById('input_valor_leito')
        var var_paciente = document.getElementById('inpt_paciente')
        var var_tipo = document.getElementById('slct_tipo')
        var var_cor = document.getElementById('slct_cor')
        var var_observacao = document.getElementById('inpt_observacao')
        var var_dia = document.getElementById('inpt_dia')

        if(var_leito.value != ''){
            if(var_paciente.value != ''){
                if(var_tipo.value != ''){
                    if(var_cor.value != '#fff'){
                        if(var_dia.value != ''){
                            $.ajax({
                                url: "funcoes/quadros/ajax_cad_anotacao.php",
                                type: "POST",
                                data: {
                                    leito: var_leito.value,
                                    tipo: var_tipo.value,
                                    cor: var_cor.value,
                                    obs: var_observacao.value,
                                    dia: var_dia.value.replace('T',' ')
                                    },
                                cache: false,
                                success: function(dataResult){   
                                    console.log(dataResult);
                                    var_leito.value = '';
                                    var_paciente.value = '';
                                    var_tipo.value = '';
                                    var_cor.selectedIndex = '0';
                                    fnc_cor();
                                    var_observacao.value = '';
                                    var_dia.value = '';
                                    ajax_tabela(unid_int)

                                },
                                
                            })
                        }else{
                            var_dia.focus()
                        }
                    }else{
                        var_cor.focus()
                    }
                }else{
                    var_tipo.focus()
                }
            }else{
                var_leito.focus()
            }
        }else{
            var_leito.focus()
        }
    }

    function ajax_apagar_anotacao(cd){
        $.ajax({
            url: "funcoes/quadros/ajax_apagar_anotacao.php",
            type: "POST",
            data: {
                cd: cd
                },
            cache: false,
            success: function(dataResult){   
                console.log(dataResult);
                ajax_tabela(unid_int)

            },
            
        })
    }


</script>