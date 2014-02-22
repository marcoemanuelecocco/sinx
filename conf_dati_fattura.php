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
	$data = $_POST['data'];
	if($data == FALSE){
	$data = date('d-m-Y');
	}	
	$ndescrizione = $_POST['Descr'];
	$nquantita = $_POST['Qta'];
	$nprezzoun = $_POST['prezzoun'];
	$nnumfattura = $_POST['fattnum'];
	$nnome = $_POST['nome'];
	$niva = $_POST['iva'];

$sdescrizione = htmlspecialchars($ndescrizione, ENT_NOQUOTES, "UTF-8");
$squantita = htmlspecialchars($nquantita, ENT_NOQUOTES, "UTF-8");
$sprezzoun = htmlspecialchars($nprezzoun, ENT_NOQUOTES, "UTF-8");
$snumfattura = htmlspecialchars($nnumfattura, ENT_NOQUOTES, "UTF-8");
$snome = htmlspecialchars($nnome, ENT_NOQUOTES, "UTF-8");
$siva = htmlspecialchars($niva, ENT_NOQUOTES, "UTF-8");

$descrizione = mysql_escape_string($sdescrizione);
$quantita = mysql_escape_string($squantita);
$prezzoun = mysql_escape_string($sprezzoun);
$numfattura = mysql_escape_string($snumfattura);
$nome = mysql_escape_string($snome);
$iva = mysql_escape_string($siva);

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
		if ($descrizione == "")
 		{
   		echo "<center><b>Il campo Descrizione &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		break;
		}
		if ($quantita == "")
 		{
   		echo "<center><b>Il campo Quantit&agrave &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		break;
		}
		if ($prezzoun == "")
 		{
   		echo "<center><b>Il campo Prezzo unitario &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		break;
		}
		if ($numfattura == "")
 		{
   		echo "<center><b>Il campo Numero Fattura &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		break;
		}
		if ($nome == "")
 		{
   		echo "<center><b>Il campo Nome Cliente &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		break;
		}
		if ($iva == "")
 		{
   		echo "<center><b>Il campo iva &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		break;
		}

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

//Inserisco i dati nella tabella dei record della singola fattura
$totfattura = $quantita * ($prezzoun + ($prezzoun * ( $iva / 100)));
$tb_fattura = ('tb_fatture(id_fatt, nome, data, euro, quantita, descr, iva, totale)');
$tb_tot_fattura = ('tb_tot_fatture(id_tot_fatture, tot_fattura, nome, data)');

	if ($totfattura){ 
		$sql="insert into $tb_fattura values('$numfattura', '$nome', '$data', '$prezzoun', '$quantita', '$descrizione', '$iva', '$totfattura')";
		$result=mysql_query($sql) or die (mysql_error());

//Aggiorno i totali della singola fattura
$query = "SELECT SUM(totale) as totale_numero FROM tb_fatture WHERE id_fatt = $numfattura";
$result = mysql_query($query);
if($result) {
  $row = mysql_fetch_array($result);
$totale = $row['totale_numero'];

$totfatt="insert into $tb_tot_fattura values('$numfattura', '$totale', '$nome', '$data')";
$risultato = mysql_query($totfatt);

} else {
  echo mysql_error();
}


		header('location: ./conferma.html'); //Vado alla pagina di conferma
	}else{ 
		header('location: ./errore.html'); //Vado alla pagina di errore
		}
mysql_close();
} else {
header('Location: ./index.php');
}
?>
