<?php
/*======================================================================+
 File name   : conf_mod_stud
 Begin       : 2010-08-04
 Last Update : 2012-10-27

 Description : card associated

 Author: Sergio Capretta

 (c) Copyright:
               Sergio Capretta
             
               ITALY
               www.sinx.it
               info@sinx.it

Sinx for Association - Gestionale per Associazioni no-profit
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
=========================================================================+*/
session_start();
$user = $_SESSION['utente'];
if ($user == 'admin') {
  $limit='';
} else if ($user == 'limitato') {
  $limit='disabled';
} else if ($user == 'operatore') {
  $limit='disabled';
}
include('./top.inc');
include('./menu.inc');
$iniz = $_POST['iniziale'];

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

//Recupero l'ultimo id della tabella
$Query = "SELECT MAX(id_anagrafe) FROM tb_anagrafe";
$Qultimoid = mysql_query($Query);
while($Tultimoid = mysql_fetch_array($Qultimoid)){
$ultimoid= $Tultimoid['MAX(id_anagrafe)'];
}

?>
<h3><center>Scheda Associato</center></h3>
<!-- Stampa scheda associato -->
<center><h4>Stampa</h4></center>
<table align='center' border='0' width='40%'>
<tbody>
	<tr>
		<td><p><small>Stampa scheda associato</small></p></td>
	<td><form action='./stampa_scheda_ass.php' method='POST'>
		</td>		
		<td width='10'>ID*:</td>

<!-- Creo la combo -->
              <td><select name="associato" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id_anagrafe
	FROM tb_anagrafe
	WHERE id_anagrafe = $a
	ORDER BY id_anagrafe
	LIMIT 1";
 
$rs=mysql_query($query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysql_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
$a++;
} while ($a <= $ultimoid);
?>
  </select></td>

	<td><p colspan='2' align='center'>
		<input value='- Stampa -' type='submit' <? echo($limit); ?>></p>
	</td>
	</tr>
	</form>
</tbody>
</table>
<hr>
<?php
include('./modifica_cancella.inc');
$associato = $_POST['associato'];
$Query_nome = "SELECT * FROM tb_anagrafe WHERE id_anagrafe = $associato";

$rs=mysql_query($Query_nome)
or die("Errore nella query $Query_nome: " . mysql_error()); //die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysql_fetch_array($rs))
{
echo <<<EOM

<h3><center>$row[nome]</h3></center>
<table align='center' border='0' cellpadding='0' cellspacing='2' width='90%'>
	<tr><td><img src='./Immagini/Utenti/$row[immagine]' width="100px"><td height='40px' width='150'><small><b>id: </b>$row[id_anagrafe]</small></td></td></tr>
	<tr><td width='150'><small><b>Indirizzo </b></small></td><td width='150'><small>$row[indirizzo]</small></td></tr>
	<tr><td width='150'><small><b>Comune </b></small></td><td width='150'><small>$row[cap]</small></td></tr>
	<tr><td width='150'><small><b>Regione </b></small></td>	<td width='150'><small>$row[citta]</small></td></tr>
	<tr><td width='150'><small><b>Provincia </b></small></td>	<td width='150'><small>$row[provincia]</small></td></tr>
	<tr><td width='150'><small><b>Telefono </b></small></td>	<td width='150'><small>$row[tel]</small></td></tr>
	<tr><td width='150'><small><b>Telefono 2 </b></small></td>	<td width='150'><small>$row[tel2]</small></td></tr>
	<tr><td width='150'><small><b>e-mail </b></small></td>	<td width='150'><small>$row[email]</small></td></tr>
	<tr><td width='150'><small><b>Tipo Socio </b></small></td>	<td width='150'><small>$row[materia]</small></td></tr>
	<tr><td width='150'><small><b>Codice Fiscale </b></small></td>	<td width='150'><small>$row[nomerif]</small></td></tr>
	<tr><td width='150'><small><b>Data nascita </b></small></td>	<td width='150'><small>$row[datan]</small></td></tr>
	<tr><td width='150'><small><b>Funzione </b></small></td>	<td width='150'><small>$row[classe]</small></td></tr>
	<tr><td width='150'><small><b>Mansione </b></small></td>	<td width='150'><small>$row[mansione]</small></td></tr>
	<tr><td width='150'><small><b>note </b></small></td>	<td width='150'><small>$row[note]</small></td></tr>
	<tr><td width='150'><small><b>Socio attivo </b></small></td>	<td width='150'><small>$row[associato]</small></td></tr>

</table><hr>
EOM;

// popolo la tabella delle ricevute
$Query = "SELECT * FROM tb_ricevute WHERE nome = '$row[nome]'";
$rb=mysql_query($Query)
or die("Errore nella query $Query: " . mysql_error());
$nome = $row[nome];
while ($roow=mysql_fetch_array($rb))


echo <<<EOM
<b><center>Ricevuta emessa</b></center><br>
<table align='center' border='0' cellpadding='0' cellspacing='2' width='40%'>
	<tr><td height='25px' width= '20%' <small><b>num ricevuta</b></small></td><td height='25px' width='10%' align='center'><small>$roow[id_ric]</small></td></tr>
	<tr><td width='20%'><small><b>data</b></small></td>	<td height='25px' width='20%' align='center'><small>$roow[data]</small></td></tr>
	<tr><td width='20%'><small><b>euro</b></small></td>	<td height='25px' width='20%' align='right'><small>$roow[euro]</small></td></tr>
	<tr><td width='40%'><small><b>descr</b></small></td>	<td height='25px' width='40%' align='right'><small>$roow[descr]</small></td></tr>
</table><hr>


EOM;
}
?>
<!-- popolo la tabella delle fatture -->

<table align='center' border='0' cellpadding='0' cellspacing='0' width='80%'>

<?php

$Query = "SELECT * FROM tb_tot_fatture WHERE nome = '$nome'";

$rs=mysql_query($Query)
or die('' . mysql_error());

while ($roww=mysql_fetch_array($rs))
	{
echo <<<EOM
		<tr>
		<td colspan="3" align='center'>Fattura emessa</td>
		</tr>
		<tr>
		<td height='25px' width='20%' align='center'><small><b> Fatt.num: </b>$roww[id_tot_fatture]</small></td>
		<td height='25px' width='30%'><small>$roww[data]</small></td>
		<td height='25px' width='50%' align='right'><small><b>Tot Iva inclusa: </b>$roww[tot_fattura]</small></td>
		</tr>


EOM;
	}

echo <<<EOT
</table><p></p>
EOT;


mysql_close();
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i>Scorrendo in fondo, &egrave possibile visualizzare le ricevute emesse all'associato
<hr></i></small><?
include('./botton.inc');

?>