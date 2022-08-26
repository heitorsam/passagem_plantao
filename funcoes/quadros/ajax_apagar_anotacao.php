<?php 
    include '../../conexao.php';

    $cd = $_POST['cd'];

    $consulta = "DELETE passagem_plantao.QUADRO_ENF qe WHERE qe.CD_ANOTACAO = $cd";

    $result = oci_parse($conn_ora, $consulta);

    oci_execute($result);

?>