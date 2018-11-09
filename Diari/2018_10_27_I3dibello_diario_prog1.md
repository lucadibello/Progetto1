# Progetto 1 | Diario di lavoro - 27.10.2018

##### Luca Di Bello

### Canobbio, 27.10.2018

## Lavori svolti

Oggi ho deciso di continuare il lavoro da casa per mettere apposto certi errorini quà e là nel codice.
Ho aggiunto la funzionalità al pulsante "Cancella" nella pagina <i>register.php</i>, adesso quando cliccato cancella tutti i dati contenuti nel form, reimposta i colori (magari il campo era già stato validato, se non si reimposta resterebbe verde o rosso), e tramite il framework che utilizzo (MaterializeCss) faccio un refresh dei campi del form per resettare la posizione del label. Ecco il codice:

```javascript
$("#cancellaButton").click(function() {
  var $inputs = $("#registerForm :input");

  var values = {};
  $inputs.each(function() {
    values[this.name] = $(this).val("");
    //RESET COLORS
    values[this.name].css("borderBottom", "1px solid #9e9e9e");
    values[this.name].css("boxShadow", "none");
    M.updateTextFields();
  });

  console.log("[INFO] Clean done!");
});
```

Dopo aver aggiunto questa feature ho corretto il validatore del campo "data di nascita" all'interno dei validatori (sia quello lato client sia quello lato server) nei file <i>validator.js</i> e <i>validator.php</i>. Ho aggiunto il controllo sul "senso del dato", quindi ho modificato il codice in modo che se l'anno inserito ha un formato giusto ma ha una data più vecchia di 120 anni oppure ha una data non ancora passata (quindi con un anno maggiore dell'anno corrente) il validatore ritorna il valore "false".
Codice del validatore lato client:

```javascript
dataNascita(date) {
    var dateReg =/^\d{4}[-]\d{2}[-]\d{2}$/;
    if (date.length > 0) {
        if(dateReg.test(date)){
            //VALID FORMAT
            //CHECK DATA CONFORMITY
            var nowDate = new Date();
            var dateObj = new Date(date);
            if(dateObj.getFullYear() < nowDate.getFullYear() && dateObj.getFullYear() > (nowDate.getFullYear() - 120)){
                return true;
            }
            else{
                //BORN AFTER CURRENT YEAR OR BORN MORE THEN 120 YEARS AGO
                return false;
            }
        }
        else{
            //INVALID FORMAT
            return false;
        }
    }
    return false;
}
```

Codice del validatore lato server:

```php
if(strlen($data) > $GLOBALS["global_length_min"] && strlen($data) < $GLOBALS["global_length_max"]){
        if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$data) == true){
            //VALID FORMAT
            $currentYear = date('Y');
            $postYear = date('Y',strtotime($data));

            if($postYear < $currentYear && $postYear > ($currentYear - 120)){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            //INVALID FORMAT
            return false;
        }
    }
    return false;
```

| Orario        | Lavoro svolto                               |
| ------------- | ------------------------------------------- |
| 13:15 - 15:00 | Finito CSVisualizer.php e register_user.php |
| 15:00 - 16:30 | Testing e fix di bug                        |

## Problemi riscontrati e soluzioni adottate

Nessun problema

## Punto della situazione rispetto alla pianificazione

Sto svolgendo più operazioni in parallelo, sono comunque al passo con il mio gantt preventivo

## Programma di massima per la prossima giornata di lavoro

Terminare documentazione
