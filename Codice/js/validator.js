class validator {

    constructor() {
        console.log("[INFO] Loaded validator.js for local validation");
    }

    nome(text, lengthMin, lengthMax) {
        if (text.length > lengthMin && text.length < lengthMax) {
            var onlyLetters = /^[a-z]+$/i;
            return onlyLetters.test(text);
        }
        return false;
    }

    cognome(text, lengthMin, lengthMax) {
        if (text.length > lengthMin && text.length < lengthMax) {
            var onlyLetters = /^[a-z ]+$/i;
            return onlyLetters.test(text);
        }
        return false;
    }

    via(text, lengthMin, lengthMax) {
        if (text.length > lengthMin && text.length < lengthMax) {
            var onlyLetters = /^[a-z ]+$/i;
            return onlyLetters.test(text);
        }
        return false;
    }

    dataNascita(date) {
        var dateReg =/^\d{4}[-]\d{2}[-]\d{2}$/;
        if (date.length > 0) {
            return dateReg.test(date);
        }
        return false;
    }

    email(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (email.length > 0) {
            return re.test(email);
        }
        return false;
    }

    citta(city) {
        var re = /^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/;
        if (city.length > 0) {
            return re.test(city);
        }
        return false;
    }

    cap(cap) {
        var re = /^[0-9]{4,5}$/;
        return re.test(cap);
    }

    phone(number){
        if(number.length > 0){
            var re = /^(\+|00)+[0-9]{11}$/;
            return re.test(number);
        }
        return false
    }

    numeroCivico(numeroCivico) {
        var re = /^[0-9]+((|[a-zA-Z]){1})$/;
        if (numeroCivico.length > 0) {
            return re.test(numeroCivico);
        }
        return false;
    }

    work(text, lengthMin, lengthMax) {
        if (text.length >= lengthMin && text.length < lengthMax) {
            return true;
        }
        return false;
    }

    hobby(text, lengthMin, lengthMax) {
        if (text.length >= lengthMin && text.length < lengthMax) {
            return true;
        }
        return false;
    }
}