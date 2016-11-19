function myFunction(){

document.getElementById("demo").innerHTML = "Hallo Eugen"; 
}

function hide_show(x){
    
    //x = 0 es ist aktuell da und muss verschwinden 
    
    if(x==0) {
       document.getElementById("ID").style.display="none";
        return 1;  
        
    }
        
    //x = 1 steht für es ist aktuell nicht da, muss wieder angezeigt werden
    else{
        
        document.getElementById("ID").style.display="block"; 
    return 0; 
        
    }
  
}