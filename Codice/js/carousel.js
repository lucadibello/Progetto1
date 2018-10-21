var imageElement = $("#carousel");
var imageIndex = 0;
var intervall = 1000;
setInterval(function(){
    if(imageIndex == 0){
        $(".masthead").css("background-image","img/bg-masterhead.jpg"); console.log("Changed 0");
    } 

    if(imageIndex == 1){
        $(".masthead").css("background-image","img/bg-showcase-1.jpg");  console.log("Changed 1");
    }

    if(imageIndex == 2){
        $(".masthead").css("background-image","img/bg-showcase-2.jpg");  console.log("Changed 2");
    } 

    imageIndex += 1;


    if(imageIndex > 2){imageIndex =0;}
},intervall);
