$( document ).ready(function() {
    registerFAMaskDocEvents();
});

function FA_Mask_Register(){
    registerFAMaskDocEvents();
}

function registerFAMaskDocEvents() {
    $("input[data-type='number']").on('keyup blur input', function() {
        const inputValue = $(this).val();
        $(this).val(formatNUMBER(inputValue));
    });
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


