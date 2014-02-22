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
include('./menu.inc');
?>
<br>
<table cellspacing="1" cellpadding="1" border="0" align="" style="width: 80%">
    <tbody>
        <tr>
            <td></td>
            <td><span style="font-weight: bold; color: rgb(255, 153, 0);">&nbsp;<span style="color: rgb(51, 102, 255);">Installazione server esterno- Manuale di Sinx</span></span><br/><hr>
            </td>

        </tr>
        <tr>

            <td>&nbsp;</td>
            <td><font size="2">&nbsp;<b>Preparazione nel server</b><br/>
            <br/>
            <meta http-equiv="CONTENT-TYPE" content="text/html; charset=utf-8"/>
<style type="text/css">
            </style>
Chi non &egrave in possesso di un server interno, pu&ograve installare sinx esattamente come si fa per un sito dinamico; qui di seguito si spiega una dinamica standard.<br>Dopo aver deciso a quale provider affidarsi, bisogna registrare il dominio.<br>Per la registrazione, fare attenzione ad abilitare le funzioni per il linguaggio php e il database mysql.<br>Se non si necessita di un dominio in primo livello, ci sono alcuni provider che danno uno spazio con database gratuito in terzo livello; &egrave sufficente fare una ricerca in internet per trovarne; uno di questi testato con sinx &egrave Altervista (http://it.altervista.org).<br><br>Una volta ottenuto il dominio procedere come di seguito:
<p>Tramite ftp o gestore interno di file del provider, copiare tutta la cartella scompattata di Sinx.</p>
<p>Attivare il database, generalmente viene utilizzata un'interfaccia grafica per la gestione come phpmyAdmin, per l'utilizzo, si rimanda alle istruzioni dell'interfaccia.</p>

<p>Ora entrate nel file dati_db.inc della cartella di Sinx e inserite i dati appena impostati:
	<p><kbd>$host="localhost"; //Hostname</br>
	$username="nome_utente_db_assegnato"; // Mysql username</br>
	password="password_db_assegnata"; // Mysql password</br>
	$db_name="nome_db_assegnato"; //Nome del Database</kbd></p>
<br>Ora &egrave possibile aprire il Browser e puntare il dominio dove risiede Sinx aggiungendo /Install per lanciare l'installazione.
            <br/>

            <div style="margin-left: 40px;">&nbsp;</div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </tbody>
</table>
            <td valign="top">
		<br>
		<a href="./ManPrepServer.php"><img src="./ImmTemplate/flecheg.gif" border='0'></a>
		<a href="./Manuale.php"><small>Indice</small></a>
		<a href="./ManUtenti.php"><img src="./ImmTemplate/fleched.gif" border='0'></a><br>
      <hr>
      </td>
<?php
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
