$(document).ready(function(){
    $("#prueba1").mousedown(function(e){
        //1: izquierda, 2: medio/ruleta, 3: derecho
         if(e.which == 1) 
             {
                 $('#mensaje1').text("has hecho click derecho");
             }
     });
});