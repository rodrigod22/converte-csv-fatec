let divLoad = $('#load');
let divMensagem = $('.mensagem');
$("#form").on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        url: "app/Controller/conversor.php",
        type: "POST",
        processData: false, // important
        contentType: false, // important
        cache: false,
        data: new FormData(this),
        success: function (data) {
            if (data === "1") {
                divMensagem.html("");
                divLoad.html("");
                divMensagem.addClass('alert alert-danger mt-3');
                divMensagem.html("Escolha um arquivo no formato csv");
            } else if (data === "2") {
                divLoad.html("");
                divMensagem.html("");
                divMensagem.addClass('alert alert-danger mt-3');
                divMensagem.html("O arquivo csv enviado não corresponde ao padrão necessário verifique na imagem acima o modelo");
            } else {
                divLoad.html("<div class='text-center alert alert-success mt-3'>Arquivo baixado com sucesso</div>");
                window.location.href = "download.php";
            }
        },
        beforeSend: function () {
            divMensagem.html("");
            divMensagem.removeClass("alert alert-danger mt-3");
            divLoad.html("");
            divLoad.append('<div class="text-center"><img src="assets/img/load.gif"></div>');
        },
        error: function () {
            alert("Ocorreu algum erro na requisição reinicie a página");
        }
    });
});
