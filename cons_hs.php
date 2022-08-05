<?php

include 'cabecalho.php';

include 'conexao.php';

$var_exibir_pp = $_GET['cod_int'];

$var_cod_dur = $_GET['codigo'];

?>


<h11><i class="fa-solid fa-arrow-right-to-bracket"></i>  Historico de Passsagem</h11>
<span class="espaco_pequeno" style="width: 6px"></span>
<h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a></h27>
<div class="div_br"></div>


<?php

    include 'js/mensagens.php';

?>
<div class="div_br"> </div>

<?php include 'configuracao/modal_pp.php'; ?>

<div class="div_br"> </div>
<div class="div_br"> </div>

<!--TABELA PASSAGEM-->
<?php include 'configuracao/exibir_pp.php'?>



                

<?php

include 'rodape.php';

?>