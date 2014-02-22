<?php
/*======================================================================+
 File name   : conf_dati.php
 Begin       : 2010-08-04
 Last Update : 2012-07-08

 Description : confirm data

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
//Apro il db
	include ('../dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

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

//escape html
//$snome = htmlspecialchars($nnome, ENT_NOQUOTES, "UTF-8");
/*$scognome = htmlspecialchars($ncognome, ENT_NOQUOTES, "UTF-8");
$sindirizzo = htmlspecialchars($nindirizzo, ENT_NOQUOTES, "UTF-8");
$scitta = htmlspecialchars($ncitta, ENT_NOQUOTES, "UTF-8");
$sprovincia = htmlspecialchars($nprovincia, ENT_NOQUOTES, "UTF-8");
$stel = htmlspecialchars($ntel, ENT_NOQUOTES, "UTF-8");
$stel2 = htmlspecialchars($ntel2, ENT_NOQUOTES, "UTF-8");
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
$datan = mysql_escape_string($sdatan);
$nomerif = mysql_escape_string($snomerif);
$email = mysql_escape_string($semail);
$note = mysql_escape_string($snote); */

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
   		redirect('./Install3.php' ,2);
		break;
		}
		if ($cf == "")
 		{
   		echo "<center><b>Il campo Codice fiscale &egrave obbligatorio</b></center>";
   		redirect('./Install3.php' ,2);
		break;
		}



//popolo la tabella
$tb_anagrafe = ('tb_anagrafe_associaz(nome, indirizzo, numero, cap, citta, provincia, tel, fax, cf, email, webmail, sito)');
	if ($nome){ 
		$sql="insert into $tb_anagrafe values('$nome','$indirizzo','$numero','$cap','$citta','$provincia','$tel','$fax','$cf','$email','$webmail','$sito')"; //inserisco i valori nel database
		$result=mysql_query($sql);

		echo("<center><h2>Installazione effettuata</h2></center>");
		redirect('../index.php' ,2); //Vado alla pagina di conferma
	}else{ 
		echo("Errore nell'inserimento dei dati"); //Vado alla pagina di errore
		}
mysql_close();
?>