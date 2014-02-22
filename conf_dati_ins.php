<?php
/*======================================================================+
 File name   : conf_mod_stud
 Begin       : 2010-08-04
 Last Update : 2012-07-07

 Description : confirm entry associated with new

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
	//$nnome = $_POST['nome'];
	$snome = $_POST['nome'];
	$ncognome = $_POST['cognome'];
	$nindirizzo = $_POST['indirizzo'];
	$cap = $_POST['comuni'];
	$ncitta = $_POST['regioni'];
	$nprovincia = $_POST['provincie'];
	$ntel = $_POST['tel'];
	$ntel2 = $_POST['tel2'];
	$ndatangg = $_POST['datangg'];
	$ndatanmm = $_POST['datanmm'];
	$ndatanaaaa = $_POST['datanaaaa'];
	$nmateria = $_POST['materia'];
	$nnomerif = $_POST['nomerif'];
	$email = $_POST['email'];
	$nnote = $_POST['note'];

$ndatan = ($ndatangg."-".$ndatanmm."-".$ndatanaaaa);


//protezione dati da codice html
//$snome = htmlspecialchars($nnome, ENT_NOQUOTES, "UTF-8");
$scognome = htmlspecialchars($ncognome, ENT_NOQUOTES, "UTF-8");
$sindirizzo = htmlspecialchars($nindirizzo, ENT_NOQUOTES, "UTF-8");
$scitta = htmlspecialchars($ncitta, ENT_NOQUOTES, "UTF-8");
$sprovincia = htmlspecialchars($nprovincia, ENT_NOQUOTES, "UTF-8");
$stel = htmlspecialchars($ntel, ENT_NOQUOTES, "UTF-8");
$stel2 = htmlspecialchars($ntel2, ENT_NOQUOTES, "UTF-8");
$smateria = htmlspecialchars($nmateria, ENT_NOQUOTES, "UTF-8");
$sdatan = htmlspecialchars($ndatan, ENT_NOQUOTES, "UTF-8");
$snomerif = htmlspecialchars($nnomerif, ENT_NOQUOTES, "UTF-8");
$snote = htmlspecialchars($nnote, ENT_NOQUOTES, "UTF-8");

//escape sql
$nome = mysql_escape_string($snome);
$cognome = mysql_escape_string($scognome);
$indirizzo = mysql_escape_string($sindirizzo);
$citta = mysql_escape_string($scitta);
$provincia = mysql_escape_string($sprovincia);
$tel = mysql_escape_string($stel);
$tel2 = mysql_escape_string($stel2);
$materia = mysql_escape_string($smateria);
$nomerif = mysql_escape_string($snomerif);
$datan = mysql_escape_string($sdatan);
$note = mysql_escape_string($snote);

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
   		echo "<center><b>Il campo nome &egrave obbligatorio</b></center>";
   		redirect('./InsAnagrIns.php' ,2);
		break;
		}
		if ($materia == "")
 		{
   		echo "<center><b>Il campo Tipo Associato &egrave obbligatorio</b></center>";
   		redirect('./InsAnagrIns.php' ,2);
		break;
		}

// *** GESTIONE DELL'IMMAGINE ***
$upload_dir = "./Immagini/Utenti";
if(@is_uploaded_file($_FILES["immagine"]["tmp_name"])) {
$file_name = $_FILES["immagine"]["name"];
@move_uploaded_file($_FILES["immagine"]["tmp_name"], "$upload_dir/$file_name")
or die("Impossibile spostare il file, controlla l'esistenza o i permessi della directory dove fare l'upload.");

} else {

$file_name = "personal.gif";
@move_uploaded_file($_FILES["immagine"]["tmp_name"], "$upload_dir/$file_name");

}
// *** FINE MODULO GESTIONE IMMAGINE ***

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

$tb_anagrafe = ('tb_anagrafe(nome, cognome, indirizzo, cap, citta, provincia, tel, tel2, materia, email, nomerif, datan, tipologia, note, immagine)');
	if ($nome){ 
		$sql="insert into $tb_anagrafe values('$nome', '$cognome', '$indirizzo', '$cap', '$citta', '$provincia', '$tel', '$tel2', '$materia', '$email', '$nomerif', '$datan', 'Ins', '$note', '$file_name')"; //inserisco i valori nel database
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
