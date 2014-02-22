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
$langcontoec = $_SESSION['lingua'];
$paginacontoec = "inscontoec.inc";
$linguacontoec = ($langcontoec.$paginacontoec);
include($linguacontoec);

if ($user == 'admin') {

include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

//Recupero l'ultimo id della tabella
$Query = "SELECT MAX(id) FROM tb_conto_economico";
$Qultimoid = mysql_query($Query);
while($Tultimoid = mysql_fetch_array($Qultimoid)){
$ultimoid= $Tultimoid['MAX(id)'];
}
?>
     <center><h3><? echo $Ltitolocontoec; ?></h3></center>
<center><small><? echo $Lnota1; ?></small><center><br>
<small><center><a href="./stampa_contoec.php"><? echo $Lstampacontoec; ?></a> | <a href="./Azzera.php?Tabella=tb_conto_economico&Modulo=Conto Economico"><? echo $Lazzeracontoec; ?></a></center></small>
	<p align="center"><small><b><? echo $Lcancella; ?></b></small></p>
<!-- Sezione per cancellare un record del conto economico -->
<table align='center' border='0' width='40%'>
<tbody>
	<tr>
		<td><p><small><? echo $Lnota2; ?></small></p></td>
	<td><form action='./conf_canc.php?Tabella=tb_conto_economico&Riferimento=id' method='POST'>
		</td>		
		<td width='10'><font color="red"><? echo $Lnumero; ?>*:</td>

<!-- Creo la combo -->
              <td><select name="id_mod" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id
	FROM tb_conto_economico
	WHERE id = $a
	ORDER BY id
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
		<input value='- Cancella -' type='submit' <? echo($limit); ?>></p>
	</td>

	</tr>
	</form>
</tbody>
</table>
<hr style="width: 80%; height: 2px;">
	<p align="center"><small><b><? echo $Lmodifica; ?></b></small></p>
<!-- Sezione per modificare un record del conto economico -->
<p align="center"><small><? echo $Lnota3; ?></p></small>

<table align='center' border='0' width='50%'>
          <tbody>
	<td><form action='./conf_mod_ceconomico.php?Tabella=tb_conto_economico' method='POST'></td>
            <tr>
		</td>		
		<td width='10'><font color="red"><? echo $Lnumero; ?>*:</td>

<!-- Creo la combo -->
              <td><select name="id_mod" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id
	FROM tb_conto_economico
	WHERE id = $a
	ORDER BY id
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
            </tr>
            <tr>
		<td width='150'><font color="red"><? echo $Lcampo; ?>*:</td>
		<td>
<select name="campo" >
	<option value="" selected="selected"></option>
  <option value="descrizione"><? echo $Ldescrizione; ?></option>
  <option value="valore"><? echo $Lvalore; ?></option>
</td>
	</tr>
	<tr>
		<td width='150'><font color="red"><? echo $Lnuovorecord; ?>*:</td>
		<td><input name='record' size='20' type='text'></td>
	<td><p colspan='2' align='center'>
	<input value=' Modifica ' type='submit' <? echo($limit); ?>></p></td>
	</tr>
	</form>
</tbody>
</table>

<hr style="width: 60%; height: 2px;">
	<p align="center"><small><b><? echo $Lnuovavocecontoec; ?></b></small></p>
<!-- Sezione per inserire una nuova voce del conto economico -->

      <form action='./conf_dati_contoec.php' method='POST'>
        <table align='center' border='0' width='60%'>
          <tbody>
            <tr>
              <td width='150'><font color="red"><? echo $Loperazione; ?>*:</td>
		<td><input name='operazione' size='30 type='text' ><br><small><sub><i><? echo $Linscausale; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><font color="red"><? echo $Lvalore; ?>*:</td>
		<td><input name='valore' size='30 type='text'><br><small><sub><i><? echo $Lnota4; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><? echo $Ltipovoce; ?>:</td>
              <td>
	      <fieldset>
	      <legend><small><? echo $Ltipovoce; ?>:</small></legend>
  <small><? echo $Lproventiric; ?></small><input type="radio" name="contoec" value="ricavi" checked="checked"/>
  <small><? echo $Lcostioneri; ?></small><input type="radio" name="contoec" value="oneri"/>
	      </fieldset>
	    </td>
            </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit' <? echo($limit); ?>></td>
            </tr>
          </tbody>
        </table>
      </form>
     <center><h3><? echo $Ltitolocontoec; ?></h3></center>
<?php
// popolo la tabella della conto economico


{
echo <<<EOM

<table width='90%' border='0'>
	<tr>
	<td height='35px' align='center' width='50%' bgcolor="#D1D1D1"><small><b>$Lproventiric</b></small></td>
	<td height='35px' align='center' width='50%' bgcolor="#D1D1D1"><small><b>$Lcostioneri</b></small></td>
	</tr>
</table>
<table align='center' border='0' cellpadding='0' cellspacing='0' width='90%' >
	<tr>
	<td height='25px' width='5%' align='center'><small><b>$Lid</b></small></td>
	<td height='25px' width='35%'><small><b>$Ldescrizione</b></small></td>
	<td height='25px' width='10%'><small><b>$Limporto</b></small></td>
	<td height='25px' width='5%' align='center'><small><b>$Lid</b></small></td>
	<td height='25px' width='35%'><small><b>$Ldescrizione</b></small></td>
	<td height='25px' width='10%'><small><b>$Limporto</b></small></td>
	</tr>
</table>
EOM;
}
?>

<!-- Creo la tabella costi/ricavo -->
<table align='center' border='0' cellpadding='0' cellspacing='0' width='90%' >
<tr>
  <td width="50%">
    <?php
$Query_nome = "SELECT * FROM tb_conto_economico WHERE costoricavo = 'ricavi' ORDER BY id";

$rs=mysql_query($Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
while ($row=mysql_fetch_array($rs))
{
echo <<<EOM

<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr >
	<td height='25px' width='5%' align='center'><small>$row[id]</small></td>
	<td height='25px' width='35%'><small>$row[descrizione]</small></td>
	<td height='25px' width='10%'><small>$row[valore]</small></td>
	</tr>
</table>
EOM;
}
      ?>
    </td>
    <td width="50%">
<?php

 $Query = "SELECT * FROM tb_conto_economico WHERE costoricavo = 'oneri' ORDER BY id";

$ros=mysql_query($Query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($riga=mysql_fetch_array($ros))
{
echo <<<EOM
<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr >
	<td height='25px' width='5%' align='center'><small>$riga[id]</small></td>
	<td height='25px' width='35%'><small>$riga[descrizione]</small></td>
	<td height='25px' width='10%'><small>$riga[valore]</small></td>
	</tr>
</table>
EOM;
}

?>
    </td>
  </tr>
</table>

<?php
//Calcolo delle somme
$query = "SELECT SUM(valore) FROM tb_conto_economico where costoricavo = 'ricavi'";
$result = mysql_query($query);
$entrata = mysql_fetch_row($result);

$query = "SELECT SUM(valore) FROM tb_conto_economico where costoricavo = 'oneri'";
$result = mysql_query($query);
$uscita = mysql_fetch_row($result);
?>
<hr style="width: 20%; height: 2px; position: center;"><br>
<table width='100%' border='0'>
<tr>
	<td height='30px' width='20%'><small><? echo $Ltotproventi; ?></small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $entrata[0]; ?> &euro;</small></td>
	<td width='20%'></td>
	<td height='30px' width='20%'><small><? echo $Ltotspese; ?></small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $uscita[0]; ?> &euro;</small></td>
</tr>
<tr>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'><small><b><? echo $Lavanzogestione; ?></b></small></td>
	<td height='30px' align='right' width='20%'><small><b><?php echo ($entrata[0]-$uscita[0]); ?> &euro;</b></small></td>
</tr>
<tr>
	<td height='30px' width='20%'><small><? echo $Ltotpareggio; ?></small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $entrata[0]; ?> &euro;</small></td>
	<td width='20%'></td>
	<td height='30px' width='20%'><small><? echo $Ltotpareggio; ?></small></td>
	<td height='30px' align='right' width='20%'><small><?php echo (($entrata[0]-$uscita[0])+$uscita[0]); ?> &euro;</small></td>
</table><br>


<?php
mysql_close();
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><? echo $Lhelpcontoec; ?>
<hr></i></small><?
include('./botton.inc');
} else {
header('Location: Rip_database.php');
}
?>
