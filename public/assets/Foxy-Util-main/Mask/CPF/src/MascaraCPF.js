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
        console.log(inputValue);
        const documentType = inputValue.length < 15 ? 'CPF' : 'CNPJ';
        const formattedDocument = formatDocument(inputValue, documentType);
        $(this).val(formattedDocument);
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
