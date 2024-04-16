$( document ).ready(function() {
    registerFAMaskDocEvents();
});

function FA_Mask_Register(){
    registerFAMaskDocEvents();
}

function registerFAMaskDocEvents() {
    $("input[data-type='cep']").on('keyup blur input', function() {
        const inputValue = $(this).val();
        const formattedCEP = formatCEP(inputValue);
        $(this).val(formattedCEP);
    });
}

function formatCEP(cep) {
    // Remove todos os caracteres não numéricos do CEP
    cep = cep.replace(/\D/g, '');

    // Verifica se o CEP possui a quantidade correta de dígitos (8 dígitos)
    if (cep.length === 8) {
        // Aplica a máscara ao CEP (formato: 12345-678)
        cep = cep.slice(0, 2) + '.' + cep.slice(2, 5) + '-' + cep.slice(5);
    }else if(cep.length > 8){
        cep = cep.slice(0, 8)
    }

    return cep;
}
