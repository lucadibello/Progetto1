# Progetto 1 | Diario di lavoro - 19.10.2018

##### Luca Di Bello

### Canobbio, 19.10.2018

## Lavori svolti

Durante la lezione odierna ho iniziato a sviluppare la funzione "correggi" della pagina <i>controllo.php</i>.
Per l'invio dei dati alla pagina di registrazione (<i>register.php</i>) pensavo di adottare la soluzione consigliata ed adottata da molti: creare un form con campi invisibili e fare una richesta post alla pagina di registrazione per poi leggerne i dati. Io invece ho deciso di creare comunque un form invisibile, il quale invia soltanto alla pagina di registrazione un flag <i>restore</i> (il quale serve per far capire alla pagina che voglio riempire automaticamente i campi).
Prima di inviare effettivamente il flag alla pagina chiamo una funzione nella pagina <i>controllo.php</i> la quale si occupa di creare i cookie necessari per "trattenere" le informazioni inviate prima dall'utente. Infatti non faccio altro che quando la pagina legge che esiste il flag <i>restore</i> va a controllare se i cookie esistono ancora (hanno un tempo di scadenza, nel mio caso 60 secondi) e se ci sono ne prende i dati e li imposta nei vari campi.

| Orario        | Lavoro svolto                          |
| ------------- | -------------------------------------- |
| 13:15 - 15:30 | Creazione programma per invio dei dati |
| 15:30 - 16:30 | Creazione cookie e messo apposto bug   |

## Problemi riscontrati e soluzioni adottate

Quando si inserisce del testo all'interno di un cookie, se esso contiene degli spazi essi vengono sostituiti dal carattere '+'. Per esempio se io in un cookie il testo <code>ciao mi chiamo luca</code> nel cookie il testo sarà effettivamente <code>ciao+mi+chiamo+luca</code>. Tramite la funzione di php <code>urlencode()</code> il carattere '+' viene tradotto in "%20". Durante la prossima lezione cercherò di mettere apposto.

## Punto della situazione rispetto alla pianificazione

Sto svolgendo più operazioni in parallelo, sono comunque al passo con il mio gantt preventivo

## Programma di massima per la prossima giornata di lavoro

Mettere apposto errori relativi ai cookie.
