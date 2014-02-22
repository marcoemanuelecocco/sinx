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
include('./top.inc');
include('./menu.inc');
?>

<table align='center' border='0' width='80%'>
<tbody>
      <tr><td><center><h2>Log del sistema</h2><hr></center></td></tr>
<tr><td align='right'><small><a href="./CancLog.php">Azzera log di sistema</a></small></td></tr>
<tr><td><small><? include('./log/logSinx.txt') ?></small></td></tr>
      
</tbody>
</table>
<?php

include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i>Il file di log &egrave utile per avere uno storico del sistema, per&ograve pu&ograve arrivare ad avere dimensioni grandi;<br>quando si &egrave sicuri, &egrave possibile azzerare il file.
<hr></i></small><?
include('./botton.inc');
} else {
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

