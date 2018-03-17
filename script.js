//animation bar below input field

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

//set label for error and not filling

function set_label(mess,label,color)
{
  document.getElementById(label).innerHTML=mess;
  document.getElementById(label).style.color=color;
}

//check indivisual item called by error_check

var count=false;

function check_val(input,label,exp){
  var val=document.getElementById(input).value;
  if (val.length == 0)
   {
      set_label("plz enter",label,"red");
      count=false;return false;
   }
   if (!val.match(exp))
    {
      set_label("not valid entry",label,"red");
      count=false;return false;
    }
   set_label("",label,"");
    count=true;return true;
}

//check which function to call on text input field 

function error_check(input,label)
{
  var exp;
  switch (input)
  {
    case "reg":exp = /^20[0-9]{6}$/;check_val(input,label,exp);break;
    case "pass": exp = /^[\d\D]{0,15}$/;check_val(input,label,exp);break;

    case "misc_name":
    case "bike_color":
    case "last_name":
    case "first_name":exp = /^[a-zA-Z]{3,25}$/;check_val(input,label,exp);break;
    case "email":exp = /^[a-zA-z0-9\.\-_]*[@][a-z]*[?'mail']*[\.][a-z]{2,4}$/;check_val(input,label,exp);break;
    case "mobile":exp = /^[0-9]{10}$/;check_val(input,label,exp);break;
    case "address":exp = /^[a-zA-Z0-9\s]{5,200}$/;check_val(input,label,exp);break;

    case "bike_brand":
    case "book_author":exp = /^[a-zA-Z\s]{3,40}$/;check_val(input,label,exp);break;
    case "book_edition":exp = /^[0-9]{0,2}$/;check_val(input,label,exp);break;

    case "misc_price":
    case "bike_price":
    case "book_price":exp= /^[0-9]{0,6}$/;check_val(input,label,exp);break;
  }
}



//checl error in input fields other than text
function error_check_select(input,label)
{
  var val=document.getElementById(input);
  if (val.value=="null") 
  {
    set_label("plz select",label,"red");
    return false;
  }
  set_label("",label,"");
  return true;
}



//matching retype pass with earlier pass
function verifypass(input1,input2,label)
{
  var pass=document.getElementById(input1).value;
  var repeat_pass=document.getElementById(input2).value;

  if (repeat_pass==0) 
  {
     set_label("plz enter",label,"red");
       count=false;return false;
  }

  if (pass!=repeat_pass)
   {
      set_label("password didnt match",label,"red");
       count=false;return false;
   }
   else
   {
      set_label("matched",label,"green");
       count=true;return true;
   }

}

//snackbar display on error 

function display_snackbar() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
 } 

//show snackbar if not valid and disable login button else redirect page
function formvalidate(id)
{
  var button=document.getElementById(id);
  if (count==false) 
  { 
   display_snackbar();
   setTimeout(function() {
        button.disabled = true;
    },2000);
  }
  else{
    button.disabled = false;
  }
}


//seller page script



//hide elements
function hide(val1,val2){
  document.getElementById(val1).style.display='none';
  document.getElementById(val2).style.display='none';
}

//display form on radio button select

function display_form(val)
{
  var box=document.getElementById(val);
  if (val=="book") 
  {
    hide('bike','misc');
    box.style.display='block';
  }
  else if (val=="bike")
   {
      hide('book','misc');
       box.style.display='block';
   }
   else if (val=="misc") 
   {
    hide('book','bike');
    box.style.display='block';
   }
}


//disable sem for other books in branch

function disable_sem()
{
  var branch=document.getElementById("branch");
  var sem=document.getElementById("sem");
  if (branch.value=="other") {
    sem.style.display='none';
  }
  else
  {
    sem.style.display='block';
  }
}


//list page accordion script

(function() {
var acc = document.getElementsByClassName("accordion");
var i,j;
var p= document.getElementsByClassName("panel");


for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;

        for(j=0;j<p.length;j++){
          p[j].style.display="none";
        } 
        

        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
})();
