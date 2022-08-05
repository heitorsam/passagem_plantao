

<div class='col-md-12' style='text-align:left'>

    <div id="div_tabela_obs"></div>

</div>


<script>

    $(document).ready(function() {
        $('#div_tabela_obs').load('funcoes/historico/modal_passagem/ajax/ajax_tabela_obs_especial.php?id='+ <?php echo $id ?>);
    });



</script>