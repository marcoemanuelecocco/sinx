<?php
/*======================================================================+
 File name   : conf_canc.php
 Begin       : 2013-01-09
 Last Update : 2013-01-14

 Description : confirm a generic cancel date

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
=========================================================================+
*/
session_start();
$user = $_SESSION['utente'];
if ($user) {
	$nid_canc = $_POST['id_mod'];
$sid_canc = htmlspecialchars($nid_canc, ENT_NOQUOTES, "UTF-8"); //Protezione codice html
$id_canc = mysql_escape_string($sid_canc);
$Tabella = $_GET[Tabella];
$Rif=$_GET[Riferimento];

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
		if ($id_canc == "")
 		{
   		echo "<center><b>Il campo &egrave obbligatorio</b></center>";
   		redirect('./index2.php' ,2);
		break;
		}

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");
 
		$sql="DELETE FROM $Tabella WHERE $Rif = '$id_canc'"; //inserisco i valori nel database
		$result=mysql_query($sql);

	if (!$result) {
 die(header('location: ./errore.html'));//"Errore nella query $query: " . mysql_error());
		 //Vado alla pagina di errore
	}else{ 
		header('location: ./conferma.html'); //Vado alla pagina di conferma
		}
mysql_close();
} else {
header('Location: ./index2.php');
}
?>
