<?php

//////////
//ORACLE//
//////////

//TREINAMENTO
//$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST =192.168.90.231)(PORT = 1521))
//(CONNECT_DATA = (SID = trnmv)))";

//Criar a conexao ORACLE
//if(!@($conn_ora = oci_connect('escala_medica','pepita_sjc_23062022_ouro_08_12',$dbstr1,'AL32UTF8'))){
//	echo "Conexão falhou!";	
//} else { 
	//echo "Conexão OK!";	
//}

//PRODUCAO

$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST =10.200.0.211)(PORT = 1521))
(CONNECT_DATA = (SERVICE_NAME = prdmv)))";

//Criar a conexao ORACLE
if(!@($conn_ora = oci_connect('escala_medica','pepita_sjc_23062022_ouro_08_12',$dbstr1,'AL32UTF8'))){
	echo "Conexão falhou!";	
} else { 
	//echo "Conexão OK!";	
}
