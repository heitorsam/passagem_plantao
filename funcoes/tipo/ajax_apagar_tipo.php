<?php 
    include '../../conexao.php';

    $cd = $_POST['cd'];

    $consulta_qtd = "SELECT COUNT(*) as qtd FROM passagem_plantao.quadro_enf qe where qe.tp_anotacao = '$cd'";

    $result_qtd = oci_parse($conn_ora, $consulta_qtd);

    oci_execute($result_qtd);

    $row_qtd = oci_fetch_array($result_qtd);

    $qtd = $row_qtd['QTD'];

    if($qtd == 0){

        $consulta = "DELETE passagem_plantao.TIPOS_QUADRO WHERE CD_TIPO = '$cd'";

        $result = oci_parse($conn_ora, $consulta);

        oci_execute($result);
        echo '1';
    }else{

        echo '0';

    }

?>