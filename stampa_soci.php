<?php
/*Sinx for Association - Gestionale per Associazioni no-profit
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
*/
session_start();
$user = $_SESSION['utente'];
$langstampasoci = $_SESSION['lingua'];
$paginastampasoci = "stampasoci.inc";
$linguastampasoci = ($langstampasoci.$paginastampasoci);
include($linguastampasoci);

if ($user) {

include('./Intestazione.php');

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

?>
     <center><h2><? echo $Ltitolosoci; ?></h2></center>

<?php
$classe = $_POST['classi'];
$Query_nome = "SELECT * FROM tb_anagrafe WHERE tipologia != 'Extra' AND associato = 'si' ORDER BY nome";

$rs=mysql_query($Query_nome)
or die("Errore nella query $query: " . mysql_error()); //die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<table align='center' border='0' cellpadding='0' cellspacing='2' width='90%'>
	<tr>
	<td width='150'><small><b>$Lnome</b></small></td>
	<td width='150'><small><b>$Lindirizzo</b></small></td>
	<td width='150'><small><b>$Lcitta</b></small></td>
	<td width='150'><small><b>$Lprovincia</b></small></td>
	<td width='150'><small><b>$Lcodfisc</b></small></td>
	<td width='150'><small><b>$Ltipo</b></small></td>
	<td width='150'><small><b>$Lfunzione</b></small></td>
	</tr>
	<tr><td></td></tr>
EOM;
}

while ($row=mysql_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td width='150'><small>$row[nome]</small></td>
	<td width='150'><small>$row[indirizzo]</small></td>
	<td width='150'><small>$row[cap] $row[citta]</small></td>
	<td width='150'><small>$row[provincia]</small></td>
	<td width='150'><small>$row[nomerif]</small></td>
	<td width='150'><small>$row[materia]</small></td>
	<td width='150'><small>$row[classe]</small></td>
	</tr>

EOM;
}

echo <<<EOT
</table>
EOT;

mysql_close();

} else {
header('Location: ./index.php');
}
?>



