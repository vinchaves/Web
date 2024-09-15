// @ts-ignore
let saldo = perfilUsuario.saldo;
// @ts-ignore
let fatura = perfilUsuario.fatura;
let saldoVisivel = false;

$("#btnSaldo").click(() => {
    if (saldoVisivel) {
        $("#sal").text("●●●●●")
        $("#btnSaldo").text("Mostrar")
    } else {
        $("#sal").text("R$ "+saldo.toFixed(2).replace('.', ','))
        $("#btnSaldo").text("Esconder")
    }
    saldoVisivel = !saldoVisivel;
})
$("#btnFatu").click(() => {
    if (saldoVisivel) {
        $("#fatu").text("●●●●●")
        $("#btnFatu").text("Mostrar")
    } else {
        $("#fatu").text("R$ "+fatura.toFixed(2).replace('.', ','))
        $("#btnFatu").text("Esconder")
    }
    saldoVisivel = !saldoVisivel;
})