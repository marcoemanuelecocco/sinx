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
include('./top.inc');

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

//Recupero l'indirizzo mail dell'Associazione
$Query_nome = "SELECT email FROM tb_anagrafe_associaz";

$rs=mysql_query($Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$row=mysql_fetch_array($rs);
$mailer = $row[email]; 


$destinatario = $_POST['destinatario'];
$oggetto = $_POST['subject'];
$ssubject = htmlspecialchars($oggetto, ENT_NOQUOTES, "UTF-8");
$subject = mysql_escape_string($ssubject);
if ($subject == "")
  {
	include('./Intestazione.php');
    echo "<center>Il campo OGGETTO &egrave obbligatorio</center>";
    redirect('./Comp_email.php',2);
    break;
  }
$formmessaggio = $_POST['formcontent'];
//$sformcontent = htmlspecialchars($formmessaggio, ENT_NOQUOTES, "UTF-8");
$sformcontent = mysql_escape_string($formmessaggio);
$formcontent = str_replace('\r\n','<br>',$sformcontent); //sostituisco i caratteri \r\n con <br>

if ($formcontent == "")
  {
	include('./Intestazione.php');
    echo "<center>Il campo MESSAGGIO &egrave obbligatorio</center>";
    redirect('./Comp_email.php',2);
    break;
  }


$mailheader  = "MIME-Version: 1.0\r\n";
$mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n";
$mailheader .= "From: <$mailer>";


//NEL CASO DECIDA DI MANDARE UNA MAIL AD UN NON ISCRITTO
if ($destinatario == 'esterno') {

$recipient = $_POST['recipient'];
if ($recipient == "")
  {
	include('./Intestazione.php');
    echo "<center>Il campo A: &egrave obbligatorio</center>";
    redirect('./Comp_email.php',2);
    break;
  }

//Spedisco mail
mail($recipient, $subject, $formcontent, $mailheader) or die("Impossibile inviare l'e-mail");
}

//NEL CASO DECIDA DI SPEDIRE AD UN ASSOCIATO ISCRITTO
elseif ($destinatario == 'associato') {

$recipient = $_POST['iscritto'];
if ($recipient == "")
  {
	include('./Intestazione.php');
    echo "<center>Il campo A: &egrave obbligatorio</center>";
    redirect('./Comp_email.php',2);
    break;
  }

//Spedisco mail
mail($recipient, $subject, $formcontent, $mailheader) or die("Impossibile inviare l'e-mail");
}

//NEL CASO DECIDA DI SPEDITE A TUTTI (NEWSLETTER)
elseif ($destinatario == 'tutti') {
$a = '0';
$Range = '30';
$sql = "SELECT email FROM tb_anagrafe WHERE email != '' and tipologia != 'Extra'";
$result = mysql_query($sql) or die("Impossibile inviare l'e-mail");
while ($recipient = mysql_fetch_array($result))
{

     mail($recipient[email], $subject, $formcontent, $mailheader) ;
    echo "<b><center><small>$recipient[email]</b> - Spedita correttamente</small></center>";

if ($a >= $Range)
  {
  sleep(5);
  $Range = ($Range + $a);
  }
$a++;
  } 
}

//NEL CASO DECIDA DI SPEDITE AI FONDATORI
elseif ($destinatario == 'fondatori') {
$a = '0';
$Range = '30';
$sql = "SELECT email FROM tb_anagrafe WHERE email != '' and tipologia != 'Ins'";
$result = mysql_query($sql) or die("Impossibile inviare l'e-mail");
while ($recipient = mysql_fetch_array($result))
{

     mail($recipient[email], $subject, $formcontent, $mailheader) ;
    echo "<b><center><small>$recipient[email]</b> - Spedita correttamente</small></center>";

if ($a >= $Range)
  {
  sleep(5);
  $Range = ($Range + $a);
  }
$a++;
  } 
}


//Se decido di salvare la mail
$checkbox = isset($_POST["check"]);
if ($checkbox) {


	$data = date('d-m-Y');
	$tb_email = ('tb_email(data, dest, testo)');
	$sql="insert into $tb_email values('$data', '$recipient', '<b>Oggetto:</b> $subject <br><b>Testo:</b> $formcontent')"; //inserisco i valori nel database
	$result=mysql_query($sql);
	}

echo "<br><hr><center><b>$a Mail inviata correttamente.</b><br><br><a href='./index2.php'><b>Ritorna</b></a></center>";


mysql_close();
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
