$(document).ready(() => {
	//Requisições para backend com .load()/ .get()/ .post()
    $('#documentacao').on('click', () => {
        //$('#pagina').load('documentacao.html')
        $.get('documentacao.html', data => {
            $('#pagina').html(data)
        })
    })

    $('#suporte').on('click', () => {
        //$('#pagina').load('suporte.html')
        $.get('suporte.html', data => {
            $('#pagina').html(data)
        })
    })


    //ajax
    $('#competencia').on('change', e => {

        let competencia = $(e.target).val()

        $.ajax({
            type: 'GET', 
            url: 'app.php',
            data: `competencia=${competencia}`, 
            success: dados => {console.log(dados)}, 
            error: erro => {console.log(erro)}
        })

        //método, url, dados, sucesso, erro
    })

})