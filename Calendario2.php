<?php
/*======================================================================+
 File name   : Calendario2.php
 Begin       : 2010-08-04
 Last Update : 2013-08-25

 Description : Generate Calendar for appointments

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

function ShowCalendar($m,$y)
{
  if ((!isset($_GET['d']))||($_GET['d'] == ""))
  {
    $m = date('n');
    $y = date('Y');
  }else{
    $m = (int)strftime( "%m" ,(int)$_GET['d']);
    $y = (int)strftime( "%Y" ,(int)$_GET['d']);
    $m = $m;
    $y = $y;
  }
  $precedente = mktime(0, 0, 0, $m -1, 1, $y);
  $successivo = mktime(0, 0, 0, $m +1, 1, $y);
  $nomi_mesi = array(
    "Gennaio",
    "Febbraio",
    "Marzo",
    "Aprile",
    "Maggio",
    "Giugno", 
    "Luglio",
    "Agosto",
    "Settembre",
    "Ottobre",
    "Novembre",
    "Dicembre"
  );
  $nomi_giorni = array(
    "Luned&igrave",
    "Marted&igrave",
    "Mercoled&igrave",
    "Gioved&igrave",
    "Venerd&igrave",
    "Sabato",
    "Domenica"
  );
  $cols = 7;
  $days = date("t",mktime(0, 0, 0, $m, 1, $y)); 
  $lunedi= date("w",mktime(0, 0, 0, $m, 1, $y));
$giorno = date("d");
  if($lunedi==0) $lunedi = 7;

  echo "<tr>\n
  <td colspan=\"".$cols."\" height='2%'>
  <a href=\"?d=" . $precedente . "\"><<--</a>
  " . $nomi_mesi[$m-1] . " " . $y . " 
  <a href=\"?d=" . $successivo . "\">-->></a></td></tr>";
  foreach($nomi_giorni as $v)
  {
    echo "<td width='15%' align='center'><b>".$v."</b></td>\n";
  }
  echo "</tr>";
  for($j = 1; $j<$days+$lunedi; $j++)
  {
    if($j%$cols+1==0)
    {
      echo "<tr>\n";
    }
    if($j<$lunedi)
    {
      echo "<td> </td>\n";
    }else{
      $day= $j-($lunedi-1);
      $data = date($day."-".$m."-".$y);
      $oggi = date("j-n-Y");

$Query = "SELECT * FROM appuntamenti WHERE str_data = '$data'";

$rs=mysql_query($Query)
or die('' . mysql_error());

while ($row=mysql_fetch_array($rs))
{
$evento=$row[str_data];
}

      if($data == $oggi)
      {
print("\n\t\t<td align='center'><b><a href=\"Calendario.php?cod=".$data."&cat=".$day."\"><span style=\"color:green;\">".$day."</span ></b></td>");
        //echo "<td>".$day."</td>";
      }else if($data == $evento)
{
print("\n\t\t<td align='center' ><b><a href=\"DettCal.php?cod=".$data."&cat=".$day."\"><span style=\"color:orange;\">".$day."</span ></a></b></td>");
}else{
print("\n\t\t<td align='center'><a href=\"Calendario.php?cod=".$data."&cat=".$day."\">".$day."</a></td>");
      //  echo "<td><b>".$day."</b></td>";
      }
  

    }
    if($j%$cols==0)
    {
      echo "</tr>";
    }
  }
  echo "<tr></tr>";
  echo "</tbody></table>";
}



function calendario()
{
include('./top.inc');
include('./menu.inc');
	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");



?>

     <center><h2>Calendario appuntamenti</h2></center>
<center><small>E' possibile inserire gli appuntamenti cliccando sul giorno desiderato<br>I giorni in arancione hanno un appuntamento registrato</small></center>
<br><br>
        <table align='center' border='0' width='80%'>
          <tbody>
<?php

//Richiamo la funzione calendario
ShowCalendar(date("m"),date("Y"));
$oggi = date("j-n-Y");


echo <<<html
<hr style="width: 60%; height: 2px;">

<table class='bordo' align="center" width='60%' border='0'><h3>Appuntamenti di oggi</h3>
	<tr>
	<td height='25px' width='10%' align='center'><small><b>id</b></small></td>
	<td height='25px' width='10%' align='center'><small><b>Data</b></small></td>
	<td height='25px' width='20%'><small><b>Titolo</b></small></td>
	<td height='25px' width='30%'><small><b>Testo</b></small></td>
	</tr>
html;


//Popolo la tabella appuntamenti del giorno
$Query = "SELECT * FROM appuntamenti WHERE str_data='$oggi'";
$rs=mysql_query($Query) or die('' . mysql_error());

while ($row=mysql_fetch_array($rs))
{

echo <<<EOM

	<tr>
	<td height='25px' width='10%' align='center'><small>$row[id]</small></td>
	<td height='25px' width='10%' align='center'><small>$row[str_data]</small></td>
	<td height='25px' width='20%'><small>$row[titolo]</small></td>
	<td height='25px' width='30%'><small>$row[testo]</small></td>
	</tr>
EOM;
}
{
echo <<<EOT
</table>
EOT;
}

//Condizione se non ci sono appuntamenti
$Query = "SELECT str_data FROM appuntamenti WHERE str_data='$oggi'";
$rs=mysql_query($Query)
or die('' . mysql_error());

$riga=mysql_fetch_array($rs);
if ($riga[str_data] != $oggi) {
echo "<h3>Non ci sono eventi registrati per oggi</h3>";
}

?>

<!-- Tabella di tutti gli appuntamenti -->
<hr style="width: 80%; height: 2px;">
<h3>Tutti gli appuntamenti registrati</h3>

<table class='bordo' width='60%' align="center" border='0'>
	<tr>
	<td height='25px' width='10%' align='center'><small><b>id</b></small></td>
	<td height='25px' width='10%' align='center'><small><b>Data</b></small></td>
	<td height='25px' width='20%'><small><b>Titolo</b></small></td>
	<td height='25px' width='30%'><small><b>Testo</b></small></td>
	</tr>
<?php

$Query = "SELECT * FROM appuntamenti";
$rs=mysql_query($Query)
or die('' . mysql_error());

while ($row=mysql_fetch_array($rs))
{

echo <<<EOM

	<tr>
	<td height='25px' width='10%' align='center'><small>$row[id]</small></td>
	<td height='25px' width='10%' align='center'><small>$row[str_data]</small></td>
	<td height='25px' width='20%'><small>$row[titolo]</small></td>
	<td height='25px' width='30%'><small>$row[testo]</small></td>
	</tr>
EOM;
}
{
echo <<<EOT
</table>
EOT;
}

mysql_close();
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i>Puoi inserire un nuovo appuntamento cliccando sopra al giorno del calendario.<br>Il giorno con degli appuntamenti registrati diventer&agrave di colore giallo e potrai aggiungere, modificare o cancellare appuntamenti.
<hr></i></small><?
include('./botton.inc');
}

if ($user == 'admin') {
calendario();
} 
if ($user == 'operatore') {
calendario();
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
