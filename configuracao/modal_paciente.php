    <?php

        $id = $row_exibir_pac['CD_PACIENTE'];
        $var_atd =  $row_exibir_pac['CD_ATENDIMENTO'];

    ?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_pac<?php echo $id; ?>">
<i class="fa-solid fa-eye"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modal_pac<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-calendar-alt"></i> Passagem Plantão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style='margin: 0 auto !important;'>

                <div class='fnd_azul'><i class="fas fa-book-medical"></i> Informações</div>

                <form method='POST' action='configuracao/consulta_pac.php'>

                    <?php include 'modal_passagem/include_informacoes_gerais.php'; ?>
                    
                    <br>

                    <div class='fnd_azul'><i class="fas fa-laptop-medical"></i> Diagnostico</div>

                    <div class='row'>

                       <?php include 'modal_passagem/include_diagnostico.php'; ?>

                       <?php include 'modal_passagem/include_isolamento.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-allergies"></i> Alergias/Comorbidades</div>

                    <div class='row'>

                        <?php include 'modal_passagem/include_alergias.php'; ?>

                        <?php include 'modal_passagem/include_comorbidades.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-file-medical"></i> Ventilação</div>

                    <div class='row'>

                        <?php include 'modal_passagem/include_ventilacao.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-apple-alt"></i> Dieta/Jejum</div>

                    <div class='row'>

                        <?php include 'modal_passagem/include_dieta_jejum.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-plus"></i> Dispositivos</div>

                    <div class='row'>

                        <?php include 'modal_passagem/include_dispositivos.php'; ?>

                    </div>

                    <br>

                    <div class='fnd_azul'><i class="fas fa-comment-medical"></i> Eliminações/Banho</div>

                    <div class='row'>

                        <?php include 'modal_passagem/include_eli_banho.php'; ?>

                    </div>


                    <br>

                    <div class='fnd_azul'><i class="fas fa-band-aid"></i> Curativos/Lesões/Drenos</div>

                    <div class='row'>

                        <?php include 'modal_passagem/include_cur_le_dre.php'; ?>

                    </div>

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

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Fechar</button>
                    </div>
            
    
                </form>


            </div>
        </div>
    </div>
</div>