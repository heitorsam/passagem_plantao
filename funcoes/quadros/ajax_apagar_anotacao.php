<?php 
    include '../../conexao.php';

    $cd = $_POST['cd'];

    $consulta_delete = "DELETE passagem_plantao.QUADRO_ENF qe WHERE qe.CD_ANOTACAO = $cd";

    $result_delete = oci_parse($conn_ora, $consulta_delete);

    oci_execute($result_delete);

?>