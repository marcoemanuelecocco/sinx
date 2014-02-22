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

	$id_mod = $_POST['id_mod'];
	$campo = $_POST['campo'];
	$nrecord = $_POST['record'];

$srecord = htmlspecialchars($nrecord, ENT_NOQUOTES, "UTF-8");
$record = mysql_escape_string($srecord);

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

//Controllo campi compilati
		if ($id_mod == "")
 		{
   		echo "<center><b>Il campo id &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		break;
		}
		if ($campo == "")
 		{
   		echo "<center><b>Il campo &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		break;
		}
		if ($record == "")
 		{
   		echo "<center><b>Il campo Nuovo Record &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		break;
		}

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");


		$sql="UPDATE tb_fatture SET $campo = '$record' WHERE id_riga_art = '$id_mod'"; //inserisco i valori nel database
		$result=mysql_query($sql);

	if (!$result) {
 die(header('location: ./errore.html'));//"Errore nella query $query: " . mysql_error());
	//	header('location: errore.html'); //Vado alla pagina di errore
	}else{ 
//Ricalcolo il record
  $query="SELECT id_fatt, quantita, euro, descr, iva, nome, data FROM tb_fatture WHERE id_riga_art = '$id_mod'";
  $rs=mysql_query($query) or die('' . mysql_error());

  while ($row=mysql_fetch_array($rs))
{
  $numfattura = $row['id_fatt'];
  $nome = $row['nome'];
  $data = $row['data'];
  $qta = $row['quantita'];
  $euro = $row['euro'];
  $descr = $row['descr'];
  $iva = $row['iva'];
}
$totale = $qta * ($euro + ($euro * ( $iva / 100)));
		$sql="UPDATE tb_fatture SET quantita = '$qta', euro = '$euro', descr = '$descr', iva = '$iva', totale = '$totale' WHERE id_riga_art = '$id_mod'";
		$result=mysql_query($sql) or die (mysql_error());

$query = "SELECT SUM(totale) as totale_numero FROM tb_fatture WHERE id_fatt = $numfattura";
$result = mysql_query($query);
if($result) {
  $row = mysql_fetch_array($result);
$totale = $row['totale_numero'];

$totfatt="UPDATE tb_tot_fatture SET tot_fattura = '$totale', nome = '$nome', data = '$data' WHERE id = '$id_mod'";
$risultato = mysql_query($totfatt);
} else {
  echo mysql_error();
}
		header('location: ./conferma.html'); //Vado alla pagina di conferma
		}
mysql_close();
} else {
header('Location: ./index.php');
}
?>
