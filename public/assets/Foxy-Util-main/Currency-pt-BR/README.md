# Foxy Currency

Esse é um pacote desenvolvido para trabalhar com inputs no formato de moeda R$, As funções nativas estavam me gerando um pequeno problema no meu projeto então fiz esse pequeno pacote.

Sinta-se livre para sugerir melhorias.

## Como usar?

Importe o Script FoxCurrency.js ou FoxCurrency-min.js apos a importação do jquery.

Nos seus inputs adicione a seguinte propriedade data-type="currency", lembre-se de deixar o input com o tipo text.

Feito isso, tudo já deve estar funcionando.

Caso tenha carregamento dinamico, lembre de registrar os eventos manualmente com FA_Currency_Register()

## Util

- formatFloatCurrency(float) -> essa função converte uma variavel do tipo float para o formato de moeda.
- foxCurrencyFloat(idInput) -> converte o valor do input fornecido para uma variavel do tipo float



## Funcionamento

Apos o carregamento da pagina, o script ira adicionar um evento para sempre que um input for digitado formatar o núemro para R$ 9,00 ou R$ 1.254,00


## License

The MIT License (MIT). Please see [License File](https://github.com/LucsaArend/foxy-http/blob/main/LICENSE) for more information.