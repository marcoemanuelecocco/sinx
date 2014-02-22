<?php
/*======================================================================+
 File name   : Calendario.php
 Begin       : 2010-08-04
 Last Update : 2013-08-25

 Description : Compilation date for calendar appointments

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

function appuntamenti() {
include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

?>

     <p align="center">Inserimento Appuntamenti</p>
<center><small>I campi contrassegnati con l'asterisco sono obbligatori</small></center>
<br>
      <form action="./Calendario.php" method="post">
        <table align='center' border='0' width='60%'>
          <tbody>
<?php

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

// inserimento dati
if (isset($_POST['submit']) && $_POST['submit']=="invia")
{
  $titolo = addslashes($_POST['titolo']);
  $testo = addslashes($_POST['testo']);
  $str_data = $_POST['data'];

//Controllo campi compilati

		if ($titolo == "")
 		{
   		echo "<center><b>Il campo &egrave obbligatorio</b></center>";
   		redirect('./Calendario2.php' ,2);
		break;
		}

  $sql = "INSERT INTO appuntamenti (titolo,testo,str_data) VALUES ('$titolo', '$testo', '$str_data')";
  if($result = mysql_query($sql) or die (mysql_error()))
  {
    redirect('./Calendario2.php' ,2);
  }
}else{
$string = $_GET[cod];
  ?>
<tr>
  <td><font color="red"><b>Titolo *:</b></td>
  <td><input name="titolo" type="text"></td><br>
</tr>
<tr>
  <td>Testo:</td>
  <td><textarea name="testo" cols="30" rows="8"></textarea></td><br>
</tr>
<tr>
  <td>Data:</td>
  <td><input name="data" readonly="text" value="<?php echo $string; ?>"></td><br>
</tr>
<tr><td></td><td><input name="submit" type="submit" value="invia" <? echo($limit); ?>></td></tr>
</tbody>
</table>
</form>

<?php
}

mysql_close();
include('./menusx.inc');
include('./botton.inc');
}

if ($user == 'admin') {
appuntamenti();
} 
if ($user == 'operatore') {
appuntamenti();
} else if ($user == 'limitato') {
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

echo "<center>Il tuo utente ha un livello <b>$user</b> <br>Area permessa solo all'utente <b>Admin</b></center>";
redirect('./index2.php',3);
}
?>
