var checker = new validator();

function addListeners(){
    //Add on keydown event to all objects
    $("#first_name").keydown(function(){manage(this,"nome");});
    $("#last_name").keydown(function(){manage(this,"cognome");});
    $("#data_nascita").keydown(function(){manage(this,"data");});
    $("#email").keydown(function(){manage(this,"email");});
    $("#citta").keydown(function(){manage(this,"citta");});
    $("#cap").keydown(function(){manage(this,"cap");});
    $("#via").keydown(function(){manage(this,"via");});
    $("#numero_civico").keydown(function(){manage(this,"civico");});
    //$("#professione").keydown(function(){manage(this,"work");});
    //$("#hobby").keydown(function(){manage(this,"hobby");});
    $("#phone").keydown(function(){manage(this,"phone");});


    //Add on keyup event for dinamicity
    $("#first_name").keyup(function(){manage(this,"nome");});
    $("#last_name").keyup(function(){manage(this,"cognome");});
    $("#data_nascita").keyup(function(){manage(this,"data");});
    $("#email").keyup(function(){manage(this,"email");});
    $("#citta").keyup(function(){manage(this,"citta");});
    $("#cap").keyup(function(){manage(this,"cap");});
    $("#via").keyup(function(){manage(this,"via");});
    $("#numero_civico").keyup(function(){manage(this,"civico");});
    //$("#professione").keyup(function(){manage(this,"work");});
    //$("#hobby").keyup(function(){manage(this,"hobby");});
    $("#phone").keyup(function(){manage(this,"phone");});
}

function checkAnyError(){
    var changed = false;

    if(manage(document.getElementById('first_name'),"nome") == false){
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span>Dato non valido nel campo nome</span>';
        M.toast({html: toastHTML});
        changed = true;
    }
    if(manage(document.getElementById('last_name'),"cognome")== false){
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span>Dato non valido nel campo cognome</span>';
        M.toast({html: toastHTML});
        changed = true;
    }
    if(manage(document.getElementById('data_nascita'),"data")== false){
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span>Dato non valido nel campo Data</span>';
        M.toast({html: toastHTML});
        changed = true;
    }
    if(manage(document.getElementById('email'),"email")== false){
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span>Dato non valido nel campo Email</span>';
        M.toast({html: toastHTML});
        changed = true;
    }
    if(manage(document.getElementById('citta'),"citta")== false){
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span>Dato non valido nel campo Città</span>';
        M.toast({html: toastHTML});
        changed = true;
    }
    if(manage(document.getElementById('cap'),"cap")== false){
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span>Dato non valido nel campo CAP</span>';
        M.toast({html: toastHTML});
        changed = true;
    }
    if(manage(document.getElementById('via'),"via")== false){
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span>Dato non valido nel campo Via</span>';
        M.toast({html: toastHTML});
        changed = true;
    }
    if(manage(document.getElementById('numero_civico'),"civico")== false){
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span>Dato non valido nel campo Numero civico</span>';
        M.toast({html: toastHTML});
        changed = true;
    }
    if(manage(document.getElementById('phone'),"phone")== false){
        var toastHTML = '<span style="color:red;font-weight:bold;">Errore: </span><span>Dato non valido nel campo Telefono</span>';
        M.toast({html: toastHTML});
        changed = true;
    }
    
    if(changed) return false;

    return true;
}

//PARAMS
const global_length_min = 0;
const global_length_max = 50;
const work_length_max = 500;
const hobby_length_max = 500;

function manage(obj,selector){
    var status = false;

    //CAMBIA IL COLORE A SECONDA DI COSA RITORNA IL CHECKER
    if(selector == "nome"){
        status = checker.nome(obj.value,global_length_min,global_length_max);
    }
    else if(selector == "cognome"){
        status = checker.cognome(obj.value,global_length_min,global_length_max);
    }
    else if(selector == "data"){
        status = checker.dataNascita(obj.value);
    }
    else if(selector == "cap"){
        status = checker.cap(obj.value);
    }
    else if(selector == "citta"){
        status = checker.citta(obj.value)
    }
    else if(selector == "email"){
        status = checker.email(obj.value)
    }
    else if(selector == "hobby"){
        status = checker.hobby(obj.value,global_length_min,hobby_length_max);
    }
    else if(selector == "civico" || selector == "numeroCivico"){
        status = checker.numeroCivico(obj.value);
    }
    else if(selector == "work"){
        status = checker.work(obj.value,global_length_min,work_length_max);
    }
    else if(selector == "via"){
        status = checker.via(obj.value,global_length_min,global_length_max);
    }
    else if(selector == "phone"){
        status = checker.phone(obj.value);
    }
    else{
        alert("Wrong selector on " + obj);
    }
    if(status){
        obj.style.borderBottom = "1px solid #4CAF50";
        obj.style.boxShadow = "0 1px 0 0 #4CAF50";
    }
    else{
        obj.style.borderBottom = "1px solid #FF0000";
        obj.style.boxShadow = "0 1px 0 0 #FF0000";
    }
    return status;
}

function counter(obj){
}



console.log("[INFO] Loaded register.js for visual local validation");




