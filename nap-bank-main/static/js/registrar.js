$("#form-registro").on("submit", async (event) => {
    event.preventDefault();

    // @ts-ignore
    const entries = Object.fromEntries(new FormData(/**@type {HTMLFormElement} */ ($("#form-registro")[0])).entries());
    console.log(entries);

    // TODO: descomentar
    // for (let entry in entries) {
    //     if (!entries[entry]) {
    //         // TODO: Mostrar modal de erro caso campo esteja vazio
    //         console.error(`Campo ${entry} esta vazio!`);
    //         return false;
    //     }
    // }

    if (entries["senha"] !== entries["senha_confirmar"]) {
        $("#alert-erro").text("Senhas nao coincidem"); 
        // @ts-ignore
        $("#janela").modal();
        return;
    }

    const response = await $.ajax({method: "POST", data:entries, url:"api/registro.php"});
    try {
        const respostaJson = JSON.parse(response);
        if (respostaJson.tipo === "erro") {
            const erro = respostaJson.mensagem;
            $("#alert-erro").text(erro);
            // @ts-ignore
            $("#janela").modal();
            return false;
        }
    } catch (e) {
        /** @type {string} */
        const respostaString = response;
    }
    window.location.href = "./perfil"
    
})
document.getElementById('cpf').addEventListener('input', function (e) {
    var value = e.target.value;
    var cpfPattern = value.replace(/\D/g, '')
      .replace(/(\d{3})(\d)/, '$1.$2')
      .replace(/(\d{3})(\d)/, '$1.$2')
      .replace(/(\d{3})(\d)/, '$1-$2')
      .replace(/(-\d{2})\d+?$/, '$1');
    e.target.value = cpfPattern;
  });