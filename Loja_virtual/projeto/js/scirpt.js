function MaskCPF(numeroCPF){
    var cpf = numeroCPF.value;
       //alert(cpf);
    if(isNaN(cpf[cpf.length - 1])) // proibir caractere que não seja numero
    {
      numeroCPF.value = cpf.subtring(0,cpf.length - 1)
      return;     
    }
    // fazer a separação usando caractere

    if(cpf.length === 3 || cpf.length === 7)
    {
        numeroCPF.value += ".";
    }
    if(cpf.length === 11){
        numeroCPF.value += "-";
    }
}

function MaskFone(fone){
    var  telefone = fone.value;

    if(telefone.length < 14){
        telefone = telefone.replace(/\D/g,"");
        telefone = telefone.replace(/^(\d{2})(\d)/g,"($1)$2");
        telefone = telefone.replace(/(\d)(\d{3})$/,"$1-$2");
        fone.value = telefone;
    }

}