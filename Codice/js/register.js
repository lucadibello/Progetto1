//--> La formattazione è stata fatta automaticamente dall mio IDE chiamto "Visual Studio Code"

//Creo un oggeto di tipo validator, il quale servirà per la validazione dei dati
var checker = new validator();

/**
 * Questo metodo si occupa di aggiungere gli eventi keyDown e keyUp su tutti gli input del form, questo per avere
 * una validazione di essi in tempo reale.
 * Oltre a questo aggiunge la funzione di cancellazione dei dati al bottone 'cancella'.
 */
function addListeners() {
    //Aggiunge evento keydown ai campi
    $("#first_name").keydown(function () {
        manage(this, "nome");
    });
    $("#last_name").keydown(function () {
        manage(this, "cognome");
    });
    $("#data_nascita").keydown(function () {
        manage(this, "data");
    });
    $("#email").keydown(function () {
        manage(this, "email");
    });
    $("#citta").keydown(function () {
        manage(this, "citta");
    });
    $("#cap").keydown(function () {
        manage(this, "cap");
    });
    $("#via").keydown(function () {
        manage(this, "via");
    });
    $("#numero_civico").keydown(function () {
        manage(this, "civico");
    });
    $("#professione").keydown(function () {
        manage(this, "work");
    });
    $("#hobby").keydown(function () {
        manage(this, "hobby");
    });
    $("#phone").keydown(function () {
        manage(this, "phone");
    });


    //Aggiunge evento keyup ai campi
    $("#first_name").keyup(function () {
        manage(this, "nome");
    });
    $("#last_name").keyup(function () {
        manage(this, "cognome");
    });
    $("#data_nascita").keyup(function () {
        manage(this, "data");
    });
    $("#email").keyup(function () {
        manage(this, "email");
    });
    $("#citta").keyup(function () {
        manage(this, "citta");
    });
    $("#cap").keyup(function () {
        manage(this, "cap");
    });
    $("#via").keyup(function () {
        manage(this, "via");
    });
    $("#numero_civico").keyup(function () {
        manage(this, "civico");
    });
    $("#professione").keyup(function () {
        manage(this, "work");
    });
    $("#hobby").keyup(function () {
        manage(this, "hobby");
    });
    $("#phone").keyup(function () {
        manage(this, "phone");
    });


    //Questa parte di codice scritta sotto serve per far funzionare il pulsante della cancellazione dei campi
    $("#cancellaButton").click(function () {
        //Prende tutti gli input contenuti nel form
        var $inputs = $('#registerForm :input');
        var values = {};

        //Cicla ogni input del form 
        $inputs.each(function () {
            //Imposta il loro valore (testo) a "" (ovvero nessun testo, saranno vuoti)
            values[this.name] = $(this).val("");

            //Imposta i colori di default
            values[this.name].css("borderBottom", "1px solid #9e9e9e");
            values[this.name].css("boxShadow", "none");
        });
        //Fa un update di tutti i campi per resettare le animazioni
        M.updateTextFields()

        console.log("[INFO] Clean done!")
    });
}

/**
 * Questo metodo fa visualizzare un messaggio a schermo che specifica quale campo contiene un valore non valido.
 * Fa questo appoggiandosi al framework che utilizzo (Materialize) e  al metodo 'manage' il quale 
 * ritorna lo 'stato di validità del dato.
 */
function checkAnyError() {
    var changed = false;

    if (manage(document.getElementById('first_name'), "nome") == false) {
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span> Campo nome</span>';
        M.toast({
            html: toastHTML
        });
        changed = true;
    }
    if (manage(document.getElementById('last_name'), "cognome") == false) {
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span> Campo cognome</span>';
        M.toast({
            html: toastHTML
        });
        changed = true;
    }
    if (manage(document.getElementById('data_nascita'), "data") == false) {
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span> Campo Data</span>';
        M.toast({
            html: toastHTML
        });
        changed = true;
    }
    if (manage(document.getElementById('email'), "email") == false) {
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span> Campo Email</span>';
        M.toast({
            html: toastHTML
        });
        changed = true;
    }
    if (manage(document.getElementById('citta'), "citta") == false) {
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span> Campo Città</span>';
        M.toast({
            html: toastHTML
        });
        changed = true;
    }
    if (manage(document.getElementById('cap'), "cap") == false) {
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span> Campo CAP</span>';
        M.toast({
            html: toastHTML
        });
        changed = true;
    }
    if (manage(document.getElementById('via'), "via") == false) {
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span> Campo Via</span>';
        M.toast({
            html: toastHTML
        });
        changed = true;
    }
    if (manage(document.getElementById('numero_civico'), "civico") == false) {
        var toastHTML = '<span style="color:red;font-weight:bold;margin-right:10px;">Errore: </span><span> Campo Numero civico</span>';
        M.toast({
            html: toastHTML
        });
        changed = true;
    }
    if (manage(document.getElementById('phone'), "phone") == false) {
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span> Campo Telefono</span>';
        M.toast({
            html: toastHTML
        });
        changed = true;
    }

    if (changed) return false;

    return true;
}

//PARAMS
const global_length_min = 0;
const global_length_max = 50;
const work_length_max = 500;
const hobby_length_max = 500;

function manage(obj, selector) {
    var status = false;

    if (selector == "data") {
        status = checker.dataNascita(obj.value);
    } else {
        //Rimuove caratteri che potrebbero essere dannosi per il sistema

        //Rimuovo tutti i doppi spazi con uno spazio singolo (questo in tempo reale grazie al metodo 'addListeners()')
        obj.value = obj.value.replace(/\s\s+/i, ' ');

        /*
         * Rimuovo il carattere ';'. Questo perchè esso è il separatore utilizzato nel file CSV, se 
         * utilizzato quando si andrebbe a leggere il file csv si avrebbero diversi problemi.
         */
        obj.value = obj.value.replace(/[;]+/i, '');

        //Cambia il colore a seconda di cosa ritorna il validator
        if (selector == "nome") {
            status = checker.nome(obj.value, global_length_min, global_length_max);
        } else if (selector == "cognome") {
            status = checker.cognome(obj.value, global_length_min, global_length_max);
        } else if (selector == "cap") {
            status = checker.cap(obj.value);
        } else if (selector == "citta") {
            status = checker.citta(obj.value)
        } else if (selector == "email") {
            status = checker.email(obj.value)
        } else if (selector == "hobby") {
            status = checker.hobby(obj.value, global_length_min, hobby_length_max);
        } else if (selector == "civico" || selector == "numeroCivico") {
            status = checker.numeroCivico(obj.value);
        } else if (selector == "work") {
            status = checker.work(obj.value, global_length_min, work_length_max);
        } else if (selector == "via") {
            status = checker.via(obj.value, global_length_min, global_length_max);
        } else if (selector == "phone") {
            status = checker.phone(obj.value);
        }
    }

    if (status) {
        //Se il dato è valido (Verde)
        obj.style.borderBottom = "1px solid #4CAF50";
        obj.style.boxShadow = "0 1px 0 0 #4CAF50";
    } else {
        //Se il dato non è valido (Rosso)
        obj.style.borderBottom = "1px solid #FF0000";
        obj.style.boxShadow = "0 1px 0 0 #FF0000";
    }
    return status;
}

console.log("[INFO] Loaded register.js for visual local validation");