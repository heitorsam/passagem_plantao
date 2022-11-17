    <?php

        include 'cabecalho.php';
        include 'configuracao/consulta_permissoes.php';
    ?>

    <h11><i class="fa-solid fa-chart-bar"></i> Permissões</h11>
    <span class="espaco_pequeno" style="width: 6px"></span>
    <h27><a href="home.php" style="color: #444444; text-decoration: none;"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a></h27>
    <div class="div_br"></div>



    <div class="row">

        <div class='col-md-3' style='text-align:left'>

            Código Usuário:
            <div class="input-group">
            <?php 
            
                //CONSULTA_LISTA
                $consulta_lista = "SELECT usu.CD_USUARIO AS NOME
                                        FROM dbasgu.USUARIOS usu
                                        WHERE usu.sn_ativo = 'S'
                                    ORDER BY 1 ASC";
                $result_lista = oci_parse($conn_ora, $consulta_lista);																									

                //EXECUTANDO A CONSULTA SQL (ORACLE)
                oci_execute($result_lista);            

            ?>

            <script>

                //LISTA
                var countries = [     
                    <?php
                        while($row_lista = oci_fetch_array($result_lista)){	
                            echo '"'. str_replace('"' , '', $row_lista['NOME']) .'",';                
                        }
                    ?>
                ];

                </script>

                <?php
                //AUTOCOMPLETE
                include 'funcoes/permissoes/autocomplete_prestador.php';

            ?>

            </div>

        </div>

    </div>


    <br>
    
    <div class="row" id="div_usuario">

        <div class='col-md-2'>

            Usuário:
            <input class='form-control' type='text' readonly>

        </div>

        <div class='col-md-3'>

            Nome:
            <input class='form-control' type='text' readonly>

        </div>
        
        <div class='col-md-2'>

            Função:
            <input class='form-control' type='text' readonly>

        </div>

    
    
    </div>
    <div class="div_br"></div>
    
    <div id="div_permissoes">
    </div>

    <div id="tabela_permissoes">
    </div>


        <script>

            function ajax_buscar_usuario(){

                var usuario = document.getElementById('input').value
                if(usuario != ''){
                    $('#div_usuario').load('funcoes/permissoes/ajax_usuario.php?cd_usuario='+ usuario);
                    $('#div_permissoes').load('funcoes/permissoes/ajax_permissoes.php?cd_usuario='+ usuario);
                    $('#tabela_permissoes').load('funcoes/permissoes/ajax_tabela_permissoes.php?cd_usuario='+ usuario);

                }else{
                    document.getElementById('input').focus()
                }


            }

            function ajax_adicionar_permissao(){
                var setor = document.getElementById('frm_unid_inter').value;
                var usuario = document.getElementById('input').value;
                if(setor != ''){
                    $('#div_permissoes').load('funcoes/permissoes/ajax_permissoes.php?cd_usuario='+ usuario);
                    $.ajax({
                        url: "funcoes/permissoes/ajax_cad_permissao.php",
                        type: "POST",
                        data: {
                            cd_usuario: usuario,
                            setor: setor
                            },
                        cache: false,
                        success: function(dataResult){
                            console.log(dataResult)
                            $('#div_permissoes').load('funcoes/permissoes/ajax_permissoes.php?cd_usuario='+ usuario);
                            $('#tabela_permissoes').load('funcoes/permissoes/ajax_tabela_permissoes.php?cd_usuario='+ usuario);
                        }
                    });                    

                }else{
                    document.getElementById('frm_unid_inter').focus();
                }
            }

            function ajax_deletar_permissao(cd_setor){
                var usuario = document.getElementById('input').value;
                resultado = confirm("Deseja excluir a observação?");
                if(resultado == true){
                    $.ajax({
                        url: "funcoes/permissoes/ajax_deletar_permissao.php",
                        type: "POST",
                        data: {
                            codigo: cd_setor
                            },
                        cache: false,
                        success: function(dataResult){
                            $('#div_permissoes').load('funcoes/permissoes/ajax_permissoes.php?cd_usuario='+ usuario);
                            $('#tabela_permissoes').load('funcoes/permissoes/ajax_tabela_permissoes.php?cd_usuario='+ usuario);
                        }
                    });   
                }
            }


        </script>        




    <?php

        include 'rodape.php';

    ?>