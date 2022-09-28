function stars(){
setTimeout(function() {


    $('div').fireworks();

    $('div.bg').fireworks(); 
    $('div.blue').fireworks(); 
 $('div.red').fireworks(); 
 $('div').fireworks(); 
    $('div.bg').fireworks('destroy'); 
 $('div.blue').fireworks('destroy'); 
    $('div.red').fireworks('destroy'); 
    $('div').fireworks('destroy'); 

});

}
var time = 1;

var interval = setInterval(function() { 
   if (time <= 200) { 
   	// alert(time)
     stars();
      time++;
   }
   else { 
      clearInterval(interval);
   }
}, 5000);