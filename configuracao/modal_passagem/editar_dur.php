

<!-- Button trigger modal -->


<div class="modal fade" id="id_editar_dur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Durante o Plantão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="div_editar"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Fechar</button>
                    <button onclick="ajax_editar_dur()" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button> 

                </div>
            </div>
        </div>
    </div>
</div>

