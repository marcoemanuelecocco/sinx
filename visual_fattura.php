<?php
/*======================================================================+
 File name   : visual_fattura.php
 Begin       : 2010-08-04
 Last Update : 2011-04-08

 Description : View and edit bills

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
}
include('./top.inc');
include('./menu.inc');

//Funzione per il redirect
function redirect($url,$tempo = FALSE ){
 if(!headers_sent() && $tempo == FALSE ){
  header('Location:' . $url);
 }elseif(!headers_sent() && $tempo != FALSE ){
  header('Refresh:' . $tempo . ';' . $url);
 }else{
  if($tempo == FALSE ){
    $tempo = 0;
  }
  echo "<meta http-equiv=\"refresh\" content=\"" . $tempo . ";" . $url . "\">";
  }
} 

//Recupero l'ultimo id della tabella
$Query = "SELECT MAX(id_tot_fatture) FROM tb_tot_fatture";
$Qultimoid = mysql_query($Query);
while($Tultimoid = mysql_fetch_array($Qultimoid)){
$ultimoid= $Tultimoid['MAX(tb_tot_fatture)'];
}

$fattura = $_POST['id'];
//Controllo dati
		if ($fattura == "")
 		{
   		echo "<center><b>Numero fattura non selezionato</b><br>Inserisci un numero di fattura</center>";
   		redirect('./InsFattura.php',2);
		break;
		}

$dataoggi = date('d-m-Y');

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

?>
<!-- cancella -->
<h2>Gestione fattura</h2>
	<p align="center"><small><b>Cancella</b></small></p>
<table align='center' border='0' width='40%'>
<tbody>
	<tr>
		<td><p><small>Inserisci il numero id della riga da cancellare e premi cancella</small></p></td>
	<td><form action='./conf_canc.php?Tabella=tb_fatture&Riferimento=id_riga_art' method='POST'>
		</td>		
		<td width='10'>id*:</td>
		<td><select name="id_mod" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id_tot_fatture
	FROM tb_tot_fatture
	WHERE id_tot_fatture = $a
	ORDER BY id_tot_fatture
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
</tbody>
</table>
</form>
<hr style="width: 80%; height: 2px;">

<!-- Blocco Modifica (da rendere in un unico blocco comune) -->
	<p align="center"><small><b>Modifica</b></small></p>
<p align="center"><small>Inserisci in numero id e campo della riga da modificare<br>Inserisci la modifica su Nuovo record e premi modifica</p></small>

<table align='center' border='0' width='50%'>
          <tbody>
	<td><form action='./conf_mod_fattura.php' method='POST'></td>
            <tr>
              <td width='150'>Id*:</td>
              <td><select name="id_mod" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id_tot_fatture
	FROM tb_tot_fatture
	WHERE id_tot_fatture = $a
	ORDER BY id_tot_fatture
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
		<td width='150'>Campo*:</td>
<td><select name="campo" >
	<option value="" selected="selected">Seleziona il campo</option>
  <option value="quantita">Quantit&agrave</option>
  <option value="descr">Descrizione</option>
  <option value="euro">Prezzo Unitario</option>
  <option value="iva">Iva</option>
</select>
	</td>
	</tr>
	<tr>
		<td width='150'>Nuovo record*:</td>
		<td><input name='record' size='20' type='text'></td>
	<td><p colspan='2' align='center'>
	<input value=' Modifica ' type='submit' <? echo($limit); ?>></p></td>
	</tr>
</tbody>
</table>
</form> 
<hr style="width: 60%; height: 2px;">

<?php
//Visualizza fattura
$Query_nome = "SELECT nome FROM tb_fatture WHERE id_fatt = $fattura LIMIT 1";

$rs=mysql_query($Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysql_fetch_array($rs))
{
$nomecl = $row['nome'];
}
?>

<!-- VISUALIZZAZIONE FATTURA -->
<h3>Dettagli Fattura n.<i><?php echo($fattura) ?></i></h3>

<table align='right' border='0' cellpadding='2' cellspacing='2' width='90%'>
 <tr>
  <td><small>Fattura n. <b><?php echo($fattura) ?></b> del: <b><?php echo($dataoggi) ?></b></small></td>
 </tr>
</table>
<?php
$query_cliente = "SELECT nome, indirizzo, cap, citta, provincia FROM tb_anagrafe WHERE nome = '$nomecl'";
 $comando=mysql_query($query_cliente) or die(mysql_error);
 while ($array=mysql_fetch_array($comando))
  {
   echo <<<EOM
<br>
<table align='right' border='0' cellpadding='1' cellspacing='2' width='30%'>
	<tr>
	<td width='100'><small><b>Spett.le </b></small></td>
	</tr>
	<tr>
	<td width='100'><small>$array[nome]</small></td>
	</tr>
	<tr>
	<td width='100'><small>$array[indirizzo]</small></td>
	</tr>
	<tr>	
	<td width='100'><small>$array[cap] $array[citta], $array[provincia]</small></td>
	</tr>
	<tr><td height='35px'></td></tr>
</table>
EOM;
}



$Query_tab = "SELECT id_riga_art, quantita, descr, data, euro, iva, totale FROM tb_fatture WHERE id_fatt = '$fattura'";
$ris=mysql_query($Query_tab)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM

<table align='right' border='0' cellpadding='2' cellspacing='2' width='90%'>

	<tr>
	<td width='5%' height='35px' bgcolor="#D1D1D1"><small><b>id articolo </b></small></td>
	<td width='5%' height='35px' bgcolor="#D1D1D1"><small><b>Q.ta </b></small></td>
	<td width='55%' height='35px' bgcolor="#D1D1D1"><small><b>Descrizione </b></small></td>
	<td width='10%' height='35px' bgcolor="#D1D1D1"><small><b>Prezzo un. </b></small></td>
	<td width='5%' height='35px' bgcolor="#D1D1D1"><small><b>IVA </b></small></td>
	<td width='20%' height='35px' bgcolor="#D1D1D1"><small><b>Totale </b></small></td>
	</tr>
EOM;
}

while ($riga=mysql_fetch_array($ris))
{
echo <<<EOM
	<tr>
	<td height='35px'><small>$riga[id_riga_art]</small></td>
	<td height='35px'><small>$riga[quantita]</small></td>
	<td height='35px'><small>$riga[data] - $riga[descr]</small></td>
	<td height='35px'><small>$riga[euro] </small></td>
	<td height='35px'><small>$riga[iva] %</small></td>
	<td><small>$riga[totale] </small></td>
	</tr>
EOM;
}

echo <<<EOT
</table>
EOT;

$query = "SELECT SUM(totale) as totale_numero FROM tb_fatture WHERE id_fatt = $fattura";
$result = mysql_query($query);
  $row = mysql_fetch_array($result);
$totale = $row['totale_numero'];
{
   echo <<<EOM

<br>
<table align='right' border='0' cellpadding='1' cellspacing='2' width='30%' bgcolor="#D1D1D1">
	<tr>
	<td width='100'><small><b>Totale Fattura:</b></small></td>
	<td width='100'><small>$totale &euro;</small></td>
	</tr>
</table>
EOM;
}

mysql_close();
include('./menusx.inc');
include('./botton.inc');

?>
