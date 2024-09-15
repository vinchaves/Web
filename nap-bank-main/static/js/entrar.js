$("#form-entrar").on("submit", async (event) => {
    event.preventDefault();
    const entries = Object.fromEntries(new FormData(/**@type {HTMLFormElement} */ ($("#form-entrar")[0])).entries());
    // TODO: descomentar
    // for (let entry in entries) {
    //     if (!entries[entry]) {
    //         // TODO: Mostrar modal de erro caso campo esteja vazio
    //         console.error(`Campo ${entry} esta vazio!`);
    //         return false;
    //     }
    // }
    const response = await $.ajax({method: "POST", data:entries, url:"api/login.php"});
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
        console.log(respostaString);
    }
    window.location.href = "./perfil/index.php"
})