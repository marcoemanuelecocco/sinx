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

	$id = $_POST['id'];
	$data = $_POST['data'];
	$campo = $_POST['campo'];
	$record = $_POST['record'];

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

		if ($campo == "")
 		{
   		echo "<center><b>Il campo Titolo &egrave obbligatorio</b></center>";
   		redirect('./Calendario2.php' ,2);
		break;
		}
		if ($record == "")
 		{
   		echo "<center><b>Il campo Testo &egrave obbligatorio</b></center>";
   		redirect('./Calendario2.php' ,2);
		break;
		}

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

 if(isset($_POST['nuovo'])) {
   // è stato pulsante nuovo

		$sql = "INSERT INTO appuntamenti (titolo,testo,str_data) VALUES ('$campo', '$record', '$data')"; //inserisco i valori nel database
		$result=mysql_query($sql);
}

 if(isset($_POST['modifica'])) {
   // è stato premuto il pulsante modifica

		if ($id == "")
 		{
   		echo "<center><b>Il campo Id &egrave obbligatorio</b></center>";
   		redirect('./Calendario2.php' ,2);
		break;
		}

		$sql="UPDATE appuntamenti SET titolo = '$campo', testo = '$record' WHERE id = '$id'"; //inserisco i valori nel database
		$result=mysql_query($sql);
}
	if (!$result) {
 die(header('location: ./errore.html'));//"Errore nella query $query: " . mysql_error());
	//	header('location: errore.html'); //Vado alla pagina di errore
	}else{ 
		header('location: ./conferma.html'); //Vado alla pagina di conferma
		}
mysql_close();
} else {
header('Location: ./index.php');
}
?>
