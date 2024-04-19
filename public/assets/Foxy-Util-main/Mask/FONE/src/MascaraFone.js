$( document ).ready(function() {
    registerFAMaskDocEvents();
});

function FA_Mask_Register(){
    registerFAMaskDocEvents();
}

function registerFAMaskDocEvents() {
    $("input[data-type='fone']").on('keyup blur input', function() {
        const inputValue = $(this).val();
        const fone = formatFone(inputValue);
        $(this).val(fone);
    });
}

function formatFone(input) {
    let cleaned = input.replace(/\D/g, '');

    let isCelular = cleaned.length === 11;

    let mask = isCelular ? '(00) 0 0000-0000' : '(00) 0000-0000';

    let formatted = '';
    let i = 0;

    for (let m = 0; m < mask.length; m++) {
        if (mask[m] === '0' && i < cleaned.length) {
            formatted += cleaned[i++];
        } else if (mask[m] !== '0') {
            formatted += mask[m];
        }
    }

    return formatted;
}
