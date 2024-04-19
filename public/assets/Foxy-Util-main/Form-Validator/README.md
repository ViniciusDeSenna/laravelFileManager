## Instalação
Fazer a importação do componente apos o jquery.
## Como Usar
Para usar o componente você precisa está usando o bootstrap ou alguma bilioteca que trabalhe com validação de formulario atravez da classe invalid-feedback.
<p>Você deve caputarar o evento da seguinte forma</p>

```javascript
if (!validarFormulario('formCadastroCliente')) {
    return;
}
```

Eu faço essa chamada na primeira linha do evento ajax.
<p>Exemplo da estrutura do HTML</p>

```html
<div class="col">
    <div class="form-floating mb-3">
        <input class="form-control" id="razao_social" name="razao_social" required type="text" placeholder="Razão social" maxlength="90" minlength="2"/>
        <label for="razao_social">Razão Social</label>
        <div class="invalid-feedback">O campo Razão Social é obrigatório.</div>
    </div>
</div>
```

O erro será exibido no elemento da div com classe <b>invalid-feedback</b>

