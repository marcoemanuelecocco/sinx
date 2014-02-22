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

function modulo()
{
include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");
?>
      <center><h2>Inserisci i dati richiesti</h2></center>
      <form action='./gen_moduli.php' method='POST'>
        <table align='center' border='0' width='80%' cellspacing='6'>
 <caption>
  <center><small><i>Sotto le caselle sono indicati i moduli di riferimento</i></small></center>
 </caption>
          <tbody>
            <tr>
              <td width='30%'><font color="red">Modulo*:</td>
              <td><select name="modulo" >
   <option value="" selected="selected">Modulo  </option>
<optgroup label="Socio -> Associazione">
	<option value="ammissione" >Richiesta ammissione a Socio </option>
	<option value="ammissioneminore">Richiesta ammissione Socio minore </option>
	<option value="consenso" >Consenso Privacy </option>
	<option value="dimissioni" >Dimissioni Socio </option>
</optgroup>
<optgroup label="interno Associazione">
	<option value="consiglio" >Verbale Assemblea/riunione </option>
	<option value="convocazione" >Convocazione Consiglio Direttivo </option>
	<option value="rimborso" >Richiesta rimborso spese </option>
</optgroup>
  </select></td>
            </tr>
            <tr>
              <td >Associato:</td>
              <td colspan='2'><select name="nomeass" >
   <option value="" selected="selected">Nome: </option>
              <?php
		$query = "SELECT nome FROM tb_anagrafe ORDER BY nome";
 
$rs=mysql_query($query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysql_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
?></select></td>
            </tr>
            <tr>
              <td width='30%'>Data:</td>
              <td><input name='data' size='30' type='text' value=<?php echo date('d-m-Y') ?>><br><small><sub><i>per tutti i moduli</small></i></sub></td>
            </tr>
            <tr><td colspan="2" bgcolor="#fffece"><center><small><sub><i>E' possibile utilizzare i tag html es.:<br> &lt;br&gt; va a capo - &lt;b&gt;&lt;/b&gt; Grassetto - &lt;i&gt;&lt;/i&gt; Corsivo - &lt;hr&gt; Linea orizzontale - &lt;li&gt;&lt;/li&gt; elenco puntato</small></i></sub></center></td>
            </tr>
	    <tr>
	      <td width='150'>Soci Presenti:</td>
	      <td><textarea name='presenti' rows="5" cols="40">&lt;li&gt;Socio Uno&lt;/li&gt;&lt;li&gt;Socio Due&lt;/li&gt;</textarea><br><small><sub><i>"Verbale Assemblea"</small></i></sub></td>
            </tr>
            <tr>
	      <td width='150'>Ordine del giorno:<br><br></td>
	      <td><textarea name='OrdineGiorno' rows="5" cols="40">&lt;li&gt;Ordine giorno Uno&lt;/li&gt;&lt;li&gt;Ordine giorno Due&lt;/li&gt;</textarea><br><small><sub><i>"Verbale Assemblea" - "Convocazione consiglio"</small></i></sub></td>
            </tr>
	    <tr>
	      <td width='150'>Verbale:</td>
	      <td><textarea name='Verbale' rows="5" cols="40"></textarea><br><small><sub><i>"Verbale Assemblea" - "Richiesta rimborso spese" - "Dimissioni socio"</small></i></sub></td>
            </tr>

            <tr>
              <td colspan='2' align='center'>
              <input value='- Crea Modulo -' type='submit' <? echo($limit); ?>></td>
            </tr>
</table>
<hr style="width: 60%; height: 2px;">
<table align='center' border='0' width='60%'>
<tr>
	<!--<td height=50%; align='center'><a href="./Files.php">Directory Moduli e Files</td>-->
<td height=50%; align='center'><a class="transp" href="./Files.php"><img src="./ImmTemplate/Pulsanti/Files.png" title="Caricamento files e immagini" ></img></a></td>

</tr>
          </tbody>
        </table>
        <br>
      </form>
<?php

include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i>Puoi preparare un modulo utilizzando il form qui a fianco, oppure, premendo il pulsante in basso 'files e immagini' puoi utilizzare i moduli in pdf.
<hr></i></small><?
include('./botton.inc');
}

if ($user == 'admin') {
modulo();
}
if ($user == 'operatore') {
modulo();
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

mysql_close();
?>

