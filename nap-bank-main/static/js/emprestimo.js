function calcular() {

  const value = document.getElementById('value').value;
  const fee = document.getElementById('fee').value / 100;


  const total = value * (1 + fee) ** fee;

  document.getElementById('total').innerHTML = ("R$" + total.toFixed(2).replace('.', ','));

}
$("#value").blur(() => {
  calcular();
})
$("#fee").blur(() => {
  calcular();
})

/*
document.getElementById('value').addEventListener('blur', function () {
  calcular();
});
document.getElementById('fee').addEventListener('blur', function () {
  calcular();
});
*/


function mascara(valor) {
  var valorAlterado = valor.value;
  valorAlterado = valorAlterado.replace(/\D/g, "");
  valorAlterado = valorAlterado.replace(/(\d+)(\d{2})$/, "$1,$2");
  valorAlterado = valorAlterado.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
  valor.value = valorAlterado;
}