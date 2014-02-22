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
            <td><span style="font-weight: bold; color: rgb(255, 153, 0);">&nbsp;<span style="color: rgb(51, 102, 255);">Preparazione del server - Note sugli utenti</span></span><br/><hr>
            </td>

        </tr>
        <tr>

            <td>&nbsp;</td>
            <td><font size="2">&nbsp;<b>Utenti del programma</b><br/>
            <br/>
            <meta http-equiv="CONTENT-TYPE" content="text/html; charset=utf-8"/>
<style type="text/css">
            </style>
Il software utilizza tre livelli di utenza: Admin, Operatore e Limitato.<br>
Dal men&ugrave &egrave possibile visualizzare quali pagine sono permesse facendo riferimento alle prime tre lettere presenti su ogni voce del men&ugrave: <li>A = Admin</li><li>O = Operatore</li><li>L = Limitato</li>

Lo scopo di queste limitazioni &egrave quello di poter dare la possibilit&agrave di utilizzo del software anche a utilizzatori con minori responsabilit&agrave, e, nel contempo, evitare l'utilizzo scorretto da parte di questi ultimi.<br>
L'utente amministratore &egrave l'unico che ha i permessi di aggiungere utenti utilizzatori, e pu&ograve decidere a quale livello possono operare.<br><br>
ATTENZIONE: gli utenti che utilizzano il software non hanno alcuna attinenza con l'utente per l'utilizzo del database configurato durante l'installazione.
            <br/>

            <div style="margin-left: 40px;">&nbsp;</div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </tbody>
</table>
            <td valign="top">
		<br>
		<a href="./ManPrepServerext.php"><img src="./ImmTemplate/flecheg.gif" border='0'></a>
		<a href="./Manuale.php"><small>Indice</small></a>
	    </td>
<?php
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
