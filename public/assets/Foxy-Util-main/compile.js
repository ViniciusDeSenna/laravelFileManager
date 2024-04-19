const fs = require('fs');
const UglifyJS = require('uglify-js');

// Lista dos arquivos JavaScript que você deseja minificar
const jsFiles = [
  'Alert/src/FoxAlert.js',
  'Currency-pt-BR/src/FoxCurrency.js',
  'Util/src/util-crud.js',
  // Adicione mais arquivos aqui...
];

// Diretório de saída para os arquivos minificados
const outputDir = [
   'Alert/dist/FoxAlert.min.js',
   'Currency-pt-BR/dist/FoxCurrenc.min.js',
   'Util/dist/util-crud.min.js',
];

// Minifica cada arquivo e escreve o resultado no diretório de saída
let i = 0;
jsFiles.forEach(file => {
  const inputFile = fs.readFileSync(file, 'utf-8');
  const minifiedCode = UglifyJS.minify(inputFile).code;
  let fileName = outputDir[i];
  fs.writeFileSync(fileName, minifiedCode, 'utf-8');
  console.log(`Arquivo ${jsFiles[i]} minificado com sucesso!`);
  i++;
});
