<?php 
    $var_unid_int = $_GET['unid_int'];

    session_start();
    include '../../conexao.php';

?>

<div class="row">

    <div class="col-md-2">
        Leito:
        <?php 
        
            //CONSULTA_LISTA
            $consulta_lista = "SELECT lt.DS_ENFERMARIA AS LEITO FROM dbamv.LEITO lt
                                WHERE lt.TP_OCUPACAO IN ('I','O')
                                AND lt.CD_UNID_INT = $var_unid_int
                                ORDER BY 1";
            $result_lista = oci_parse($conn_ora, $consulta_lista);																									

            //EXECUTANDO A CONSULTA SQL (ORACLE)
            oci_execute($result_lista);            

        ?>

        <script>

            //LISTA
            var countries = [     
                <?php
                    while($row_lista = oci_fetch_array($result_lista)){	
                        echo '"'. str_replace('"' , '', $row_lista['LEITO']) .'",';                
                    }
                ?>
            ];

        </script>

        <?php include 'autocomplete_leito.php'; ?>
    </div>

    <div class="col-md-3">
        Paciente:
        <input type="text" id="inpt_paciente" disabled class="form-control">
        <input type="hidden" id="inpt_cd_paciente" class="form-control">
    </div>
    <div class="col-md-2">
        Tipo:
        <select class="form-control tp_quadro" id="slct_tipo">
            <option value="">Selecione</option>
            <?php 
                $consulta = "SELECT CD_TIPO AS CD, NM_TIPO AS NM FROM passagem_plantao.TIPOS_QUADRO";

                $resultado = oci_parse($conn_ora, $consulta);               
            
                oci_execute($resultado);

                while($row = oci_fetch_array($resultado)){
                    echo '<option value='. $row['CD'] .'>'. $row['NM'] .'</option>';

                }

            ?>
        </select>
    </div>
    <div class="col-md-1">
        Cor:
        <select class="form-control" id="slct_cor" onchange="fnc_cor()">
            <option style="background-color: #fff !important; color: #000 !important" value="#fff"></option>
            <option style="background-color: #dae0fc !important;color: #dae0fc !important;" value="#dae0fc">Roxo</option>
            <option style="background-color: #dbedfb !important;color: #dbedfb !important;" value="#dbedfb">Azul-claro</option>
            <option style="background-color: #aae4ff !important;color: #aae4ff !important;" value="#aae4ff">Azul</option>
            <option style="background-color: #c5f0e6 !important;color: #c5f0e6 !important;" value="#c5f0e6">Verde</option>
            <option style="background-color: #fbf994 !important;color: #fbf994 !important;" value="#fbf994">Amarelo</option>
            <option style="background-color: #ffd92d !important;color: #ffd92d !important;" value="#ffd92d">Amarelo-escuro</option>
            <option style="background-color: #facde2 !important;color: #facde2 !important;" value="#facde2">Rosa</option>
            <option style="background-color: #ffd9ac !important;color: #ffd9ac !important;" value="#ffd9ac">Laranja</option>
            <option style="background-color: #f4a9a4 !important;color: #f4a9a4 !important;" value="#f4a9a4">Vermelho</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        Observação:
        <input type="text" id="inpt_observacao" class="form-control">
    </div>

    <div class="col-md-3">
        Dia:
        <input type="datetime-local" id="inpt_dia" class="form-control">
    </div>

    <div class="col-md-1">
        </br>
        <button type="button" class="btn btn-primary" onclick="ajax_tabela_t_h()"><i class="fa-solid fa-plus"></i></button>

    </div>
</div>

<script>

    

    function func_paciente(){

        var var_leito = document.getElementById('input_valor_leito').value

        if(var_leito != ''){
            $.ajax({
                url: "funcoes/quadros/ajax_paciente.php",
                type: "POST",
                data: {
                    leito: var_leito
                    },
                cache: false,
                success: function(dataResult){   
                    //alert(dataResult);
                    document.getElementById('inpt_paciente').value = dataResult;
                    document.getElementById('inpt_cd_paciente').value = dataResult;
                    
                },
                
            })
        }

    }

    function fnc_cor(){
        var var_cor = document.getElementById('slct_cor')

        var_cor.style.backgroundColor = var_cor.value
        if(var_cor.value == '#fff'){
            var_cor.style.color = '#000'
        }else{
            var_cor.style.color = '#fff'
        }

    }



</script>

