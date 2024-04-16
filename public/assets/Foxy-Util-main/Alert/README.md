# Fox Alert
Fiz essa simples biblioteca para trabalhar junto com o jquery e o [sweetalert2](https://sweetalert2.github.io/). O Objetivo é facilitar o feedback com o cliente e fazer isso de uma forma bonitinha.

## Instação

Importar o arquivo FoxAlert-min.js depois do carregamento do jquery e sweetalert2.

## Usando

Para usar basta chamar a função FA_ShowMessage passando como parâmetro o retorno do ajax, aqui o esperado é um json.

### Json

Aqui a lista de parâmetros que pode ser informado no json de retorno.

| Nome do Campo       |   Tipo   |                                                                                                            Descrição |
|---------------------|:--------:|---------------------------------------------------------------------------------------------------------------------:|
| success             | boolean  |                                                                            Indica se deve mostrar o ícone de sucesso |
| message             |  string   |                                                                                    Mensagem a ser mostrada no alerta |
| reload              | boolean |                                                   Se deve recarregar a página após o usuário clicar no ok do alerta. |
| reloadDataTableByID | string |                                                 Caso você use o DataTable e precise que uma tabela seja recarregada. |
| callBackFunction    | string | Executar o script, você pode passar qualquer js valido aqui, será chamada através do eval. Antes de Mostrar o Alert. |
| callBackFunction2   | string | Executar o script, você pode passar qualquer js valido aqui, será chamada através do eval. Antes de Mostrar o Alert. |
 | callBackFunctionAfter | string | Executar o script, você pode passar qualquer js valido aqui, será chamada através do eval. Vai executar depois do Alert. |
