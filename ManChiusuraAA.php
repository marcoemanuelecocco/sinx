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
<table cellspacing="1" cellpadding="1" border="0" width="80%">
    <tbody>
        <tr>
            <td></td>
            <td><span style="font-weight: bold; color: rgb(255, 153, 0);">&nbsp;<span style="color: rgb(51, 102, 255);">Contabilit&agrave: Attivit&agrave - Manuale di Sinx</span></span><br/><hr>
            </td>

        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><span style="font-weight: bold;"><font size="2">&nbsp;Chiusura anno associativo</span><br><br/>
            </td>

            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="vertical-align: top;"/>
            <td style="vertical-align: top;"><font size="2">Dalla versione 0.93.6 di sinx &egrave stato introdotto il modulo di chiusura anno sociale, presente nel men&ugrave con l'omonimo pulsante di colore rosso nella sezione di contabilit&agrave.<br><br>
Premendo il pulsante l'utente si trova nella schermata che permette, tramite altri due pulsanti, di chiudere l'anno associativo; il primo pulsante crea una versione salvabile e stampabile del libro soci, e di tutta la contabilit&agrave comprendente prima nota, ricevute, fatture, conto economico e stato patrimoniale.<br>
Premendo il secondo tasto si ottiene l'azzeramento della contabilit&agrave e di tutti gli indici contabili permettendo quindi la ripresa dell'anno contabile da zero.<br><br>
Una volta effettuato l'avvio del nuovo anno associativo, l'utente deve preoccuparsi di inserire le voci di apertura  dello Stato Patrimoniale, stato patrimoniale e prima nota, per esempio, se in prima nota, alla chiusura dell'anno associativo c'&egrave un attivo di 1000,00 euro, l'utente deve inserire come prima voce in prima nota il disavanzo di 1000,00 euro da anno precedente, quindi continuare con le nuove voci. </td>

        </tr>
    </tbody>
</table>
            <td valign="top"><br>
		<a href="./ManMail.php"><img src="./ImmTemplate/flecheg.gif" border='0'></a>
		<a href="./Manuale.php"><small>Indice</small></a>
      <hr>
	    </td>
<?php
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
