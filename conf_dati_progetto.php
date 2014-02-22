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
	$ndescrizione = $_POST['formcontent'];
	$nnome = $_POST['nome'];

$sdescrizione = htmlspecialchars($ndescrizione, ENT_NOQUOTES, "UTF-8");
$snome = htmlspecialchars($nnome, ENT_NOQUOTES, "UTF-8");

$descrizione = mysql_escape_string($sdescrizione);
$nome = mysql_escape_string($snome);

//Connessione database
	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

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
   		redirect('./InsProgetto.php' ,2);
		break;
		}
		if ($nome == "")
 		{
   		echo "<center><b>Il campo Nome Cliente &egrave obbligatorio</b></center>";
   		redirect('./InsProgetto.php' ,2);
		break;
		}

//Inserisco i dati nella tabella dei record della singola fattura
$tb_tot_progetto = ('tb_tot_progetto(descrizione, nome, data)');

	if ($nome){ 
	  $sql="insert into $tb_tot_progetto values('$descrizione', '$nome', '$data')";
	  $risultato = mysql_query($sql) or die('Errore registrazione dati database');

		header('location: ./conferma.html'); //Vado alla pagina di conferma
	}else{ 
		header('location: ./errore.html'); //Vado alla pagina di errore
		}

mysql_close();
} 
?>
