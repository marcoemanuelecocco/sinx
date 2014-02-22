<html>
<head>
<!--Sinx for Association - Gestionale per Associazioni no-profit
    Copyright (C) 2011 by Sergio Capretta

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->
<?php

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

$Query_nome = "SELECT * FROM tb_anagrafe_associaz";

$rs=mysql_query($Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$row=mysql_fetch_array($rs);
?>

  <title><? echo $row[nome]; ?></title>
 <link rel="stylesheet"
	href="print.css"
	type="text/css"
	media="screen" />
</head>
<body>
<table border="0">
	<tr>
	<td align="center"><img src="./Immagini/logo.png" height="60px"></td>
	<td align="center"><small>Associazione<br><b><? echo $row[nome]; ?></b></small></td>
	</tr>
	<tr>
	<td></td>
	<td align="center"><small> Via <? echo $row[indirizzo]; ?>, <? echo $row[numero]; ?> - <? echo $row[cap]; ?> - <? echo $row[citta]; ?>, <? echo $row[provincia]; ?> <br>tel: <? echo $row[tel]; ?> - fax <? echo $row[fax]; ?><br>CF e PI <? echo $row[cf]; ?></small></td>
	</tr>
</table>
<hr><br><br>
<? mysql_close(); ?>
</body>
</html>
