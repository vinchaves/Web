document.getElementById('cpf').addEventListener('input', function (e) {
  var value = e.target.value;
  var cpfPattern = value.replace(/\D/g, '')
    .replace(/(\d{3})(\d)/, '$1.$2')
    .replace(/(\d{3})(\d)/, '$1.$2')
    .replace(/(\d{3})(\d)/, '$1-$2')
    .replace(/(-\d{2})\d+?$/, '$1');
  e.target.value = cpfPattern;
});

document.getElementById('banco').addEventListener('input', function (e) {
  var value = e.target.value;
  var cpfPattern = value.replace(/\D/g, '')
    .replace(/(\d{3})(\d)/, '$1-$2')
    .replace(/(-\d{1})\d+?$/, '$1');
  e.target.value = cpfPattern;
});

document.getElementById('agencia').addEventListener('input', function (e) {
  var value = e.target.value;
  var cpfPattern = value.replace(/\D/g, '')
    .replace(/(\d{4})(\d)/, '$1-$2')
    .replace(/(-\d{1})\d+?$/, '$1');
  e.target.value = cpfPattern;
});

document.getElementById('conta').addEventListener('input', function (e) {
  var value = e.target.value;
  var cpfPattern = value.replace(/\D/g, '')
    .replace(/(\d{4})(\d)/, '$1-$2')
    .replace(/(-\d{2})\d+?$/, '$1');
  e.target.value = cpfPattern;
});

function mascara(valor) {
  var valorAlterado = valor.value;
  // valorAlterado = valorAlterado.replace(/\D/g, "");
  // valorAlterado = valorAlterado.replace(/(\d+)(\d{2})$/, "$1,$2");
  // valorAlterado = valorAlterado.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
  valor.value = valorAlterado;
}