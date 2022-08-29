<?php 

    include '../../conexao.php';

    session_start();

    $usuario = $_SESSION['usuarioLogin'];

    $nome = $_POST['nome'];

    $sigla = $_POST['sigla'];

    $consulta_qtd = "SELECT COUNT(*) as qtd FROM passagem_plantao.tipos_quadro tp where tp.cd_tipo = '$sigla'";

    $result_qtd = oci_parse($conn_ora, $consulta_qtd);

    oci_execute($result_qtd);

    $row_qtd = oci_fetch_array($result_qtd);

    $qtd = $row_qtd['QTD'];

    if($qtd == 0){

        $consulta = "INSERT INTO passagem_plantao.tipos_quadro (cd_tipo, nm_tipo, CD_USUARIO_CADASTRO, HR_CADASTRO, CD_USUARIO_ULT_ALT, HR_ULT_ALT)
                        (SELECT UPPER('$sigla')  AS cd_tipo,
                        '$nome'AS nm_tipo,
                        '$usuario' AS CD_USUARIO_CADASTRO,
                        SYSDATE AS HR_CADASTRO,
                        NULL AS CD_USUARIO_ULT_ALT,
                        NULL AS HR_ULT_ALT FROM DUAL)";

        $result = oci_parse($conn_ora, $consulta);
        oci_execute($result);

        echo '1';
    }else{
        echo '0';
    }
?>