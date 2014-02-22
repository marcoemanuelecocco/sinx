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
            <td><span style="font-weight: bold; color: rgb(255, 153, 0);">&nbsp;<span style="color: rgb(51, 102, 255);">Moduli - Manuale di Sinx</span></span><br/><hr>
            </td>

        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><span style="font-weight: bold;"><font size="2">&nbsp;Compilazione e scaricamento Moduli</span><br><br/>
            </td>

            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="vertical-align: top;"/>
            <td style="vertical-align: top;"><font size="2">All'interno del programma &egrave possibile sfruttare ancuni moduli precompilati che verranno progressivamente implementati nel tempo.<br><br>Per la compilazione dei moduli ci sono due possibilit&agrave: nel primo caso vengono inseriti i campi richiesti, si selezione il modulo dalla lista dei moduli a disposizione, quindi si preme il pulsante "invia".<br>Il modulo viene precompilato con intestazione dell'associazione e pronto da stampare sfruttansdo il comando di stampa del proprio browser.<br><br>In alternativa &egrave possibile aprire i moduli precompilati in pdf cliccando sul link "Files e Immagini" situato sotto il pulsante "Invia".<br>
Si aprir&agrave una schermata con la lista dei moduli caricati nel programma.<br>
I moduli in pdf risiedono nella cartella Download dove &egrave possibile aggiungere i propri moduli creati utilizzando il modulo files e immagini presente con il pulsante omonimo.<br>
<h4>Calendario Appuntamenti</h4>
In Sinx &egrave possibile gestire gli appuntamenti dell'Associazione.<br><br>
La schermata principale si presenta con il calendario del mese attuale.<br>
Se ci sono degli appuntamenti gi&agrave registrati, i giorni sono evidenziati con colore arancio; per visualizzare l'appuntamento, &egrave sufficiente premere sopra al numero del giorno.<br>
Si aprir&agrave una schermata con la tipica formattazione di Sinx dove &egrave possibile cancellare l'evento, modificare l'evento ed in fondo visualizzare l'evento o la lista eventi di quel determinato giorno.<br><br>
La voce modifica, oltre a modificare un evento esistente, permette di aggiungerne uno nuovo; sar&agrave sufficiente in questo caso, premere il pulsante "nuovo" al posto di "modifica".<br><br>
Dalla schermata principale del calendario, nel caso in cui non ci siano appuntamenti registrati, i giorni del calendario hanno la stessa colorazione di un qualsiasi link; premendo su uno di essi, si aprir&agrave la schermata per registrare un nuovo appuntamento con la data preimpostata.<br>
In alto a sinistra del calendario &egrave possibile scorrere i vari mesi dell'anno.<br>
<h4>E-Mail</h4>
Da Sinx l'Associazione pu&ograve spedire e tenere archiviate le mail spedite.<br>Prima di inviare le mail &egrave necessario inserire l'indirizzo mail dell'Associazione nel file email.php di Sinx.<br><br>Per farlo bisogna aprire il file con un editor di testo o editor php e scorrere il file fin dove si trova il commento "QUI BISOGNA INSERIRE L'INDIRIZZO DELL'ASSOCIAZIONE sostituendo info@mailassociazione.it" ed eseguire esattamente quello che &egrave scritto nel commento.<br><br>Sinx da la possibilit&agrave di decidere se spedire una mail inserendo l'indirizzo manualmente, oppure utilizzando uno degli indirizzi registrati in anagrafe; in pi&ugrave permette un invio multiplo a tutti gli associati o solamente al direttivo.<br><br>
<b>I riceventi nell'invio multiplo non visualizzano gli indirizzi altrui</b><br><br>
Se si vuole, &egrave possibile salvare la mail vistando il check "Salva Mail"; la mail verr&agrave registrata nel database e aggiunta nella lista visualizzabile premendo il pulsante sottostante.<br>
<h4>Gestione Utenti</h4>
Sinx &egrave dotato di un sistema di gestione utenti a due livelli: utente amministratore e utente limitato.<br>L'utente admin ha i permessi in qualsiasi punto del programma, mentre l'utente limitato viene bloccato e reindirizzato nella pagina principale se tenta un accesso in aree non consentite.<br>Lo scopo di queste limitazioni &egrave quello di poter dare la possibilit&agrave di utilizzo del software anche ad utilizzatori con minori responsabilit&agrave, evitando, per&ograve un utilizzo scorretto o errato da parte di questi ultimi.<br>L'utente amministratore &egrave l'unico che ha i permessi di aggiungere utenti e pu&ograve decidere a quale livello possono operare.<br>Le password degli utenti vengono criptate dal software e non possono essere modificate.<br>
<h4>Files ed immagini</h4>
E' possibile aggiungere e visualizzare files o immagini in Sinx utilizzando questo modulo; accedendovi ci saranno gi&agrave alcuni files utili per l'Associazione e le immagini utilizzate di default da sinx.<br>Le immagini da caricare possono essere di tipo gif, jpg, png, ma non possono superare i 30Kbyte e sono dedicate principalmente all'assegnazione dei soci.<br>Una volta caricata l'immagine bisogna assegnarla all'Associato utilizzando la funzione 'Modifica' presente nella scheda associato.<br>I files sono principalmente moduli precompilati e possono essere di tipo pdf o txt della dimensione massima di 1Mb; premendo il pulsante in basso 'files e immagini', si accede alla lista di tutto quello che &grave stato caricato ed &grave possibile aprirlo semplicemente cliccandoci sopra.</td>

        </tr>
    </tbody>
</table>
    <td valign="top"><br>
      <a href="./ManContPnota.php"><img src="./ImmTemplate/flecheg.gif" border='0'></a>
      <a href="./Manuale.php"><small>Indice</small></a>
     

    </td>
<?php
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
