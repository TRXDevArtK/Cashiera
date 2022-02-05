var coll = document.getElementsByClassName("clps-1");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function(event) {
        event.preventDefault();
        this.classList.toggle("clps-active-1");
        var content = this.nextElementSibling;
        
        if (content.style.maxHeight){
            content.style.maxHeight = null;
        } 
        else{
            content.style.maxHeight = content.scrollHeight + "px";
        } 
    });
}

