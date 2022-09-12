<div class="col-md-12">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button type="button" style="color: #fff; background-color: #3185c1;" onclick="tab_parecer('<?php echo @$var_atd ?>')" class="nav-link" >Parecer</button>

            <button type="button" style="color: #fff; background-color: #3185c1;" onclick="tab_exames('<?php echo @$var_atd ?>')" class="nav-link" >Exames</button>

            <button type="button" style="color: #fff; background-color: #3185c1;" onclick="tab_laboratorio('<?php echo @$var_atd ?>')" class="nav-link" >Laboratoriais</button>

            <button type="button" style="color: #fff; background-color: #3185c1;" onclick="tab_cirurgia('<?php echo @$var_atd ?>')" class="nav-link" >Cirurgias</button>
        </div>
    </nav>
</div>

<div class="col-md-12" id="div_tab">
</div>

<script>

    function tab_parecer(atend){

        $('#div_tab').load("configuracao/modal_passagem/ajax/aepc/ajax_parecer.php?atend="+ atend);

    }

    function tab_exames(atend){

        $('#div_tab').load("configuracao/modal_passagem/ajax/aepc/ajax_exames.php?atend="+ atend);

    }

    function tab_laboratorio(atend){

        $('#div_tab').load("configuracao/modal_passagem/ajax/aepc/ajax_laboratorio.php?atend="+ atend);

    }

    function tab_cirurgia(atend){

        $('#div_tab').load("configuracao/modal_passagem/ajax/aepc/ajax_cirurgia.php?atend="+ atend);

    }

</script>