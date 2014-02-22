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
            <td><span style="font-weight: bold; color: rgb(255, 153, 0);">&nbsp;<span style="color: rgb(51, 102, 255);">Link esterni, e-mail - Manuale di Sinx</span></span><br/><hr>
            </td>

        </tr>
        <tr>

            <td>&nbsp;</td>
            <td><font size="2">&nbsp;<b>Preparazione dei link esterni ed e-mail</b><br/>
            <br/>
            <meta http-equiv="CONTENT-TYPE" content="text/html; charset=utf-8"/>
<style type="text/css">
            </style>
Nel men&ugrave a sinistra, a partire dalla versione 0.60 di Sinx for Association, sono presenti dei link che permettono di collegarsi ad altri siti esterni al software.<br>Per inserire i link &egrave necessario inserire l'url nel file "menusx.inc".<br>All'interno del file, le righe da modificare sono precedute da alcune righe di commento che spiegano dove e come inserire l'url.<br><br>
Per fare in modo che, spedendo la mail dal software, l'indirizzo del mittente sia quello dell'associazione; bisogna inserire l'indirizzo all'interno del file: email.php.<br>Anche in questo caso &egrave presente un commento che precede la riga da modificare.
            <br/>

            <div style="margin-left: 40px;">&nbsp;</div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </tbody>
</table>
            <td valign="top"><br>
		<a href="./ManIntPagStampa.php"><img src="./ImmTemplate/flecheg.gif" border='0'></a>
		<a href="./Manuale.php"><small>Indice</small></a>
		<a href="./ManUtenti.php"><img src="./ImmTemplate/fleched.gif" border='0'></a>
	    </td>
<?php
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
