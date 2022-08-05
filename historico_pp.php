<?php

include 'cabecalho.php';

include 'conexao.php';


?>

                    
<h11><i class="fa-solid fa-arrow-right-to-bracket"></i>  Historico de Passsagem</h11>
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
</br>
<div id="div_tabela"></div>

<?php

include 'rodape.php';

?>


<script>


    function ajax_pesquisar(){
        var unid_int = document.getElementById('unid_int').value;

        if(unid_int == ''){
            document.getElementById('unid_int').focus();
        }else{
            
            $('#div_tabela').load('funcoes/historico/ajax_tabela_historico.php?unid_int='+ unid_int);

                
        }
    }


</script>