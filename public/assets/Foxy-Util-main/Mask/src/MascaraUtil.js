$( document ).ready(function() {
    registerFAMaskDocEvents();
});

function FA_Mask_Register(){
    registerFAMaskDocEvents();
}

function registerFAMaskDocEvents() {
    $("input[data-type='cpf']").on('keyup blur input', function() {
        const inputValue = $(this).val();
        const formattedCPF = formatCPF(inputValue);
        $(this).val(formattedCPF);
    });

    $("input[data-type='cnpj']").on('keyup blur input', function() {
        const inputValue = $(this).val();
        const formattedCPF = formatCNPJ(inputValue);
        $(this).val(formattedCPF);
    });

    $("input[data-type='documento']").on('keyup blur input', function() {
        const inputValue = $(this).val();
        const documentType = inputValue.length < 15 ? 'CPF' : 'CNPJ';
        const formattedDocument = formatDocument(inputValue, documentType);
        $(this).val(formattedDocument);
    });
    $("input[data-type='cep']").on('keyup blur input', function() {
        const inputValue = $(this).val();
        const formattedCEP = formatCEP(inputValue);
        $(this).val(formattedCEP);
    });
    $("input[data-type='number']").on('keyup blur input', function() {
        const inputValue = $(this).val();
        $(this).val(formatNUMBER(inputValue));
    });
    $("input[data-type='currency']").on({
        keyup: function() {
            formatCurrency($(this));
        },
        blur: function() {
            formatCurrency($(this), "blur");
        },
        onfocusOut: function() {
            formatCurrency($(this), "fix2");
        },
        focusout: function() {
            formatCurrency($(this), "fix2");
        }
    });
    $("input[data-type='currencyFone']").on({
        keyup: function() {
            formatCurrencyFone($(this));
        },
        blur: function() {
            formatCurrencyFone($(this));
        },
        onfocusOut: function() {
            formatCurrencyFone($(this));
        },
        focusout: function() {
            formatCurrencyFone($(this));
        }
    });
}

function formatCPF(input) {
    const cleanedInput = input.replace(/\D/g, '');
    let formattedCPF = '';

    if (cleanedInput.length <= 3) {
        formattedCPF = cleanedInput;
    } else if (cleanedInput.length <= 6) {
        formattedCPF = cleanedInput.slice(0, 3) + '.' + cleanedInput.slice(3);
    } else if (cleanedInput.length <= 9) {
        formattedCPF = cleanedInput.slice(0, 3) + '.' + cleanedInput.slice(3, 6) + '.' + cleanedInput.slice(6);
    } else {
        formattedCPF = cleanedInput.slice(0, 3) + '.' + cleanedInput.slice(3, 6) + '.' + cleanedInput.slice(6, 9) + '-' + cleanedInput.slice(9, 11);
    }

    return formattedCPF;
}

function formatCNPJ(input) {
    const cleanedInputCNPJ = input.replace(/\D/g, '');
    let formattedDocument = '';

    if (cleanedInputCNPJ.length <= 2) {
        formattedDocument = cleanedInputCNPJ;
    } else if (cleanedInputCNPJ.length <= 5) {
        formattedDocument = cleanedInputCNPJ.slice(0, 2) + '.' + cleanedInputCNPJ.slice(2);
    } else if (cleanedInputCNPJ.length <= 8) {
        formattedDocument = cleanedInputCNPJ.slice(0, 2) + '.' + cleanedInputCNPJ.slice(2, 5) + '.' + cleanedInputCNPJ.slice(5);
    } else if (cleanedInputCNPJ.length <= 12) {
        formattedDocument = cleanedInputCNPJ.slice(0, 2) + '.' + cleanedInputCNPJ.slice(2, 5) + '.' + cleanedInputCNPJ.slice(5, 8) + '/' + cleanedInputCNPJ.slice(8);
    } else {
        formattedDocument = cleanedInputCNPJ.slice(0, 2) + '.' + cleanedInputCNPJ.slice(2, 5) + '.' + cleanedInputCNPJ.slice(5, 8) + '/' + cleanedInputCNPJ.slice(8, 12) + '-' + cleanedInputCNPJ.slice(12, 14);
    }

    return formattedDocument;
}

function formatDocument(input, documentType) {
    const cleanedInput = input.replace(/\D/g, '');
    let formattedDocument = '';

    if (documentType === 'CPF') {
        if (cleanedInput.length <= 3) {
            formattedDocument = cleanedInput;
        } else if (cleanedInput.length <= 6) {
            formattedDocument = cleanedInput.slice(0, 3) + '.' + cleanedInput.slice(3);
        } else if (cleanedInput.length <= 9) {
            formattedDocument = cleanedInput.slice(0, 3) + '.' + cleanedInput.slice(3, 6) + '.' + cleanedInput.slice(6);
        } else {
            formattedDocument = cleanedInput.slice(0, 3) + '.' + cleanedInput.slice(3, 6) + '.' + cleanedInput.slice(6, 9) + '-' + cleanedInput.slice(9, 11);
        }
    } else if (documentType === 'CNPJ') {
        if (cleanedInput.length <= 2) {
            formattedDocument = cleanedInput;
        } else if (cleanedInput.length <= 5) {
            formattedDocument = cleanedInput.slice(0, 2) + '.' + cleanedInput.slice(2);
        } else if (cleanedInput.length <= 8) {
            formattedDocument = cleanedInput.slice(0, 2) + '.' + cleanedInput.slice(2, 5) + '.' + cleanedInput.slice(5);
        } else if (cleanedInput.length <= 12) {
            formattedDocument = cleanedInput.slice(0, 2) + '.' + cleanedInput.slice(2, 5) + '.' + cleanedInput.slice(5, 8) + '/' + cleanedInput.slice(8);
        } else {
            formattedDocument = cleanedInput.slice(0, 2) + '.' + cleanedInput.slice(2, 5) + '.' + cleanedInput.slice(5, 8) + '/' + cleanedInput.slice(8, 12) + '-' + cleanedInput.slice(12, 14);
        }
    }

    return formattedDocument;
}

function formatCEP(cep) {
    // Remove todos os caracteres não numéricos do CEP
    let cepVal = cep
    cepVal = cepVal.replace(/\D/g, '');

    // Verifica se o CEP possui a quantidade correta de dígitos (8 dígitos)
    if (cepVal.length === 8) {
        // Aplica a máscara ao CEP (formato: 12345-678)
        cepVal = cepVal.slice(0, 2) + '.' + cepVal.slice(2, 5) + '-' + cepVal.slice(5);
    }else if(cepVal.length > 8){
        cepVal = cepVal.slice(0, 8)
    }

    return cepVal;
}

function formatNUMBER(input) {
    let inputValue = input;
    // Remove caracteres não numéricos, exceto vírgulas
    const cleanedValue = inputValue.replace(/[^0-9,.]/g, '');
    // Garante que não haja mais de uma vírgula no número
    const commaCount = cleanedValue.split(',').length - 1;
    if (commaCount > 1) {
        const parts = cleanedValue.split(',');
        inputValue = parts[0] + ',' + parts.slice(1).join('');
    } else {
        inputValue = cleanedValue;
    }
    return inputValue;
}

function foxCurrencyFloat(prInputID) {
    let value = $('#'+prInputID).val();
    if(value <= 0){
        return getFoxAsomeNumbers("0");
    }
    if (value.indexOf(",") >= 0) {
        let partRight = value.substring(value.indexOf(",")+1,value.length);
        let partLeft = value.substring(0,value.indexOf(","));
        return getFoxAsomeNumbers(partLeft) + '.' + partRight;
    } else {
        return getFoxAsomeNumbers(value);
    }
}

function formatNumber(n) {
    // format number 1000000 to 1.234,56
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}

function getFoxAsomeNumbers(n) {
    // format number 1000000 to 123456
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, "")
}

function formatFloatCurrency(input) {
    //Format float values to string with mask R$ Real Brasil
    //inputString Example: "1000.52"
    // get input value
    let input_val
    if (isNaN(input) || input === null || input === undefined) {
        input_val = "0";
    } else {
        input_val = input.toString();
    }
    input_val = parseFloat(input_val).toFixed(2);
    input_val = input_val.toString();
    input_val = input_val.replace('.', ',');
}

function formatFloatCurrency(input, decimalPlaces = 2) {
    // Format float values to string with the mask R$ Real Brasil
    // input Example: 1000.52
    // decimalPlaces Example: 2

    // get input value
    let input_val;
    if (isNaN(input) || input === null || input === undefined) {
        input_val = 0;
    } else {
        input_val = parseFloat(input);
    }

    // Round to the specified number of decimal places
    input_val = input_val.toFixed(decimalPlaces);

    // Convert to string
    let input_str = input_val.toString();

    // Replace '.' with ','
    input_str = input_str.replace('.', ',');

    // Check for decimal
    if (input_str.indexOf(",") >= 0) {
        if (input_str.indexOf(",") === (input_str.length - 1)) {
            return;
        }
        let partRight = input_str.substring(input_str.indexOf(",") + 1, input_str.length);
        let partLeft = input_str.substring(0, input_str.indexOf(","));
        return 'R$ ' + formatNumber(partLeft) + ',' + partRight;
    } else {
        return 'R$ ' + formatNumber(input_str) + ',00';
    }
}

function formatCurrency(input, prAux) {
    let input_val = input.val();

    if (input_val === "") {
        return;
    }

    let number = input_val;
    if (input_val.indexOf(",") >= 0) {
        if (input_val.indexOf(",") === (input_val.length - 1)) {
            return;
        }
        let partRight = input_val.substring(input_val.indexOf(",") + 1, input_val.length);
        let partLeft = input_val.substring(0, input_val.indexOf(","));

        number = formatNumber(partLeft) + ',' + partRight.replace(/\D/g, '');
    } else {
        number = formatNumber(input_val);
    }
    if ((prAux === "fix2") && number.length > 0) {
        if (input_val.indexOf(",") <= 0) {
            input.val('R$ ' + number + ',00');
        }
    } else {
        input.val('R$ ' + number);
    }

    let original_len = input_val.length;
    let caret_pos = input.prop("selectionStart");
    let updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}


function formatCurrencyFone(input) {
    let valueInput = input.val()
    valueInput = valueInput.toString();
    valueInput = valueInput.replace(/\D/g, '');

    if (valueInput.length <= 11) {
        if (valueInput.length <= 10) {
            valueInput = valueInput.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
        } else {
            valueInput = valueInput.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
        }
    } else {
        valueInput = valueInput.substring(0, 11);
        valueInput = valueInput.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
    }

    input.val(valueInput);
}

function formatFone(input) {
    // Remove tudo que não for dígito do telefone
    let inputVal
    input.length <= 0 ? inputVal = '' : inputVal = input;
    inputVal = input.toString();
    inputVal = input.replace(/\D/g, '');

    // Verifica o tamanho do telefone para determinar a máscara adequada
    if (inputVal.length <= 10) {
        // Formato: (99) 9999-9999
        inputVal = inputVal.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
    } else {
        // Formato: (99) 99999-9999
        inputVal = inputVal.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
    }
    return inputVal
}
