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
if ($user == 'admin') {
  $limit='';
} else if ($user == 'limitato') {
  $limit='disabled';
} else if ($user == 'operatore') {
  $limit='disabled';
}
include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");
?>

      <center><h3>Inserimento tipo associato</h3></center>
	<p align="center"><small><b>Cancella</b></small></p>
<!-- Cancellazione e Modifica voci db -->
<table align='center' border='0' width='40%'>
<tbody>
	<tr>
		<td><p><small>Inserisci il numero id da <b>cancellare</b> e premi cancella</small></p></td>
	<td><form action='./conf_canc.php?Tabella=tb_materia&Riferimento=id_materia' method='POST'>
		</td>		
		<td width='10'>id:</td>
		<td><input name='id_mod' size='10' type='text'></td>
	<td><p colspan='2' align='center'>
		<input value='- Cancella -' type='submit' <? echo($limit); ?>></p>
	</td>
	</tr>
</tbody>
</table>
</form>
<hr style="width: 80%; height: 2px;">
	<p align="center"><small><b>Modifica</b></small></p>
<p align="center"><small>Inserisci in numero id<br>Inserisci la <b>modifica</b> su Nuovo record e premi modifica</p></small>

<table align='center' border='0' width='50%'>
          <tbody>
	<td><form action='./conf_mod.php?Tabella=tb_materia&Voce=materia&Riferimento=id_materia' method='POST'></td>
            <tr>
              <td width='150'>Id:</td>
              <td><input name='id_mod' size='10' type='text'></td>
            </tr>
	<tr>
		<td width='150'>Nuovo record:</td>
		<td><input name='record' size='20' type='text'></td>
	<td><p colspan='2' align='center'>
	<input value=' Modifica ' type='submit' <? echo($limit); ?>></p></td>
	</tr>
</tbody>
</table>
</form>
<hr width="60%">
	<p align="center"><small><b>Nuovo</b></small></p>
<!-- Inserimento Voci db -->
<br>
      <form action='./conf_nmateria.php?Tabella=tb_materia&Colonna=materia' method='POST'>
        <table align='center' border='0' width='60%'>
          <tbody>
            <tr>
              <td width='150'>Nuovo Socio:</td>
              <td><input name='nrecord' size='30' type='text'></td>
            </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit' <? echo($limit); ?>></td>
            </tr>
          </tbody>
        </table>
      </form>
	<p align="center"><small><b>Elenco</b></small></p>
<center><h3>Tipi di soci nel database</h3></center>
<?php
// popolo la tabella visualizzazione elenco
$Query_nome = "SELECT * FROM tb_materia ORDER BY materia";

$rs=mysql_query($Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<br>
<table class='bordo' align='center' cellpadding='0' cellspacing='0' width='50%'>
	<tr>
	<td height='25px' width='125' align='center'><small><b>id_socio</b></small></td>
	<td width='125'><small><b>tipo socio</b></small></td>
	</tr>
	<tr><td></td></tr>

EOM;
}

while ($row=mysql_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td height='25px' width='125' align='center'><small>$row[id_materia]</small></td>
	<td height='25px' width='125'><small>$row[materia]</small></td>
	</tr>

EOM;
}

echo <<<EOT
</table>
EOT;
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i>Le tipologie degli associati sono gi&agrave impostate di default, ma puoi sempre aggiungerne o modificare quelle esistenti
<hr></i></small><?
include('./botton.inc');

?>