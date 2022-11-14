<?php 
    //CABECALHO
    include 'cabecalho.php';

    include 'conexao.php';

    $var_sn_adm = $_SESSION['sn_administrador'];

    $var_sn_pas = $_SESSION['sn_passagem'];

?>

<div class="div_br"> </div>    

        <!--MENSAGENS-->
        <?php
            include 'js/mensagens.php';
            include 'js/mensagens_usuario.php';
        ?>

                <div class="div_br"> </div>
                <div class="div_br"> </div>

                <h11><i class="far fa-calendar-alt"></i> Passagem Plantão</h11>

                <div class="div_br"> </div>
                    <?php if($var_sn_pas == 'S'){ ?>
                        <a href="passagem_plantao.php" class="botao_home" type="submit"><i class="far fa-clipboard"></i> Passagem Plantão</a>
                        <span class="espaco_pequeno"></span> 
                        
                        <a href="historico_pp.php" class="botao_home" type="submit"><i class="fa-solid fa-list"></i> Histórico Plantão</a>
                        <span class="espaco_pequeno"></span> 
                    <?php } ?>
                    <a href="quadros.php" class="botao_home" type="submit"><i class="fa-solid fa-table"></i> Quadro</a>
                    <span class="espaco_pequeno"></span> 

                    <a href="quadros_visu.php" class="botao_home" type="submit"><i class="fa-solid fa-table"></i> Visualizar Quadro</a>
                    <span class="espaco_pequeno"></span> 

                <?php 

                
                if($_SESSION['sn_administrador'] == 'S'){
                    
                ?>                   

                    <div class="div_br"> </div>
                    <div class="div_br"> </div>

                    <h11><i class="fas fa-cog"></i> Configurações</h11>

                    <div class="div_br"> </div>

                    <a href="permissoes.php" class="botao_home btn-adm" type="submit"><i class="fa-solid fa-chart-bar"></i> Permissões</a>
                    <span class="espaco_pequeno"></span> 

                    <a href="tipos.php" class="botao_home btn-adm" type="submit"><i class="fa-solid fa-note-sticky"></i> Tipos</a>
                    <span class="espaco_pequeno"></span> 

                <?php } ?>

            <div class="div_br"> </div>
            <div class="div_br"> </div>
            <div class="div_br"> </div>  

<?php
    //RODAPE
    include 'rodape.php';
?>