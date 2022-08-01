
<?php

include '../../conexao.php';

$id = $_GET['id'];
$var_atd =  $_GET['atd'];
$var_exibir_dt = $_GET['dt'];

?>



<div class='fnd_azul'><i class="fas fa-book-medical"></i> Informações</div>

                    <?php include '../../configuracao/modal_passagem/include_informacoes_gerais.php'; ?>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-laptop-medical"></i> Diagnostico</div>

                    <div class='row'>

                        <?php include '../../configuracao/modal_passagem/include_diagnostico.php'; ?>

                        <?php include '../../configuracao/modal_passagem/include_isolamento.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-allergies"></i> Alergias/Comorbidades</div>

                    <div class='row'>

                        <?php include '../../configuracao/modal_passagem/include_alergias.php'; ?>

                        <?php include '../../configuracao/modal_passagem/include_comorbidades.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-file-medical"></i> Ventilação</div>

                    <div class='row'>

                        <?php include '../../configuracao/modal_passagem/include_ventilacao.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-apple-alt"></i> Dieta/Jejum</div>

                    <div class='row'>

                        <?php include '../../configuracao/modal_passagem/include_dieta_jejum.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-plus"></i> Dispositivos</div>

                    <div class='row'>

                        <?php include '../../configuracao/modal_passagem/include_dispositivos.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-comment-medical"></i> Eliminações/Banho</div>

                    <div class='row'>

                        <?php include '../../configuracao/modal_passagem/include_eli_banho.php'; ?>

                    </div>


                    <br>

                    <div class='fnd_azul'><i class="fas fa-band-aid"></i> Curativos/Lesões/Drenos</div>

                    <div class='row'>

                        <?php include '../../configuracao/modal_passagem/include_cur_le_dre.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-user-md"></i> Avaliações/Exames Pendentes/Cirurgias</div>

                    <div class='row'>

                        <?php include '../../configuracao/modal_passagem/include_aepc.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-hand-holding-medical"></i> Protocolos Clínicos Abertos</div>

                    <div class='row'>

                        <?php include '../../configuracao/modal_passagem/include_protocolos_c.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-comment-alt"></i> Observações Especiais</div>

                    <div class='row'>

                        <?php include '../../configuracao/modal_passagem/include_obs_especiais.php'; ?>

                    </div>


                    <br>