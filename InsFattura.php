<?php
/*======================================================================+
 File name   : InsFattura.php
 Begin       : 2010-08-04
 Last Update : 2011-04-08

 Description : Compilation tax bills

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
$langinsfattura = $_SESSION['lingua'];
$paginainsfattura = "insfattura.inc";
$linguainsfattura = ($langinsfattura.$paginainsfattura);
include($linguainsfattura);

if ($user == 'admin') {
  $limit='';
} else if ($user == 'limitato') {
  $limit='disabled';
} else if ($user == 'operatore') {
  $limit='';
}

include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

//Recupero l'ultimo id della tabella
$Query = "SELECT MAX(id_tot_fatture) FROM tb_tot_fatture";
$Qultimoid = mysql_query($Query);
while($Tultimoid = mysql_fetch_array($Qultimoid)){
$ultimoid= $Tultimoid['MAX(tb_tot_fatture)'];
}

?>
<center><h3><? echo $Lptitolofattura; ?></h3></center>

<!-- Per Stampare le fatture -->

<p><center><b><? echo $Lstampa; ?></b></center></p>
      <form action='./stampa_fattura.php' method='POST'>
        <table align='center' border='0' width='45%'>
            <tr>
              <td width='80%'><font color="red"><? echo $Lnumerofattura; ?> *:</td>
              <td><select name="id" >
   <option value="" selected="selected"></option>

<?php



$a = '1';
do {
$query = "SELECT id_tot_fatture
	FROM tb_tot_fatture
	WHERE id_tot_fatture = $a
	ORDER BY tot_fattura DESC, id_tot_fatture
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
              <td colspan='2' align='center'>
              <input value='- Stampa Fattura -' type='submit' <? echo($limit); ?>></td>
            </tr>
	</table>
	</form>
<hr style="width: 90%; height: 2px;">

<!-- Registrare fatture in primanota-->

<p><center><b><? echo $Lregistrafattura; ?></b></center></p>
      <form action='./incasso_fattura.php' method='POST'>
        <table align='center' border='0' width='70%'>
            <tr>
              <td width='150'><font color="red"><? echo $Lvocecontoec; ?>*:</td>
		<td colspan='2'>
<p><center>
<select name="contoec" >
   <option value="" selected="selected"><? echo $Lcausale; ?></option>

<?php
$query = "SELECT descrizione FROM tb_conto_economico";
 
$rs=mysql_query($query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysql_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}

?>
</center></p><br><small><sub><i><? echo $Linscausale; ?></small></i></sub></td>
            </tr>
            <tr>
              <td><font color="red"><? echo $Lnumerofattura; ?> *:</td>
              <td ><select name="id" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id_tot_fatture
	FROM tb_tot_fatture
	WHERE id_tot_fatture = $a
	ORDER BY tot_fattura DESC, id_tot_fatture
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
<td>
 <fieldset>
  <legend><small><? echo $Lincassoin; ?>:</small></legend>
  <small><? echo $Lcassa; ?></small><input type="radio" name="incasso" value="cassa" checked="checked"/>
  <small><? echo $Lbanca; ?></small><input type="radio" name="incasso" value="banca"/>
</fieldset>
	</td>
              <td colspan='2' align='center'>
              <input value='- Registra incasso -' type='submit' <? echo($limit); ?>></td>
            </tr>
	</table>
	</form>
<hr style="width: 80%; height: 2px;">

<!-- Compilazione nuova fattura o aggiunta record fattura -->
     <p align="center"><b><? echo $Lcompfattura; ?></b></p>
<center><small><? echo $Lnota1; ?></small></center>
<br>
      <form action='./conf_dati_fattura.php' method='POST'>
        <table align='left' border='0' width='30%'>
            <tr>
              <td width='80%'><? echo $Lnumerofattura; ?>:</td>
              <td><input name='fattnum' size='10%' type='text' value=<? echo($ultimoid+1); ?>></td>
            </tr>
            <tr>
              <td width='80%'><font color="red"><? echo $Lnomecliente; ?> *:</td>
              <td><select name="nome" >
   <option value="" selected="selected"></option>

<?php
$query = "SELECT nome FROM tb_anagrafe ORDER BY nome";
 
$rs=mysql_query($query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysql_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
?>
  </select></td>
            </tr>
            <tr>
              <td width='150'><? echo $Ldata; ?>:</td>
              <td width='50'><small><input name='data' size='10' type='text' value=<?php echo date('d-m-Y') ?>></small><td>
            </tr>
        </table>
<br><br><br><br><br>
<table align='center' border='0' width='80%'>
<tbody>
	<tr>
	 <td height='25px' width='50%'><small><? echo $Ldescrizione; ?></small></td>
	 <td height='25px' width='10%'><small><? echo $Lquantita; ?></small></td>
	 <td height='25px' width='30%'><small><? echo $Lprezzoun; ?>.</small></td>
	 <td height='25px' width='10%'><small><? echo $Liva; ?></small></td>
	</tr>
</table>
<table align='center' border='0' width='70%'>
	<tr>
	      <td><input name='Descr' size='42%'  type='text'></td>
              <td><input name='Qta' size='5%' type='text'></td>
              <td><input name='prezzoun' size='22%' type='text'></td>
              <td><input name='iva' size='8%' type='text'></td>
	</tr>
</table>
<p><center><small><? echo $Lnota2; ?></small></center></p>

        <table align='center' border='0' width='30%'>
            <tr>
              <td colspan='2' align='center'>
              <input value='- Registra Fattura -' type='submit' <? echo($limit); ?>></td>
            </tr>
      </tbody>
	</table>
    </form>

<!-- Per Visualizzare e modificare le fatture -->
<hr style="width: 60%; height: 2px;">
<p><center><b><? echo $Lvisualizzafatt; ?></b></center></p>
      <form action='./visual_fattura.php' method='POST'>
        <table align='center' border='0' width='45%'>
            <tr>
              <td width='80%'><font color="red"><? echo $Lnumerofattura; ?> *:</td>
              <td><select name="id" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id_tot_fatture
	FROM tb_tot_fatture
	WHERE id_tot_fatture = $a
	ORDER BY tot_fattura DESC, id_tot_fatture
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
              <td colspan='2' align='center'>
              <input value='- Visualizza Fattura -' type='submit'></td>
            </tr>
	</table>
	</form>
<p><center><small><? echo $Lnota3; ?></small></center></p>
<hr style="width: 40%; height: 2px;">

<!-- popolo la tabella delle fatture -->
	<p align="center"><small><b><? echo $Lelencofatture; ?></b></small></p>
<table class='bordo' align='center' cellpadding='0' cellspacing='0' width='60%'>
	<tr>
	<td height='25px' width='15%' align='center'><small><b><? echo $Lnumerofattura; ?></b></small></td>
	<td width='20%'><small><b><? echo $Ldata; ?></b></small></td>
	<td width='30%'><small><b><? echo $Lnomecliente; ?></b></small></td>
	<td width='35%' align='right'><small><b><? echo $Ltotivaincl; ?></b></small></td>
	</tr>
<?php

$a = '1';
do {
$Query = "SELECT id_tot_fatture, tot_fattura, nome, data
	FROM tb_tot_fatture
	WHERE id_tot_fatture = $a
	ORDER BY tot_fattura DESC, id_tot_fatture
	LIMIT 1";

$rs=mysql_query($Query)
or die('' . mysql_error());

while ($row=mysql_fetch_array($rs))
	{
echo <<<EOM
		<tr>
		<td height='25px' align='center'><small>$row[id_tot_fatture]</small></td>
		<td height='25px'><small>$row[data]</small></td>
		<td height='25px'><small>$row[nome]</small></td>
		<td height='25px' align='right'><small>$row[tot_fattura]</small></td>
		</tr>


EOM;
	}
$a++;
} while ($a <= $numero);
echo <<<EOT
</table><p></p>
EOT;
mysql_close();
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><? echo $Lhelpfatture; ?>
<hr></i></small><?
include('./botton.inc');

?>