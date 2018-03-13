
function move(bar,box) {
  var elem = document.getElementById(bar); 
  var input= document.getElementById(box);  
  var width = 1;
  var id = setInterval(frame, 1);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
    } else {
      width+=2.7; 
      elem.style.width = width + '%'; 
    }

      input.onblur = function(){
      elem.style.width=0 ;
      };
  }
}
