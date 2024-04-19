/* Recebe o Id de um formulario e prenche os seus input com base no nome */
function UTILpreencherFormulario(idFormulario, objeto,ignoreID = false,recursive = true) {
    if (typeof objeto === 'object' && objeto === null) {
        return;
    }
    let formulario = document.getElementById(idFormulario);
    if (!formulario) {
        console.error("Formulário "+idFormulario+" não encontrado!");
        return;
    }

    for (let chave in objeto) {
        if (objeto.hasOwnProperty(chave)) {
            /* Caso seja um objeto ele percorre cada campo do objeto */
            if (recursive) {
                UTILpreencherFormulario(idFormulario, objeto[chave], true, false);
            }
            if (ignoreID && (chave === 'id' || chave === '_id')) {
                continue;
            }

            let valor = objeto[chave];
            let elemento = formulario.querySelector(`[name="${chave}"]`);
            if (!elemento) continue;

            if (elemento.type === "checkbox") {
                elemento.checked = valor;
            } else if (elemento.tagName === "SELECT") {
                let opcao = formulario.querySelector(`[name="${chave}"] option[value="${valor}"]`);
                if (opcao) opcao.selected = true;
            } else {
                elemento.value = valor;
            }
        }
    }
}
function UTILformulariosimplesSTOREUPDATE(idFormulario,urlPost,urlUpdate,callbackFunction) {
    let formulario = document.getElementById(idFormulario);
    if (!formulario) {
        console.error("Formulário "+idFormulario+" não encontrado!");
        return;
    }
    /* Verificando se existe um ID para saber se é update */
    let isUpdate = false;
    let campoId = formulario.querySelector('[name="_id"], [name="id"]');
    if (campoId) {
        // O campo com name="_id" ou "id" existe no formulário
        // Agora, verifique se o campo tem algum valor ou está vazio
        if (campoId.value.trim() !== '') {
            isUpdate = true;
        }
    }

    let formData = $(formulario).serialize();
    let url = urlPost;
    let type = 'POST';
    if (isUpdate) {
        url = urlUpdate.replace('#ID#',campoId.value);
        type = 'PUT';
    }
    $.ajax({
        type: type,
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function (data) {
            callbackFunction(data);
        },
        error: function (data) {
            callbackFunction(data);
        }
    });
}
/* Recebe um URL um ID e executa um get */
function UTILgetDatapeloID(url,id,callbackFunction) {
    url = url.replace('#ID#',id);
    $.ajax({
        type: 'GET',
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            callbackFunction(data);
        },
        error: function (data) {
            callbackFunction(data);
        }
    });
}
/* Recebe um url e de formulario e executa um delete */
function UTILdeleteDatapeloFormulario(url,idFormulario,callbackFunction) {
    let formulario = document.getElementById(idFormulario);
    if (!formulario) {
        return;
    }

    let campoId = formulario.querySelector('[name="_id"], [name="id"]');
    if (!campoId) {
        return;
    }
    url = url.replace('#ID#',campoId.value);

    $.ajax({
        type: 'DELETE',
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            callbackFunction(data);
        },
        error: function (data) {
            callbackFunction(data);
        }
    });
}
/* Recebe um url e um ID e executa um delete */
function UTILdeleteDatapeloID(url,id,callbackFunction) {
    url = url.replace('#ID#',id);
    $.ajax({
        type: 'DELETE',
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            callbackFunction(data);
        },
        error: function (data) {
            callbackFunction(data);
        }
    });
}
