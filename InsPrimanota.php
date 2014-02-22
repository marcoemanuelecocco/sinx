<?php
/*======================================================================+
 File name   : InsPrimanota.php
 Begin       : 2010-08-04
 Last Update : 2011-04-08

 Description : Insert, modify, and delete data management first note

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
$langinsprimanota = $_SESSION['lingua'];
$paginainsprimanota = "insprimanota.inc";
$linguainsprimanota = ($langinsprimanota.$paginainsprimanota);
include($linguainsprimanota);

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
$Query = "SELECT MAX(id_primanota) FROM tb_primanota";
$Qultimoid = mysql_query($Query);
while($Tultimoid = mysql_fetch_array($Qultimoid)){
$ultimoid= $Tultimoid['MAX(id_primanota)'];
}

?>
     <center><h3><? echo $Ltitoloprimanota; ?></h3></center>
<center><small><? echo $Lnota; ?></small><center><br>
<small><center><a href="./stampa_pnota.php"><? echo $Lstampa; ?></a> | <a href="./Azzera.php?Tabella=tb_primanota&Modulo=Prima Nota"><? echo $Lazzera; ?></a></center></small>
	<p align="center"><small><b><? echo $Lcancella; ?></b></small></p>
<!-- Sezione per cancellare un record di prima nota -->
<table align='center' border='0' width='40%'>
<tbody>
	<tr>
		<td><p><small><? echo $Linserisciid; ?></small></p></td>
	<td><form action='./conf_canc.php?Tabella=tb_primanota&Riferimento=id_primanota' method='POST'>
		</td>		
		<td width='10'><font color="red">id*:</td>
		<td><select name="id_mod" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id_primanota
	FROM tb_primanota
	WHERE id_primanota = $a
	ORDER BY id_primanota
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
<!-- Sezione per modificare un record di prima nota -->
<p align="center"><small><? echo $Linserisciidmodifica; ?></p></small>

<table align='center' border='0' width='50%'>
          <tbody>
	<td><form action='./conf_mod_pnota.php' method='POST'></td>
            <tr>
              <td width='150'><font color="red"><? echo $Lnumero; ?>*:</td>
<!-- Creo la combo -->
              <td><select name="id_mod" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id_primanota
	FROM tb_primanota
	WHERE id_primanota = $a
	ORDER BY id_primanota
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
<!--              <td><input name='id_mod' size='10' type='text'></td> -->
            </tr>
            <tr>
		<td width='150'><font color="red"><? echo $Lcampo; ?>*:</td>
		<td>
<select name="campo" >
	<option value="" selected="selected"></option>
  <option value="data_registr"><? echo $Ldata; ?></option>
  <option value="descrizione"><? echo $Ldescrizione; ?></option>
  <option value="entrata"><? echo $Lentratacassa; ?></option>
  <option value="uscita"><? echo $Luscitacassa; ?></option>
  <option value="entratab"><? echo $Lentratabanca; ?></option>
  <option value="uscitab"><? echo $Luscitacassa; ?></option>
</td>
<!--		<td><input name='campo' size='20' type='text'></td> -->
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
	<p align="center"><small><b><? echo $Lnuovomovimento; ?></b></small></p>
      <form action='./conf_dati_pnota.php' method='POST'>

<!-- Sezione per inserire una nuova voce di primanota -->
        <table align='center' border='0' width='60%'>
          <tbody>
            <tr>
              <td width='150'><? echo $Ldata; ?>:</td>
	      <td width='50'><input name='data' size='10' type='text' value=<?php echo date('d-m-Y') ?>><br></td>
            </tr>
            <tr>
              <td width='150'><font color="red"><? echo $Lvocecontoec; ?></td>
		<td>
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
</center></p><br><small><sub><i><? echo $Linserirecausale; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><font color="red"><? echo $Loperazione; ?></td>
		<td><input name='operazione' size='30' type='text'><br><small><sub><i><? echo $Linserirecausale; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><? echo $Limporto; ?></td>
              <td><input name='valore' size='30' type='text'><br><small><sub><i><? echo $Lsuggdecimali; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><? echo $Ltipodivoce; ?></td>
              <td>
	      <fieldset>
	      <legend><small><i><? echo $Ltipomovimento; ?></i></small></legend>
  <small><b><i><? echo $Lcassa; ?></i></b></small><br>
  <input type="radio" name="conto" value="entrata" checked="checked"/><small><? echo $Lentrata; ?> -</small>
  <input type="radio" name="conto" value="uscita"/><small><? echo $Luscita; ?></small><br><br>
  <small><b><i><? echo $Lbanca; ?></i></b></small><br>
  <input type="radio" name="conto" value="entratab" /><small><? echo $Lentrata; ?> -</small>
  <input type="radio" name="conto" value="uscitab"/><small><? echo $Luscita; ?></small>
	      </fieldset>
	    </td>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit' <? echo($limit); ?>></td>
            </tr>
          </tbody>
        </table>
      </form>
	<center><h3><? echo $Lprimanota; ?></h3></center>
<?php
// popolo la tabella della primanota
$Query_nome = "SELECT * FROM tb_primanota ORDER BY id_primanota";

$rs=mysql_query($Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<table width='95%' border='0'>
	<tr>
	<td width='64%'></td>
	<td height='35px' align='center' width='18%' bgcolor="#D1D1D1"><small><b>$Lcassa</b></small></td>
	<td height='35px' align='center' width='18%' bgcolor="#D1D1D1"><small><b>$Lbanca</b></small></td>
	</tr>
</table>
<table align='center' border='0' cellpadding='0' cellspacing='0' width='95%' bgcolor="#D1D1D1">
	<tr>
	<td height='25px' width='10%' align='center'><small><b>$Lnumero</b></small></td>
	<td width='15%'><small><b>$Ldata</b></small></td>
	<td width='35%'><small><b>$Ldescrizione</b></small></td>
	<td width='10%' align='right'><small><b>$Lentrata</b></small></td>
	<td width='10%' align='right'><small><b>$Luscita</b></small></td>
	<td width='10%' align='right'><small><b>$Lentrata</b></small></td>
	<td width='10%' align='right'><small><b>$Luscita </b></small></td>
	</tr>
	<tr><td></td></tr>
</table>
EOM;
}

while ($row=mysql_fetch_array($rs))
{
echo <<<EOM
<table align='center' border='0' cellpadding='0' cellspacing='0' width='95%'>
	<tr>
	<td height='25px' width='10%' align='center'><small>$row[id_primanota]</small></td>
	<td height='25px' width='15%'><small>$row[data_registr]</small></td>
	<td height='25px' width='35%'><small>$row[descrizione]</small></td>
	<td height='25px' width='10%' align='right'><small>$row[entrata]</small></td>
	<td height='25px' width='10%' align='right'><small>$row[uscita]</small></td>
	<td height='25px' width='10%' align='right'><small>$row[entratab]</small></td>
	<td height='25px' width='10%' align='right'><small>$row[uscitab]</small></td>
	</tr>
</table><br>
EOM;
}

//Calcolo delle somme di Cassa
$query = "SELECT SUM(entrata) FROM tb_primanota";
$result = mysql_query($query);
$entrata_tot = mysql_fetch_row($result);

?>
<hr style="width: 20%; height: 2px; position: absolute; right: 16%"><br>
<table width='95%' border='0'>
<tr>
	<td width='56%'></td>
	<td height='30px' width='22%'><small><? echo $Lentratacassa; ?></small></td>
	<td height='30px' align='right' width='22%'><small><?php echo $entrata_tot[0]; ?></small></td>
</tr>

<?php
$query = "SELECT SUM(uscita) FROM tb_primanota";
$result = mysql_query($query);
$uscita_tot = mysql_fetch_row($result);

?>
<tr>
	<td width='56%'></td>
	<td height='30px' width='22%'><small><? echo $Luscitacassa; ?></small></td>
	<td height='30px' align='right' width='22%'><small><?php echo $uscita_tot[0]; ?></small></td>
</tr>
<tr>
	<td width='56%'></td>
	<td height='30px' width='22%'><small><b><? echo $Lguadperdita; ?></b></small></td>
	<td height='30px' align='right' width='22%'><small><b><?php echo ($entrata_tot[0]-$uscita_tot[0]); ?></b></small></td>
</tr>
</table><br>

<?php
//Calcolo delle somme di Banca
$query = "SELECT SUM(entratab) FROM tb_primanota";
$result = mysql_query($query);
$entratab_tot = mysql_fetch_row($result);

?>
<hr style="width: 20%; height: 2px; position: absolute; right: 16%"><br>
<table width='95%' border='0'>
<tr>
	<td width='56%'></td>
	<td height='30px' width='22%'><small><? echo $Lentratabanca; ?></small></td>
	<td height='30px' align='right' width='22%'><small><?php echo $entratab_tot[0]; ?></small></td>
</tr>
<?php
$query = "SELECT SUM(uscitab) FROM tb_primanota";
$result = mysql_query($query);
$uscitab_tot = mysql_fetch_row($result);
?>
<tr>
	<td width='56%'></td>
	<td height='30px' width='22%'><small><? echo $Luscitacassa; ?></small></td>
	<td height='30px' align='right' width='22%'><small><?php echo $uscitab_tot[0]; ?></small></td>
</tr>
<tr>
	<td width='56%'></td>
	<td height='30px' width='22%'><small><b><? echo $Lguadperdita; ?></b></small></td>
	<td height='30px' align='right' width='22%'><small><b><?php echo ($entratab_tot[0]-$uscitab_tot[0]); ?></b></small></td>
</tr></table><br>
<?php
mysql_close();
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><? echo $Lhelpprimanota; ?><hr></i></small><?
include('./botton.inc');

?>