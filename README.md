# AperiMeet
Progetto di ltw 2021-2022. 
Happy-hour per studenti romani

Aperimeet è un sito web per studenti universitari delle principali università di Roma, ideato per organizzare o partecipare ad aperitivi.

Il sito è stato realizzato utilizzando html, php (lato server), css, javascript e jquery (per i pop-up).

Il progetto è suddiviso internamente in sottocartelle contenenti ognuna una pagina del sito web, oltre ai file necessari per l’utilizzo di bootstrap.

La prima cartella “login”, contiene i seguenti file:
login.html: tramite cui si può accedere al proprio account o un nuovo utente può effettuare la registrazione,
login.php: gestisce la connessione con il database. Dopo il click del tasto “login”, vengono effettuati alcuni controlli al fine di verificare che email e password corrispondano ad un utente già registrato nella base di dati. Nel caso in cui la query generata non restituisca alcun risultato, l’utente sarà reinviato in registrazione.html. Se invece i dati inseriti sono corretti, l'utente viene reindirizzato a home.html e la sua email viene salvata attraverso una session.
style.css: foglio di stile,
function.js: contiene le funzioni javascript,
e infine le immagini utilizzate all’interno della pagina html.

Nella cartella “registrazione”:
registrazione.html: contiene un form per la registrazione di un nuovo utente
compilato.html: è una pagina che viene mostrata nel momento in cui si invia correttamente il form di registrazione e che notifica l’avvenuto invio di una mail da parte di aperimeet@gmail.com al fine di poter verificare l’identità.
registrati.html: è la pagina a cui vieni reindirizzato dal link presente nella mail di conferma per poter poi salvare i dati grazie ai cookies.
registrazione.php: dopo aver effettuato la connessione con il database, salva i dati inseriti nel form (attraverso l’utilizzo dei cookies) al momento dell’invio.                                              
valida.php: dopo aver effettuato la connessione con il database, salva i dati precedentemente raccolti dai cookies all’interno del database nella tabella utente, alla pressione del bottone presente in compilato.html.
style.css: foglio di stile,
function.js: contiene le funzioni javascript,
e infine le immagini utilizzate all’interno della pagina html.

Nella cartella “home”:
home.html: all’interno della pagina è stato inserito un frame che mostra il file home.php.
home.php: dopo aver effettuato la connessione con il database, stampa a schermo una tabella per ogni richiesta disponibile effettuata dagli altri utenti, contenente il nome e la foto del profilo di chi ha generato l’evento e i dettagli dell'evento stesso. Alla pressione del bottone “prenota”, la pagina viene refreshata e l’utente si prenota per l’evento selezionato. Sono gestite anche le funzioni per l’eliminazione delle richieste in caso di cancellazione o fine dell’evento. 
style.css: foglio di stile,
e infine le immagini utilizzate all’interno della pagina html.

Nella cartella “mieprenotazioni”:
mieprenotazioni.html: è la pagina in cui vengono visualizzate le richieste generate dall’utente stesso e quelle a cui si è prenotato. Come in “home.html” all’ interno della pagina è stato inserito un frame che mostra il file “mieprenotazioni.php”.
mieprenotazioni.php: dopo aver effettuato la connessione con il database, stampa a schermo una tabella per ogni prenotazione effettuata dall’utente stesso, contenente il nome e la foto del profilo di chi ha generato l’evento e i dettagli dell'evento stesso. Alla pressione del bottone “cancella prenotazione”, la pagina viene refreshata e la prenotazione viene rimossa dal database. Sono gestite anche le funzioni per l’eliminazione delle richieste in caso di cancellazione o fine dell’evento. 
style.css: foglio di stile.
e infine le immagini utilizzate all’interno della pagina html.

Nella cartella “prenotazione”:
prenotazione.html: è la pagina contenente il form per generare un nuovo evento. Nel form è presente una mappa di Google API in cui vi è una search bar a riempimento automatico per la ricerca dei locali. Una volta selezionato il locale le text-area “nome” e “indirizzo” vengono automaticamente completate in maniera non editabile. In seguito posso inserire un numero massimo di partecipanti, l’orario, la data e una descrizione. 
generaRichiesta.php: dopo aver effettuato la connessione con il database, all’invio del form salva i dati della prenotazione nella tabella “richiesta” all’interno del database.
style.css: foglio di stile,
function.js: contiene le funzioni javascript,
e infine le immagini utilizzate all’interno della pagina html.

Nella cartella “profilo”: 
cartella immagini: qui vengono raccolte tutte le immagini di profilo degli utenti.
profilo.php: dopo aver effettuato la connessione con il database, vengono mostrati all’interno della pagina i dati dell’utente e la foto profilo. La foto inizialmente è predefinita ma l’utente può sostituirla. In questo modo la nuova immagine verrà salvata al posto della precedente all’interno della cartella immagini, e verrà attribuito al campo “immagine” della tabella “utente” nella base di dati, il percorso della nuova immagine. Inoltre, l’utente ha la possibilità di contattare l’assistenza, effettuare il logout o eliminare l’account (assistenza, logout ed elimina account sono bottoni che aprono dei pop-up implementati utilizzando JQuery). Una volta premuto il tasto elimina account si viene reindirizzati ad eliminato.html.
eliminato.html: la pagina mostra un avviso al fine di notificare l'avvenuta eliminazione dell’utente e reindirizza al login.
style.css: foglio di stile,
function.js: contiene le funzioni javascript,
e infine le immagini utilizzate all’interno del file html e del file php.
Oltre a queste cartelle sono presenti i file utili per impostare l’icona delle pagine del sito.

DATABASE:
-tabella utente:  
email (primary key)
nome
cognome
password
immagine
-tabella richiesta: 
email 
locale
orario
partecipanti
data
prenotato
prenotati
descrizione

Francesco La Via, Niccolò Marchi, Sara Alfano.![aperimeet  logo](https://user-images.githubusercontent.com/102963704/161534845-a7d9ecef-3088-43aa-8663-3851ce586d0c.jpg)
