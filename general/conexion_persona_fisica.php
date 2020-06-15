<?php
function conectarFisica()
{
	mysql_connect("200.52.83.41", "archysof_dvlp", "archysoft");
	mysql_select_db("archysoft_com_mx_dvlp");


}

function desconectarFisica()
{
	mysql_close();
}
?>
