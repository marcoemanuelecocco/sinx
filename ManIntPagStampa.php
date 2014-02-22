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
            <td><span style="font-weight: bold; color: rgb(255, 153, 0);">&nbsp;<span style="color: rgb(51, 102, 255);">Intestazione pagine di Stampa - Manuale di Sinx</span></span><br/><hr>
            </td>

        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><span style="font-weight: bold;"><font size="2">&nbsp;Modifica Intestazione pagina di stampa</span><br><br/>
            </td>

            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="vertical-align: top;"/>
            <td style="vertical-align: top;"><font size="2">Tutte le pagine predisposte per la stampa hanno in automatico l'intestazione dell'Associazione;<br/>
            E' possibile personalizzare il logo e i relativi recapiti:<br/>
            Aprire il file <span style="font-weight: bold;">Intestazione.html</span> e sostituire i dati provvisori con quelli dell'Associazione.<br/>
            Il logo deve essere inserito nella cartella Immagini e nominarlo &quot;<span style="font-weight: bold;">logo</span>&quot; con estensione png.<br/><br/>
            E' possibile modificare il nome e l'estensione del logo sempre dal file <span style="font-weight: bold;">Intestazione.html</span>.<br/>
            <br/>
            Si consiglia di non inserire immagini inferiori a 60x60 px</td>
        </tr>
    </tbody>
</table>
            <td valign="top"><br>
		<a href="./ManPrepServer.php"><img src="./ImmTemplate/flecheg.gif" border='0'></a>
		<a href="./Manuale.php"><small>Indice</small></a>
		<a href="./ManLinkExt.php"><img src="./ImmTemplate/fleched.gif" border='0'></a>
	    </td>
<?php
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
