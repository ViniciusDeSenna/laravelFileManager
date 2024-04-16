function validarFormulario(prID,prSetFoco = false,prSetEvent = true) {
    let retorno = true;
    let formulario = document.getElementById(prID);
    // Obtenha todos os elementos <select> dentro do formulário
    let selects = formulario.querySelectorAll('select');
    for (let i = 0; i < selects.length; i++) {
        if (selects[i].hasAttribute('required')) {
            if (!selects[i].value) {
                retorno = false;
                selects[i].classList.add("is-invalid");
            } else {
                selects[i].classList.remove("is-invalid");
            }
            if (prSetEvent) {
                selects[i].addEventListener('change', function() {
                    validarFormulario(prID,false,false);
                });
            }
        }
    }
    // Obtenha todos os elementtos <input> dentro do formulário
    let inputs = formulario.querySelectorAll('input');
    let textareas = formulario.querySelectorAll('textarea');
    retorno = FAformvalidador(inputs,prSetEvent,prID,retorno);
    retorno = FAformvalidador(textareas,prSetEvent,prID,retorno);
    return retorno;
}
function FAformvalidador(prList,prSetEvent,prID,retorno) {
    for (let i = 0; i < prList.length; i ++) {
        if (prList[i].hasAttribute('required')) {
            if (prSetEvent) {
                prList[i].addEventListener('keydown', function() {
                    validarFormulario(prID,false,false);
                });
            }
            if (prList[i].hasAttribute('minlength')) {
                if (!prList[i].value) {
                    retorno = false;
                    prList[i].classList.add("is-invalid");
                    continue;
                }
                if (prList[i].value.length < prList[i].minLength) {
                    retorno = false;
                    prList[i].classList.add("is-invalid");
                } else {
                    prList[i].classList.remove("is-invalid");
                }
            }
            if (prList[i].hasAttribute('maxlength')) {
                if (!prList[i].value) {
                    retorno = false;
                    prList[i].classList.add("is-invalid");
                    continue;
                }
                if (prList[i].value.length > prList[i].maxLength) {
                    retorno = false;
                    prList[i].classList.add("is-invalid");
                } else {
                    prList[i].classList.remove("is-invalid");
                }
            }
        }
    }
    return retorno;
}