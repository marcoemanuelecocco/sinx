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
            <td><span style="font-weight: bold; color: rgb(255, 153, 0);">&nbsp;<span style="color: rgb(51, 102, 255);">Anagrafica - Manuale di Sinx</span></span><br/><hr>
            </td>

        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><span style="font-weight: bold;"><font size="2">&nbsp;Inserimento e ricerca anagrafiche</span><br><br/>
            </td>

            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="vertical-align: top;"/>
            <td style="vertical-align: top;"><font size="2">Le prime voci del men&ugrave riguardano l'inserimento e la ricerca dell'anagrafica.<br>Questa &egrave divisa in:<ul type="circle">
  <li>Anagrafica Fondatori</li>
  <li>Anagrafica Associati</li>
  <li>Altri </li>
</ul>Per Fondatori si intendono quelle figure principali dell'Associazione quali il presidente, i revisori dei conti ecc.<br>Gli associati possono essere divisi anche questi per categorie come per esempio: gli ordinari, i sostenitori ecc., voci impostabili dal men&ugrave 'Specifiche' -> 'Tipologia Associati'<br>Infine i contatti 'Altri' riguarda quelle persone che in qualche modo hanno a che vedere con le attivit&agrave dell'Associazione come possono essere gli sponsor, ospiti di convegni ecc.<br><br>
<b>Ricerca Associati</b><br><br>
Premendo 'Cerca' dal men&ugrave 'Anagrafica', si accede alla schermata di ricerca.<br>Anche questa &egrave suddivisa in Fondatori, Associati, Contatti utili; ed &egrave possibile effettuarla tramite nome per tutte e tre le categorie, tramite funzione per la categoria dei fondatori e tramite tipologia di associato per gli associati.<br>Nella ricerca tramite nome &egrave possibile avere il listato completo ordinato per nome se nella casella combinata non si specifica alcuna lettera dell'alfabeto, mentre, se viene selezionata una lettera, vengono visualizzati esclusivamente i nomi che iniziano per quella lettera.<br><br>Infine & possibile effettuare una ricerca delle ricevute emesse, utile per verificare, ad esempio, il tesseramento degli associati.<br>Per la ricerca &egrave possibile utilizzare il carattere speciale '%'; ad esempio:<li>%descr% - Ricerca tutto ciò che comprende 'descr' e quello che c'è prima e dopo</li><li>Rob% - Ricerca tutte le parole che iniziano per Rob e quello che c'è dopo</li><li>%2012 - Ricerca tutte le date dell'anno 2012</li><br>La ricerca non tiene conto della differenza tra maiuscole e minuscole.<br><br>
<b>Rubrica</b><br><br>
La voce rubrica %egrave utile per visualizzare i dati principali degli Associati, utile sopratutto per recuperare un numero di telefono o indirizzo.<br>Questa ordina i nomi alfabeticamente proprio come una rubrica cartacea.<br><br>
<b>Libro Soci</b><br><br>
Dal men&ugrave Anagrafe &egrave possibile visualizzare e stampare il libro soci dell'Associazione.<br>Nel libro soci vengono visualizzati i nominativi dei soli soci attivi, ovvero, regolarmente tesserati.<br>E' possibile visualizzare e modificare la voce 'socio attivo' dal men&ugrave 'Anagrafica' -> 'Cerca'
 </td>

        </tr>
    </tbody>
</table>
    <td valign="top"><br>
      <a href="./ManAssociaz.php"><img src="./ImmTemplate/flecheg.gif" border='0'></a>
      <a href="./Manuale.php"><small>Indice</small></a>
      <a href="./ManContPnota.php"><img src="./ImmTemplate/fleched.gif" border='0'></a><br>

    </td>
<?php
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
