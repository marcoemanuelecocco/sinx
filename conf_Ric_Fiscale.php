<?php
/*======================================================================+
 File name   : conf_Ric_Fiscale.php
 Begin       : 2010-08-04
 Last Update : 2011-04-08

 Description : Verification and confirmation received

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
if ($user) {
	$snome = $_POST['insnome'];
	$sdata = $_POST['data'];
	$neuro = $_POST['euro'];
	$nattivita = $_POST['descrizione'];
	$contoec = $_POST['contoec'];
	$id_ric = $_POST['id'];

$seuro = htmlspecialchars($neuro, ENT_NOQUOTES, "UTF-8");
$sattivita = htmlspecialchars($nattivita, ENT_NOQUOTES, "UTF-8");

$nome = mysql_escape_string($snome);
$data = mysql_escape_string($sdata);
$euro = mysql_escape_string($seuro);
$attivita = mysql_escape_string($sattivita);

	$descrizione = "$attivita $nome"; 

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
		if ($nome == "")
 		{
   		echo "<center><b>Il campo Nome &egrave obbligatorio</b></center>";
   		redirect('./InsRicFisc.php' ,2);
		break;
		}
		if ($euro == "")
 		{
   		echo "<center><b>Il campo euro &egrave obbligatorio</b></center>";
   		redirect('./InsRicFisc.php' ,2);
		break;
		}

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

$tb_ricevuta = ('tb_ricevute(id_ric,nome, data, euro, descr)'); 
	if ($nome){ 

		$sql="insert into $tb_ricevuta values('$id_ric', '$nome', '$data', '$euro', '$attivita')"; //inserisco i valori nel database
		$result=mysql_query($sql);

//Carico in un array i dati da sincronizzare
$Query = "SELECT * FROM tb_ricevute ORDER BY id_ric DESC LIMIT 1";

$rs=mysql_query($Query)
or die('' . mysql_error());

while ($row=mysql_fetch_array($rs))
$idric = $row[id_ric];

//Aggiorno la prima nota
$tb_paga = ('tb_primanota(nome, id_ricevuta, data_registr, entrata, descrizione)');
		$sql="insert into $tb_paga values('$nome', '$idric', '$data', '$euro', '$descrizione')";

		$result=mysql_query($sql);

// Aggiornamento tabella conto economico
  //Recupero il valore originale e lo aggiorno
    $query = "SELECT valore FROM tb_conto_economico WHERE descrizione = '$contoec'";
    $result = mysql_query($query);
    $valoreorig = mysql_fetch_row($result);
$nuovovalore = ($valoreorig[0] + $euro);

		$sql="UPDATE tb_conto_economico SET valore = '$nuovovalore' WHERE descrizione = '$contoec'"; //inserisco i valori nel database
		$result=mysql_query($sql);



		header('location: ./conferma.html'); //Vado alla pagina di conferma
	}else{ 
		header('location: ./errore.html'); //Vado alla pagina di errore
		}



mysql_close();
} else {
header('Location: ./index.php');
}
?>
