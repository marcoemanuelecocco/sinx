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
<table cellspacing="1" cellpadding="1" border="0" width="90%" align="center">
    <tbody>
        <tr>
            <td width="80%"><span style="font-weight: bold; color: rgb(255, 153, 0);">&nbsp;<span style="color: rgb(51, 102, 255);">Associazione - Manuale di Sinx</span></span><br/><hr>
            </td>
    <td valign="top" align="center"><br>

      <a href="./Manuale.php"><small>Indice</small></a>
      <a href="./ManAnagrafica.php"><img src="./ImmTemplate/fleched.gif" border='0'></a><br>
    </td>
        </tr>
        <tr>
            <td><b>Gestione dati dell'Associazione</b></td>

            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="vertical-align: top;"><font size="2">Dal Men&ugrave Associazione si gestiscono tutti i dati relativi all'Associazione stessa.<br>Dal men&ugrave &egrave possibile accedere al sito web ed alla webmail se correttamente impostati.<br>In 'Dati Associazione' &egrave possibile visualizzare e modificare i dati dell'Associazione compresi i sopracitati sito internet e webmail, mentre il logo dell'Associazione, se non &egrave stato impostato durante l'installazione, bisogna importarlo all'interno della cartella "Immagini" utilizzando un client ftp e ponendo le seguenti attenzioni:<li>Il file deve essere nominato 'logo' con estensione 'png'</li><li>L'altezza ideale del logo &egrave di 60px mentre la larghezza verr&agrave ridimensionata in automatico</li><li>Il file del logo non dovr&agrave superare i 30Kb</li><br>L'ultima voce del men&ugrave Associazione riguarda il backup dei dati; premendo il pulsante 'Backup' si avvier&agrave la procedura per il salvataggio dei dati, mentre in 'Ripristino dati' &egrave possibile ripristinare i dati in caso di necessit&agrave.<br>A seconda della dimensione del file di recupero, ci vogliono alcuni istanti perch&egrave l'operazione venga eseguita, fare attenzione a non interrompere la procedura di recupero
</td>
<td>&nbsp;</td>
        </tr>


    </tbody>
</table>
<?php
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
