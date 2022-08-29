<?php

include 'cabecalho.php';

include 'conexao.php';


?>

                    
<h11><i class="fa-solid fa-note-sticky"></i>  Tipos</h11>
<span class="espaco_pequeno" style="width: 6px"></span>
<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a></h27>
<div class="div_br"></div>

<div class='row'>

    <div class='col-md-3'>

        Nome:
        <input type="text" class="form-control" maxlength="20" id="inpt_nome">
                    
    </div>

    <div class='col-md-2'>

        Sigla:
        <input type="text" class="form-control" maxlength="3" id="inpt_sigla">
                    
    </div>

    <div class="col-md-3">  
        
        <br>
        <button class="btn btn-primary" onclick="ajax_cadastrar()"><i class="fa-solid fa-plus"></i></button> 

    </div>

</div>

</br>

<div id="div_tabela"></div>



<?php

    include 'rodape.php';

?>


<script>

    window.onload = function(){ ajax_tabela() }


    function ajax_cadastrar(){
        var nome = document.getElementById('inpt_nome')
        var sigla = document.getElementById('inpt_sigla')

        if(nome.value != ''){
            if(sigla.value != ''){
                $.ajax({
                    url: "funcoes/tipo/ajax_cad_tipo.php",
                    type: "POST",
                    data: {
                        nome: nome.value,
                        sigla: sigla.value
                        },
                    cache: false,
                    success: function(dataResult){   
                        console.log(dataResult);
                        if(dataResult == '1'){
                            nome.value = ''
                            sigla.value = ''
                        }else{
                            alert('Sigla já cadastrada!')
                            sigla.focus()
                        }
                        ajax_tabela()

                    },
                    
                })
            }else{
                sigla.focus()
            }
        }else{
            nome.focus()
        }
    }

    function ajax_tabela(){
        $('#div_tabela').load('funcoes/tipo/ajax_tabela_tipo.php');

    }

    function ajax_apagar_tipo(cd){
        var resultado = confirm("Deseja apagar esse tipo?");

        if(resultado == true){
            $.ajax({
                url: "funcoes/tipo/ajax_apagar_tipo.php",
                type: "POST",
                data: {
                    cd: cd
                    },
                cache: false,
                success: function(dataResult){   
                    console.log(dataResult)
                    if(dataResult == '0'){
                        alert('Existe uma anotação vinculada a esse tipo!')
                    }
                    ajax_tabela()

                },
                
            })
        }
    }

</script>


