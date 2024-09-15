// @ts-ignore
// $("#janela").modal();

function updateUI() {
    console.log("teste")
    const tipoChecked = $("input[name=tipo]:checked").val();
    const externo = $("#externa-checkbox").is(":checked");
    if (externo) {
        console.log(tipoChecked, tipoChecked==="PIX");
        if (tipoChecked === "PIX") {
            $("#row-externo").hide();
            $("#container-cpf").hide();
            $("#container-chave").show();
        } else {
            console.log("foi");
            $("#row-externo").show();
            $("#container-cpf").show();
            $("#container-chave").hide();
        }
    } else {
        $("#row-externo").hide();
        if (tipoChecked === "PIX") {
            $("#container-cpf").hide();
            $("#container-chave").show();
        } else {
            $("#container-cpf").show();
            $("#container-chave").hide();
        }
    }

    
    // $("#row-externo").hide();
}
$(".radio-tipo").on("change", updateUI)

$("#externa-checkbox").on("change", updateUI)
$("#externa-checkbox").prop("checked", false);
$("#row-externo").hide();

$("#valor").on("change", (event) => {
    const value = $("#valor").val();
    if (value === undefined  || typeof value !== "string") {
        return;
    }
    
    const valueNumber = Number.parseFloat(value);
    if (value === "" || valueNumber < 0) {
        // @ts-ignore
        $("#novo-valor").text(usuario.saldo);
        return;
    }
    // @ts-ignore
    $("#novo-valor").text(usuario.saldo + valueNumber);
})

$("#form-transferir").on("submit", async (event) => {
    event.preventDefault();
    $("#qrcode").hide();
    $("modal-fechar").hide();
    $("#modal-load").show();
    $("#modal-ok").hide();
    $("#modal-bad").hide();



    const entries = Object.fromEntries(new FormData(/**@type {HTMLFormElement} */ ($("#form-transferir")[0])).entries());
    $("#texto-modal").text("Processando transação...");

    // if (entries.tipo === "pix") {
    //     $("#texto-modal").text("Gerando QRCode PIX...");
    // } else {
    //     $("#texto-modal").text("Gerando Boleto...");
    // }
    // @ts-ignore
    const modal = $("#janela").modal("toggle");
    const response = JSON.parse(await $.ajax({method: "POST", data:entries, url:"/nap/api/transferir.php"}));
    console.log(response);
    
    setTimeout(() => {
        // Simular tempo de resposta api
        if (response.tipo === "erro") {
            console.log("teste");
            $("#modal-bad").show();
            $("#modal-load").hide();
    
            $("#texto-modal").text(`${response.mensagem}`);
            $("#modal-fechar").show();
    
            return;
        } else {
            $("#modal-ok").show();
            $("#modal-load").hide();
            $("#texto-modal").text(`${response.mensagem}`);
            $("modal-fechar").show();
        }
        
    }, 1500);
    // $("#qrcode").show();
    // $("#qrcode").attr("src", `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=response`)
    
    // setInterval(() => {
    //     // @ts-ignore
    //     $("#janela").modal("hide");
    // }, 50);
})