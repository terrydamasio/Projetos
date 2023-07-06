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
            data: `competencia=${competencia}`, //x-www-form-urlencoded
            dataType: 'json', 
            success: function(dados) {
                $('#numeroVendas').html(dados.numeroVendas)
                $('#totalVendas').html(dados.totalVendas)
                $('#clientesAtivos').html(dados.clientesAtivos)
                $('#clientesInativos').html(dados.clientesInativos)
                $('#totalReclamacoes').html(dados.totalReclamacoes)
                $('#totalElogios').html(dados.totalElogios)
                $('#totalSugestoes').html(dados.totalSugestoes)
                $('#despesas').html(dados.despesas)
            }, 
            error: erro => { console.log(erro) }
        })

        //método, url, dados, sucesso, erro
    })

})