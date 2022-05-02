function validaMail(){
    var em = document.myForm.inputEmail.value;
    if (em.indexOf("@studenti.uniroma1.it",0)!=-1 || em.indexOf("@stud.uniroma3.it",0)!=-1){
      var poschiocciola = em.indexOf("@",0);
      var dom = em.subString(poschiocciola,em.length-1);
      if(dom=="@studenti.uniroma1.it" || dom=="@stud.uniroma3.it") return true;
      else{
        alert("Errore! La mail deve avere un dominio universitario");
        return false;
      }
    }
    else{
      alert("Errore! La mail deve avere un dominio universitario");
      return false;
    }
  }
  function controllaPassword(){
    var p = document.myForm.pass.value;
    if(p.length<8){
      alert("Errore! La password deve essere lunga almeno 8 caratteri");
      return false;
    }
    var controlla = 0;
    //controllo numeri
    var check=/[0-9]/;
    if(check.test(p)){
      controlla +=1;
    }
    //controllo minuscole
    var check2=/[a-z]/;
    if(check2.test(p)){
      controlla +=1;
    }
    //controllo maiuscole
    var check3=/[A-Z]/;
    if(check3.test(p)){
      controlla +=1;
    }
    //controllo simboli
    var check4=/[$-/:-?{-~!"^_`\[\]]/;
    if(check4.test(p)){
      controlla +=1;
    }
    //controllo finale
    if(controlla != 4){
      alert("Errore! La password deve contenere almeno una lettera maiuscola, un numero e un carattere speciale");
      return false;
    }
    return true;
    }

    function verificaPassword(){
      if(document.myForm.pass.value != document.myForm.password2.value){
        alert("Errore! Le due password inserite non sono uguali");
        return false;
      }
    return true;
    }

function validaForm(){
if(document.myForm.nome.value == ""){
alert("inserire nome!");
return false;
}
if(document.myForm.cognome.value == ""){
alert("inserire cognome!");
return false;
}
if(document.myForm.inputEmail.value == ""){
alert("inserire email!");
return false;
}
alert("tutti i dati inseriti correttamente!");
return true;
}