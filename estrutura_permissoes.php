    <?php

        include 'cabecalho.php';
        include 'configuracao/consulta_permissoes.php';
    ?>

    <!DOCTYPE HTML>

        <html>

            <body>

                <div class="container">

                    <h11><i class="fa-solid fa-chart-bar"></i> Permissoes</h11>
                    <span class="espaco_pequeno" style="width: 6px"></span>
                    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a></h27>
                    <div class="div_br"></div>

                    <?php

                        //CHAMANDO MENSAGENS
                        include 'js/mensagens.php';

                    ?>

                    <form method="POST" action="estrutura_permissoes.php">

                        <div class="row">

                            <div class='col-md-3' style='text-align:left'>

                                Código Usuário:
                                <div class="input-group">
    
                                    <input class='form-control' name='frm_usuario' type="text" placeholder= 'Login MV' value='<?php echo @$var_cod; ?>'>
                                    <div><button type='submit' class='btn btn-primary'><i class="fa-solid fa-magnifying-glass"></i></button></div>

                                </div>
       
                            </div>

                        </div>

                    </form>
                    <br>

                    <div class="row">

                        <div class='col-md-2'>

                            Usuário:
                            <input class='form-control' type='text' value='<?php echo @$var_cod; ?>' readonly>

                        </div>

                        <div class='col-md-3'>

                            Nome:
                            <input class='form-control' type='text' value='<?php echo @$var_nome; ?>' readonly>

                        </div>
                        
                        <div class='col-md-2'>

                            Função:
                            <input class='form-control' type='text' value='<?php echo @$var_funcao; ?>' readonly>

                        </div>

                    </div>
                    <br>
                    <hr>

                    <form method="POST" action="configuracao/adicionar_permissoes.php">

                         <!-- DEPOIS SERA OCULTADO -->
                         <input class='form-control' type='text' name="frm_cd_usuario" value='<?php echo @$var_cod; ?>' hidden>
                    
                        <div class='row'>

                            <div class='col-md-3' style='text-align:left'>

                                Unidade de Internação:
                                
                                <div class='input-group'>
                                   
                                    <select class='form-control' name='frm_unid_inter' required>
                                        
                                        <?php include 'configuracao/consulta_unid_int.php'; ?>

                                    </select>

                                    <div><button type='submit' class='btn btn-primary'><i class="fas fa-plus"></i></button></div>

                                </div>

                            </div>
                            <br>
                            <br>

                            <br>

                        </div>

                    </form>
                    </br>

                    <?php include 'configuracao/exibir_permissoes_cadastradas.php'?>


                </div>

            </body>



        </html>




    <?php

        include 'rodape.php';

    ?>