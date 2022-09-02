<div class="col-md-12">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button type="button" style="color: #fff; background-color: #3185c1;" onclick="tabs('par', '<?php echo @$var_atd ?>')" class="nav-link" >Parecer</button>

            <button type="button" style="color: #fff; background-color: #3185c1;" onclick="tabs('exa', '<?php echo @$var_atd ?>')" class="nav-link" >Exames</button>

            <button type="button" style="color: #fff; background-color: #3185c1;" onclick="tabs('lab', '<?php echo @$var_atd ?>')" class="nav-link" >Laboratoriais</button>

            <button type="button" style="color: #fff; background-color: #3185c1;" onclick="tabs('cir', '<?php echo @$var_atd ?>')" class="nav-link" >Cirurgias</button>
        </div>
    </nav>
</div>

<div class="col-md-12" id="div_tab">
</div>

<script>

    function tabs(tipo, atend){

        $('#div_tab').load("configuracao/modal_passagem/ajax/ajax_aepc.php?tipo="+ tipo +"&atend="+ atend);

    }

</script>