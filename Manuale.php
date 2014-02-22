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
      <h3>Manuale Sinx</h3>
<table cellspacing="1" cellpadding="5" border="0" align="left">
    <tbody>
	<tr>
	<td><i>Installazione del software<br></i></td>
	<tr><td><hr></td></tr>
	</tr>
        <tr>
	<td><img src="./ImmTemplate/doc.png"> - <a href="./ManPrepServer.php">Preparazione del server (Installazione locale)</a></td>
	</tr>
        <tr>
	<td><img src="./ImmTemplate/doc.png"> - <a href="./ManPrepServerext.php">Preparazione del server (Installazione remota)</a></td>
	</tr>
	<tr>
	<td><img src="./ImmTemplate/doc.png"> - <a href="./ManUtenti.php">Note sugli utenti</a></td>
	</tr>
</table>
<table cellspacing="1" cellpadding="5" border="0" align="left">
	<tr>
	<td><i>Uso del software<br></i></td>
	</tr>
	<tr><td><hr></td></tr>
	<tr>
	<td><img src="./ImmTemplate/doc.png"> - <a href="./ManAssociaz.php">Associazione</a></td>
	</tr>
	<tr>
	<td><img src="./ImmTemplate/doc.png"> - <a href="./ManAnagrafica.php">Anagrafica</a></td>
	</tr>
	<tr>
	<td><img src="./ImmTemplate/doc.png"> - <a href="./ManContPnota.php">Contabilit&agrave</a></td>
	</tr>
	<tr>
	<td><img src="./ImmTemplate/doc.png"> - <a href="./ManModulistica.php">Gestione</a></td>
	</tr>

    </tbody>
</table>
<?php
include('./menusx.inc');
include('./botton.inc');
} else {
header('Location: index.php');
}
?>
