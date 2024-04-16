function FA_ShowMessage(prMessage)
{
    /* Retorno Padrão Sucesso */
    if (typeof prMessage.success != "undefined") {
        if (prMessage.success) {
            return FA_showSuccessMessage(prMessage);
        }
    }
    /* Retorno Padrão Erro */
    if (typeof prMessage.error != "undefined") {
        if (prMessage.error) {
            return FA_showErrorMessage(prMessage);
        }
    }
    /* Retorno Laravel */
    if (typeof prMessage.responseJSON != "undefined") {
        prMessage = prMessage.responseJSON;
    }
    if (typeof prMessage.message != "undefined") {
        return FA_showErrorMessage(prMessage);
    }
}
function FA_showSuccessMessage(prOBJ)
{
    /* Reload DataTable */
    if (typeof prOBJ.reloadDataTableByID != "undefined") {
        $('#'+prOBJ.reloadDataTableByID).DataTable().ajax.reload();
    }
    /* Call Back Function */
    if (typeof prOBJ.callBackFunction != "undefined") {
        eval(prOBJ.callBackFunction);
    }
    if (typeof prOBJ.callBackFunction2 != "undefined") {
        eval(prOBJ.callBackFunction2);
    }
    if (typeof prOBJ.title != "undefined") {
        if (typeof prOBJ.reload != "undefined") {
            if (prOBJ.reload) {
                Swal.fire(
                    prOBJ.title,
                    prOBJ.message,
                    'success'
                ).then(function() {
                    if (typeof prOBJ.callBackFunctionAfter != "undefined") {
                        eval(prOBJ.callBackFunctionAfter);
                    }
                    document.location.reload(true);
                });
            }
        } else {
            Swal.fire(
                prOBJ.title,
                prOBJ.message,
                'success'
            ).then(function() {
                if (typeof prOBJ.callBackFunctionAfter != "undefined") {
                    eval(prOBJ.callBackFunctionAfter);
                }
            });
        }
    } else {
        if (typeof prOBJ.reload != "undefined") {
            Swal.fire(
                'Sucesso',
                prOBJ.message,
                'success'
            ).then(function() {
                if (typeof prOBJ.callBackFunctionAfter != "undefined") {
                    eval(prOBJ.callBackFunctionAfter);
                }
                document.location.reload(true);
            });
        } else {
            Swal.fire(
                'Sucesso',
                prOBJ.message,
                'success'
            ).then(function() {
                if (typeof prOBJ.callBackFunctionAfter != "undefined") {
                    eval(prOBJ.callBackFunctionAfter);
                }
            });
        }
    }
}

function FA_showErrorMessage(prOBJ)
{
    /* Reload DataTable */
    if (typeof prOBJ.reloadDataTableByID != "undefined") {
        $('#'+prOBJ.reloadDataTableByID).DataTable().ajax.reload();
    }
    /* Call Back Function */
    if (typeof prOBJ.callBackFunction != "undefined") {
        eval(prOBJ.callBackFunction);
    }
    if (typeof prOBJ.callBackFunction2 != "undefined") {
        eval(prOBJ.callBackFunction2);
    }
    if (typeof prOBJ.title != "undefined") {
        if (typeof prOBJ.reload != "undefined") {
            Swal.fire(
                prOBJ.title,
                prOBJ.message,
                'error'
            ).then(function() {
                if (typeof prOBJ.callBackFunctionAfter != "undefined") {
                    eval(prOBJ.callBackFunctionAfter);
                }
                document.location.reload(true);
            });
        } else {
            Swal.fire(
                prOBJ.title,
                prOBJ.message,
                'error'
            ).then(function() {
                if (typeof prOBJ.callBackFunctionAfter != "undefined") {
                    eval(prOBJ.callBackFunctionAfter);
                }
            });
        }
    } else {
        if (typeof prOBJ.reload != "undefined") {
            Swal.fire(
                prOBJ.title,
                prOBJ.message,
                'error'
            ).then(function() {
                if (typeof prOBJ.callBackFunctionAfter != "undefined") {
                    eval(prOBJ.callBackFunctionAfter);
                }
                document.location.reload(true);
            });
        } else {
            Swal.fire(
                'Oops',
                prOBJ.message,
                'error'
            ).then(function() {
                if (typeof prOBJ.callBackFunctionAfter != "undefined") {
                    eval(prOBJ.callBackFunctionAfter);
                }
            });
        }
    }
}
