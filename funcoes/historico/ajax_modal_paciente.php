
<?php

include '../../conexao.php';

session_start();

$id = $_GET['id'];
$var_atd =  $_GET['atd'];
$var_exibir_dt = $_GET['dt'];

$var_tipo_data = $_GET['tp'];

$_SESSION['data'] = $var_exibir_dt;

?>



<div class='fnd_azul'><i class="fas fa-book-medical"></i> Informações</div>

                    <?php include 'modal_passagem/include_informacoes_gerais.php'; ?>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-laptop-medical"></i> Diagnostico</div>

                    <div class='row'>

                        <?php include 'modal_passagem/include_diagnostico.php'; ?>

                        <?php include 'modal_passagem/include_isolamento.php'; ?>

                    </div>

                    <br>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-user-md"></i> Avaliações/Exames Pendentes/Cirurgias</div>

                    <div class='row'>

                        <?php include 'modal_passagem/include_aepc.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-hand-holding-medical"></i> Protocolos Clínicos Abertos</div>

                    <div class='row'>

                        <?php include 'modal_passagem/include_protocolos_c.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-comment-alt"></i> Observações Especiais</div>

                    <div class='row'>

                        <?php include 'modal_passagem/include_obs_especiais.php'; ?>

                    </div>


                    <br>