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
if ($user == 'admin') {

	$nome = $_POST['nome'];
	$indirizzo = $_POST['indirizzo'];
	$numero = $_POST['numero'];
	$cap = $_POST['cap'];
	$citta = $_POST['citta'];
	$provincia = $_POST['provincia'];
	$tel = $_POST['tel'];
	$fax = $_POST['fax'];
	$cf = $_POST['cf'];
	$email = $_POST['email'];
	$webmail = $_POST['webmail'];
	$sito = $_POST['sito'];

/*$srecord = htmlspecialchars($nrecord, ENT_NOQUOTES, "UTF-8");
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
   		redirect('./InsUtente.php' ,2);
		break;
		}
		if ($campo == "")
 		{
   		echo "<center><b>Il campo &egrave obbligatorio</b></center>";
   		redirect('./InsUtente.php' ,2);
		break;
		}
		if ($record == "")
 		{
   		echo "<center><b>Il campo Nuovo Record &egrave obbligatorio</b></center>";
   		redirect('./InsUtente.php' ,2);
		break;
		} */

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

 
		$sql="UPDATE tb_anagrafe_associaz SET nome='$nome', indirizzo='$indirizzo', numero='$numero', cap='$cap', citta='$citta', provincia='$provincia', tel='$tel', fax='$fax', cf='$cf', email='$email', webmail='$webmail', sito='$sito' WHERE id_anagrafe = '1'"; //inserisco i valori nel database
		$result=mysql_query($sql);

	if (!$result) {
 //die(header('location: ./errore.html'));
echo ("Errore nella query $query: " . mysql_error());
	//	header('location: errore.html'); //Vado alla pagina di errore
	}else{ 
		header('location: ./conferma.html'); //Vado alla pagina di conferma
		}
mysql_close();
} else {
header('Location: ./index.php');
}
?>
