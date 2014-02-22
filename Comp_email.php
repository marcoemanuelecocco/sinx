<?php
/*======================================================================+
 File name   : Comp_email.php
 Begin       : 2013-01-09
 Last Update : 2013-08-24

 Description : creating a message mail for associates

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
if ($user == 'admin') {

include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");
?>

    <form action='./email.php' method='POST'>
<center><h2>Spedizione e-mail</h2></center>
      <table align='center' width='60%' border='0'>
	<tr>
	  <td width='150'>A: *</td>
	  <td>
 <fieldset>
  <legend><small>Seleziona destinatario:</small></legend>
  <input type="radio" name="destinatario" value="esterno" checked="checked"/><input type='email' name='recipient' size='30' /><br>
  <input type="radio" name="destinatario" value="associato"/><select name="iscritto" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT email
	FROM tb_anagrafe
	WHERE id_anagrafe = $a AND email != '' 
	ORDER BY email ASC
	LIMIT 1";
 
$rs=mysql_query($query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysql_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
$a++;
} while ($a <= 500);
?>
  </select><br>
  <input type="radio" name="destinatario" value="tutti"/><b><i><small>Tutti gli associati</small></i></b><br>
<small><sub><i>Sono esclusi solo i collaboratori ed estrni</i></sub></small><br>
  <input type="radio" name="destinatario" value="fondatori"/><b><i><small>Solo Fondatori</small></i></b><br>
<small><sub><i>Presidente, consiglieri e la lista dei fondatori</i></sub></small><br>
</fieldset>
	</td>
	</tr>
	<tr>
	<tr>
	  <td width='150'>Oggetto *</td>
	  <td><input type='text' name='subject' size='30' /></td>
	</tr>
	<tr>
	  <td width='150'>Messaggio *</td>
	  <td><textarea name='formcontent' rows="7" cols="60"></textarea><br>
<small><sub><i>E' possibile utilizzare i tag html per creare il messaggio es.: &lt;br&gt; va a capo, &lt;b&gt;&lt;/b&gt; Grassetto &lt;i&gt;&lt;/i&gt; Corsivo &lt;hr&gt; Linea orizzontale &lt;li&gt;&lt;/li&gt; elenco puntato &lt;h1&gt;&lt;/h1&gt;...&lt;h6&gt;&lt;/h6&gt; Titoli</i></sub></small>
	</td>
	</tr>
	<tr>
	 <td></td>
	  <td><input type="checkbox" name="check" value="salva"> Salva Mail<br></td>
	</tr>
<tr><td><hr></td><td><hr></td></tr>
	<tr>
	  <td colspan='2' align='center'><input type='submit' value='Spedisci' <? echo($limit); ?>/></td>
	</tr><br>
<center><b>*** Tutti i campi contrassegnati con l'asterisco, sono obbligatori! ***</b></center><br>
      </table>
    </form>

<table align='center'>
<tr>
<!-- <td><a href='./Posta_ricevuta.php'><img src="./ImmTemplate/Pulsanti/Posta_ricevuta.png" onMouseOver="this.src='./ImmTemplate/Pulsanti/Posta_ricevuta2.png'" onMouseOut="this.src='./ImmTemplate/Pulsanti/Posta_ricevuta.png'" title="Ultimi 30 messaggi presenti sulla casella di posta"></img></a></td> -->
<td><a class="transp" href='./Posta_inviata.php'><img src="./ImmTemplate/Pulsanti/Posta_inviata.png" title="Posta inviata e salvata su Sinx"></img></a></td>
</tr>
</table>


<?php


mysql_close();
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i>Puoi selezionare se:<li>Spedire una mail non registrata compilandola manualmente</li><li>Spedire una mail ad un associato</li><li>Spedire una mail a tutti gli associati</li><li>Spedire una mail a solo i fondatori</li><br>Fai attenzione che certi provider bloccano le mail di massa ritenendole spam
<hr></i></small><?
include('./botton.inc');
} else {
header('Location: Rip_database.php');
}
?>