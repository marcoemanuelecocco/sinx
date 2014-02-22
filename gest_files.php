<?php
/*======================================================================+
 File name   : gest_files.php
 Begin       : 2012-07-08
 Last Update : 2012-07-08

 Description : Image and files upload

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
if ($user == 'admin') {

include('./top.inc');
include('./menu.inc');
?>
      <form action='./conf_immagine.php' method='POST' enctype="multipart/form-data">
<center><h2>Caricamento immagini e files</h2></center>
<table align='center' width='80%'>

	    <tr>
	      <td width='150'>Carica Immagine:<input type="hidden" name="MAX_FILE_SIZE" value="30000"> </td>
	      <td> <input name="immagine" type="file" accept="image/*"><br><small><sub><i>Inserisci l'immagine o foto dell'Associato <b>massimo 30 kByte</b></small></i></sub></td>
	      <td><small><sub><i>In questa casella si inseriscono le immagini dedicate per le schede associati.<br>Le immagini possono essere di tipo gif, jpg, png, ma <b>non possono superare i 30Kbyte</b>.<br>Una volta caricata l'immagine bisogna assegnarla all'Associato utilizzando la funzione <b>'Modifica'</b> presente nella scheda associato.</sub></small></td>
	    </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit'></td>
            </tr>
</table>
</form>
<hr style="width: 80%; height: 2px;">
      <form action='./conf_files.php' method='POST' enctype="multipart/form-data">
<center><br>Caricamento Nuovi Moduli</center><br>
<table align='center' width='80%'>

	    <tr>
	      <td width='150'>Carica File:<input type="hidden" name="MAX_FILE_SIZE" value="1000000"> </td>
	      <td> <input name="immagine" type="file" accept="application/pdf,application/text,application/odt"><br><small><sub><i>Upload di moduli e files in generale <b>massimo 1 MByte</b> del tipo pdf,txt</small></i></sub></td>
	      <td><small><sub><i>Casella dedicata all'upload dei moduli precompilati; &egrave possibile caricare file di tipo pdf, o txt che <b>non superino 1Mbyte</b>.<br></i></sub></small></td>
	    </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit'></td>
            </tr>
</table>
<hr style="width: 60%; height: 2px;">
<table align='center' border='0' width='60%'>
<tr>
<center><h3>File e immaginicaricate</h3></center>
	<!--<td height=50%; align='center'><a href="./Files.php">Directory Moduli e Files</td>-->
<td height=50%; align='center'><a class="transp" href="./Files.php"><img src="./ImmTemplate/Pulsanti/Files.png" title="Caricamento files e immagini" ></img></a></td>

</tr>
          </tbody>
        </table>
</form>

<?php
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i>Da qui puoi inserire le immagini degli associati, ma anche i file pdf che ritieni utili alla tua associazione.<br>Leggi attentamente le note nella pagina.<br>Se i file non si caricano, verifica i permessi nelle cartelle 'Download' e 'Immagini/Utenti'
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
