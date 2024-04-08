# Laravel File Manager

## Pasta padrao 'local/'
Todas as pastas, ou 'folders', que não forem criadas apartir de outras sub-pastas devem ter 'local/' como diretorio pai.

## Arquivos em pastas
Quando Criar uma nova pasta ela deve conter o caminho da pasta pai, por exemplo se eu criar a pasta 'Teste/' sua pasta pai deve ser 'local/' *(como já havíamos explicado acima a 'local/' deve ser usada sempre que uma pasta for criada fora de uma pasta)*.

Quando eu criar uma subpasta dentro da pasta ‘Teste/’ a ‘Teste/’ deve virar a pasta pai da pasta criada. Por exemplo, se eu criar a pasta subTeste/ dentro da pasta ‘Teste/’ então a pasta pai de ‘subTeste/’ é a pasta ‘Teste/’ (seu id se estiver salvando no banco).

Quando botamos arquivo ai as coisas ficam interessantes pois para salvarmos um arquivo temos que acertar o caminho dele.

Supondo que criamos uma subpasta 'pdfs/' dentro da pasta 'Teste/' e colocarmos um arquivo intitulado 'conteudo.pdf' dentro dessa subpasta.
Para salvar esse arquivo primeiro devemos definir que a pasta pai dele é ‘pdfs/’, salvando no banco com id da pasta pai. Para salvarmos o caminho agora devemos fazer um trabalho de converter as pastas pai uma a uma até formar o caminho de arquivo ‘local/Teste/pdfs/conteudo.pdf’ e assim salvar no banco.
