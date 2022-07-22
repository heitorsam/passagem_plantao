    <?php

        include 'cabecalho.php';

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

    <!DOCTYPE HTML>

        <html>

            <body>

                <div class="container">

                    <h11><i class="far fa-calendar-alt"></i> Passagem Plantão</h11>
                    <span class="espaco_pequeno" style="width: 6px"></span>
                    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a></h27>
                    <div class="div_br"></div>
                                        
                    <?php

                        //CHAMANDO MENSAGENS
                        include 'js/mensagens.php';

                    ?>

                    <form method="POST" action="estrutura_passagem_plantao.php">

                        <div class='row'>

                            <div class='col-md-3' style='text-align:left'>

                                Unidade de Internação
                                <select class='form-control' name='frm_unid_inter_pp' value="<?php echo $var_exibir_pp ?>" required>
                                    
                                    <?php include 'configuracao/consulta_unid_int_pp.php'; ?>

                                </select>
                                </br>   
                                                        
                                </div>

                                <div class='col-md-2'>


                                Data
                                <input class='form-control' name='frm_dta' type='date' value='<?php echo $var_dt_sel; ?>' required>

                                </div>

                                <div class="col-md-3">  

                                <br>
                                <button type="submit" class="btn btn-primary" >
                                <i class="fa-solid fa-magnifying-glass"></i>
                                </button> 

                                </br>                                

                            </div>

                        </div>

                    </form>

                    <!--FORM DURANTE-->

                    

                    <?php 

                        @$aux_sel = date('d/m/Y', strtotime($var_dt_sel));
                        @$hoje = date('d/m/Y'); 
                        
                        if($aux_sel == $hoje){

                            include 'configuracao/modal_pp.php';

                        }else{

                            //echo 'Não é Igual';
                        
                        }

                        
                    
                    ?>
                    
                    <div class="div_br"> </div>
                    <div class="div_br"> </div>

                     <!--LISTA DURANTE-->
                     <?php include 'configuracao/exibir_lista_durante.php'; ?>

                    <div class="div_br"> </div>
                    <div class="div_br"> </div>
                    
                    <!--TABELA PASSAGEM-->
                    <?php include 'configuracao/exibir_pp.php'?>

                </div>

            </body>

        </html>

    </DOCTYPE HTML>

    <?php

        include 'rodape.php';

    ?>