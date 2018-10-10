# Progetto 1 | Diario di lavoro - 10.10.2018
##### Luca Di Bello
### Canobbio, 10.10.2018

## Lavori svolti
Durante la lezione di oggi ho finito di sviluppare la classe chiamata "Validator.js" la quale si occupa della validazione dei dati. Essa valida i dati passati tramite dei regex.
Dei metodi della classe(per esempio il metodo 'nome' o 'cognome') permettono anche di impostare una lunghezza minima e massima. Tutti i metodi ritornano "true" se il valore passato è valido e "false" se il valore non è valido.
Oltre a questo controllo verranno effettuati anche dei controlli in PHP.

|Orario        |Lavoro svolto                 |
|--------------|------------------------------|
|13:15 - 14:45  | Sviluppo e test classe |

##  Problemi riscontrati e soluzioni adottate
Avevo dei problemi con la classe in JS, davanti ai metodi delle classi non bisogna mettere la parola chiave <code>function</code> ma basta scrivere il nome del metodo.
ESEMPIO:
<code>nome(text, lengthMin, lengthMax){}</code>

##  Punto della situazione rispetto alla pianificazione
Ho svolto delle operazioni prima di altre, sono comunque al passo con il Gantt.

## Programma di massima per la prossima giornata di lavoro
Creare e finire la classe registrazione.js che si occuperà di mostrare all'utente quali dati sono validi e quali non lo sono.