<?php

include 'cabecalho.php';

include 'conexao.php';

 @$var_unid_inter = $_POST['frm_unid_inter_hs'];
 @$var_date = $_POST['frm_month'];


?>

    <DOCTYPE HTML>

        <html>

            <body>

                <div class="container">
                    
                    <h11><i class="fa-solid fa-arrow-right-to-bracket"></i>  Historico de Passsagem</h11>
                    <span class="espaco_pequeno" style="width: 6px"></span>
                    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a></h27>
                    <div class="div_br"></div>


                    <?php
                    
                        include 'js/mensagens.php';
                    
                    ?>

                    <form method="POST" action='historico_pp.php'>

                        <div class='row'>

                            <div class='col-md-3' style='text-align:left'>

                                    Unidade de Internação
                                    <select class='form-control' name='frm_unid_inter_hs' required>
                                        
                                        <?php include 'configuracao/consulta_unid_int_hs.php'; ?>

                                    </select>
                                    </br>   
                                                             
                            </div>

                            <div class='col-md-2'>
                        

                                    Data
                                    <input class='form-control' name='frm_month' type='month' required>

                            </div>

                            <div class="col-md-3">  
                                
                                <br>
                                <button type="submit" class="btn btn-primary" >
                                <i class="fa-solid fa-magnifying-glass"></i>
                                </button> 

                            </div>

                        </div>

                    </form>

                    <!--TABELA DE INFORMAÇÕES PASSAGEM-->
                    <?php include 'configuracao/exibir_hs.php'?>


























                </div>


            </tbody>
        
        </html>

    </DOCTYPE>

<?php

include 'rodape.php';

?>