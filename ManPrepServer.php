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
            <td><span style="font-weight: bold; color: rgb(255, 153, 0);">&nbsp;<span style="color: rgb(51, 102, 255);">Preparazione del server - Manuale di Sinx</span></span><br/><hr>
            </td>

        </tr>
        <tr>

            <td>&nbsp;</td>
            <td><font size="2">&nbsp;<b>Preparazione del server</b><br/>
            <br/>
            <meta http-equiv="CONTENT-TYPE" content="text/html; charset=utf-8"/>
<style type="text/css">
            </style>

<p>La preparazione del server richiede una certa conoscenza e capacit&agrave
informatiche basilari alla pari di un'installazione e pubblicazione di un sito
web dinamico come possono essere joombla, xoops o phpnuke.<br>
Non &egrave necessaria invece alcuna conoscenza di programmazione anche se,
per un corretto settaggio del software, &egrave indispensabile andare ad editare
alcuni file interni, ma, in quei casi, &egrave sufficiente seguire le indicazioni che
vengono date nel presente manuale e anche all'interno dei file stessi.<br><br>
Ci sono vari modi per preparare il server, il pi&ugrave usato all'interno dei server
web dei gestori del servizio &egrave l'utilizzo di phpMyAdmin, un sistema visuale
ben strutturato, tuttavia, qui di seguito, vengono riportati i comandi per la
preparazione tramite terminale all'interno del server, quindi, come prima
cosa, bisogna accedere al server; una soluzione consigliata &egrave quella
dell'utilizzo di ssh come vettore: ssh utente@dominio.server dove 'utente' &egrave
l'utente amministratore o gestore del server e dominio.server &egrave, appunto, il
nome di dominio da puntare, in alternativa &egrave possibile inserire l'indirizzo ip
(pubblico o privato a seconda che il server sia in locale o remoto).
</p>
            <p>Entrare con l'utente root o l'utente con i permessi di creare database di mysql; es:</p>

            <kbd>	mysql --user=root -p</kbd><br>
            <p>Da Mysql, creare il database (es.: nome del database &ldquo;gestionale&rdquo;):</p>
            <kbd>CREATE DATABASE gestionale;</kbd><br>
            <p>Creare l'utente per l'uso del database ed assegnargli i permessi:</p>
            <kbd>GRANT CREATE,SELECT,INSERT,DELETE,UPDATE,ALTER<br>ON gestionale.*<br>
            TO 'administrator'@'localhost'<br>
            IDENTIFIED BY 'adminpassword';</kbd><br>
            <p>Uscire da Mysql, il database &egrave pronto.</p>

            <p>Ora entrate nel file dati_db e inserite i dati appena impostati:</p>
            <p>	$host=&rdquo;localhost&rdquo;; //Hostname</br>
            $username=&rdquo;administrator&rdquo;; // Mysql username</br>
            $password=&rdquo;adminpassword&rdquo;; // Mysql password</br>
	    $db_name=&rdquo;gestionale&rdquo;; //Nome del Database</p>
            <p>Ora &egrave; possibile aprire il Browser e puntare il dominio dove risiede Sinx aggiungendo /Install al termine del percorso.</p>
            <p>Si avvier&agrave quindi l'installazione del programma.</p>
            <br/>

            <div style="margin-left: 40px;">&nbsp;</div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </tbody>
</table>
            <td valign="top">
		<br>
		<a href="./Manuale.php"><small>Indice</small></a>
		<a href="./ManPrepServerext.php"><img src="./ImmTemplate/fleched.gif" border='0'></a>
	    </td>
<?php
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
