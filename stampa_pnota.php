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
if ($user) {

include('./Intestazione.php');

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

?>
     <p align="center"><b>Registro prima nota semplice</b></p><br>

<?php
// popolo la tabella della primanota
$Query_nome = "SELECT * FROM tb_primanota ORDER BY data_registr";

$rs=mysql_query($Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<table style="position: absolute; right: 70px;" width='38%' border='0' bgcolor="#D1D1D1">
	<tr>
	<td height='35px' align='center' width='200'><small><b>Cassa</b></small></td>
	<td height='35px' align='center' width='200'><small><b>Banca</b></small></td>
	</tr>
</table>
<br><br>
<table align='center' border='0' cellpadding='0' cellspacing='0' width='90%' bgcolor="#D1D1D1">
	<tr>
	<td width='125'><small><b>data_registr</b></small></td>
	<td width='150'><small><b>descrizione</b></small></td>
	<td width='100' align='right'><small><b>entrata</b></small></td>
	<td width='100' align='right'><small><b>uscita</b></small></td>
	<td width='100' align='right'><small><b>entratab</b></small></td>
	<td width='100' align='right'><small><b>uscitab</b></small></td>
	</tr>
	<tr><td></td></tr>
</table>
EOM;
}

while ($row=mysql_fetch_array($rs))
{
echo <<<EOM
<table align='center' border='0' cellpadding='0' cellspacing='0' width='90%'>
	<tr>
	<td height='15px' width='125'><small>$row[data_registr]</small></td>
	<td height='15px' width='150'><small>$row[descrizione]</small></td>
	<td height='15px' width='100' align='right'><small>$row[entrata]</small></td>
	<td height='15px' width='100' align='right'><small>$row[uscita]</small></td>
	<td height='15px' width='100' align='right'><small>$row[entratab]</small></td>
	<td height='15px' width='100' align='right'><small>$row[uscitab]</small></td>
	</tr>
</table>

EOM;
}

//Calcolo delle somme di Cassa
$query = "SELECT SUM(entrata) FROM tb_primanota";
$result = mysql_query($query);
$entrata_tot = mysql_fetch_row($result);
?>

<table border='0' cellpadding='0' cellspacing='0' width='95%'>
<tr>
<td width='80%'></td>
	<td height='30px' width='10%'><small>Entrata Cassa</small></td>
	<td height='30px' align='right' width='10%'><small><?php echo $entrata_tot[0]; ?></small></td>
</tr>
<?php
$query = "SELECT SUM(uscita) FROM tb_primanota";
$result = mysql_query($query);
$uscita_tot = mysql_fetch_row($result);
?>
<tr>
<td width='80%'></td>
	<td height='30px' width='10%'><small>Uscite Cassa</small></td>
	<td height='30px' align='right' width='10%'><small><?php echo $uscita_tot[0]; ?></small></td>
</tr>
<tr>
<td width='80%'></td>
	<td height='30px' width='10%'><small><b>Guad/Perdita</b></small></td>
	<td height='30px' align='right' width='10%'><small><b><?php echo ($entrata_tot[0]-$uscita_tot[0]); ?></b></small></td>
</tr></table><br>

<?php
//Calcolo delle somme di Banca
$query = "SELECT SUM(entratab) FROM tb_primanota";
$result = mysql_query($query);
$entratab_tot = mysql_fetch_row($result);
?>

<table border='0' cellpadding='0' cellspacing='0' width='95%'>
<tr>
<td width='80%'></td>
<hr style="width: 20%; height: 2px; position: absolute; right: 60px"><br>
	<td height='30px' width='10%'><small>Entrata Banca</small></td>
	<td height='30px' align='right' width='150'><small><?php echo $entratab_tot[0]; ?></small></td>
</tr>
<?php
$query = "SELECT SUM(uscitab) FROM tb_primanota";
$result = mysql_query($query);
$uscitab_tot = mysql_fetch_row($result);
?>
<tr>
<td width='80%'></td>
	<td height='30px' width='150'><small>Uscite Banca</small></td>
	<td height='30px' align='right' width='150'><small><?php echo $uscitab_tot[0]; ?></small></td>
</tr>
<tr>
<td width='80%'></td>
	<td height='30px' width='150'><small><b>Guad/Perdita</b></small></td>
	<td height='30px' align='right' width='150'><small><b><?php echo ($entratab_tot[0]-$uscitab_tot[0]); ?></b></small></td>
</tr><br>
<?php
mysql_close();

} else {
header('Location: ./index.php');
}
?>



