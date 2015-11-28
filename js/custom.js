$(function () {
    $("input[name='tratamento[]']").change(function () {
        var contagem = $("input[name='tratamento[]']:checked").length;

        if (contagem > 0) {
            $('#folha_frequencia').attr('disabled', false );
        }
    });

});

$(function () {
  $('[data-toggle="popover"]').popover()
})