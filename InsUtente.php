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

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");
?>
     <center><h2>Gestione Utenti</h2></center>
	<p align="center"><small><b>Cancella</b></small></p>

<!-- Cancellazione e Modifica voci db -->
<table align='center' border='0' width='40%'>
<tbody>
	<tr>
		<td><p><small>Inserisci il numero id da <b>cancellare</b> e premi cancella</small></p></td>
	<td><form action='./conf_canc.php?Tabella=utenti&Riferimento=id' method='POST'>
		</td>		
		<td width='10'>id:</td>
		<td><input name='id_mod' size='10' type='text'></td>
	<td><p colspan='2' align='center'>
		<input value='- Cancella -' type='submit'></p>
	</td>
	</tr>
</tbody>
</table>
</form>
<hr style="width: 80%; height: 2px;">

<!-- Modifica delle voci -->
	<p align="center"><small><b>Modifica</b></small></p>
<p align="center"><small>Inserisci in numero id<br>Inserisci la <b>modifica</b> su Nuovo record e premi modifica</p></small>

<table align='center' border='0' width='50%'>
          <tbody>
	<td><form action='./conf_mod_utenti.php' method='POST'></td>
            <tr>
              <td width='150'><font color="red">Id*:</td>
              <td><input name='id_mod' size='10' type='text'></td>
            </tr>
            <tr>
		<td width='150'><font color="red">Campo*:</td>
<td><select name="campo" >
	<option value="" selected="selected">Seleziona il campo da modificare</option>
  <option value="utente">Nome Utente</option>
  <option value="nome">livello</option>
<!--  <option value="pswd">password</option> ***Manca l'MD5 perchè funzioni correttamente*** -->
</select>
	</td>
	</tr>
	<tr>
		<td width='150'><font color="red">Nuovo record*:</td>
		<td><input name='record' size='20' type='text'></td>
	<td><p colspan='2' align='center'>
	<input value=' Modifica ' type='submit'></p></td>
	</tr>
</tbody>
</table>
<hr width="60%">
</form> 

<!-- Inserimento Voci db -->
     <p align="center"><b><small>Inserimento nuovo utente</small></b></p>
<center><small>I campi contrassegnati con l'asterisco sono obbligatori</small></center>
<br>
      <form action='./conf_dati_utente.php' method='POST'>
        <table align='center' border='0' width='60%'>
          <tbody>
            <tr>
              <td width='150'><font color="red">Nome Utente *:</td>
              <td><input value="Nome Utente" name='nomeut' size='30' type='text'></td>
            </tr>
            <tr>
              <td width='150'><font color="red">Livello *:</td>
              <td><select name="livello" >
   <option value="" selected="selected"></option>
  <option value="admin">Amministratore</option>
  <option value="limitato">Utilizzatore limitato</option>
  <option value="operatore">Operatore</option>
  </select>
	</td>
       </tr>
            <tr>
              <td width='150'><font color="red">Password *:</td>
              <td><input type='password' name='passwd' size='30'></td>
            </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit'></td>
            </tr>
          </tbody>
        </table>
        <br>
      </form>
<?php

// popolo la tabella visualizzazione elenco
$Query_nome = "SELECT * FROM utenti ORDER BY nome";

$rs=mysql_query($Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<br>
<table class='bordo' align='center' cellpadding='0' cellspacing='0' width='50%'>
	<tr>
	<td width='30' align='center'><small><b>id</small></td>
	<td height='25px' width='125' align='center'><small><b>utente</b></small></td>
	<td width='125'><small><b>livello</b></small></td>
	</tr>
	<tr><td></td></tr>

EOM;
}

while ($row=mysql_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td height='25px' width='30' align='center'><small>$row[id]</small></td>
	<td height='25px' width='125' align='center'><small>$row[utente]</small></td>
	<td height='25px' width='125'><small>$row[nome]</small></td>
	</tr>

EOM;
}

echo <<<EOT
</table>
EOT;
mysql_close();
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i>Puoi inserire quanti utenti vuoi e modificarne anche successivamente il livello di accesso.<br>Non puoi modificare la password degli utenti, ma, se serve, puoi creare un utente con lo stesso nome ed una password diversa.
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

