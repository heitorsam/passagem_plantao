<?php 
    //CABECALHO
    include 'cabecalho.php';

    include 'conexao.php';

    $var_sn_adm = @$_SESSION['sn_administrador'];

?>

<div class="div_br"> </div>

        <!--MENSAGENS-->
        <?php
            include 'js/mensagens.php';
            include 'js/mensagens_usuario.php';
        ?>

                <div class="div_br"> </div>
                <div class="div_br"> </div>

                <h11><i class="far fa-calendar-alt"></i> Escalas</h11>

                <div class="div_br"> </div>

                <a href="exame.php" class="botao_home" type="submit"><i class="far fa-clipboard"></i> Exame</a>
                <span class="espaco_pequeno"></span>               

                <div class="div_br"> </div>
                <div class="div_br"> </div>

                <h11><i class="fas fa-cog"></i> Configurações</h11>

                <div class="div_br"> </div>

                <a href="exame.php" class="botao_home btn-adm" type="submit"><i class="far fa-clipboard"></i> Exame</a>
                <span class="espaco_pequeno"></span>

            <div class="div_br"> </div>
            <div class="div_br"> </div>
            <div class="div_br"> </div>  

<?php
    //RODAPE
    include 'rodape.php';
?>