class Despesa {
    constructor(ano, mes, dia, tipo, descricao, valor) {
        this.ano = ano
        this.mes = mes
        this.dia = dia
        this.tipo = tipo
        this.descricao = descricao
        this.valor = valor
    }

    validarDados() {
        for(let i in this) {
            if(this[i] == undefined || this[i] == '' || this[i] == null) {
                return false
            } 
        }
        return true
    }
}

class Bd {

    constructor() {
        let id = localStorage.getItem('id')

        if(id === null) {
            localStorage.setItem('id', 0)
        } 
    }

    getProximoId() {
        let proximoId = localStorage.getItem('id')
        return parseInt(proximoId) + 1
    }

    gravar(d) { 
        //acessar recursos de localStorage através desse comando > retorna um objeto de manipulação de local storage do browser
        let id = this.getProximoId()
        localStorage.setItem(id, JSON.stringify(d)) //usando JSON.stringify(d) para converter d para JSON
        localStorage.setItem('id', id)
    }

    recuperarTodosRegistros() {
        //array de despesas
        let despesas = Array()




        let id = localStorage.getItem('id')

        //recuperar todas as despesas cadastradas em localStorage
        for(let i = 1; i <= id; i++) {

            //recuperar a despesa
            let despesa = JSON.parse(localStorage.getItem(i)) 

            /* existe a possibilidade de haver índices que foram pulados/ removidos. Nesses casos 
            nós vamos pular esses índices */
            
            if(despesa === null) {
                continue
            }
            
            despesas.push(despesa)
        }
        return despesas
    }
}

let bd = new Bd()

function cadastrarDespesa() {    

    let ano = document.getElementById('ano')
    let mes = document.getElementById('mes')
    let dia = document.getElementById('dia')
    let tipo = document.getElementById('tipo')
    let descricao = document.getElementById('descricao')
    let valor = document.getElementById('valor')

    let despesa = new Despesa(
        ano.value, 
        mes.value, 
        dia.value, 
        tipo.value, 
        descricao.value, 
        valor.value
    )
    
    if(despesa.validarDados()) {
        bd.gravar(despesa)

        document.getElementById('modalTitulo').innerHTML = 'Registro inserido com sucesso!'
        document.getElementById('modalTituloDiv').className = 'modal-header text-success'
        document.getElementById('modalConteudo').innerHTML = 'Despesa foi dadastrada com sucesso!'
        document.getElementById('modalBtn').innerHTML = 'Voltar'
        document.getElementById('modalBtn').className = 'btn btn-success'

        //dialog de sucesso
        $('#modalRegistraDespesa').modal('show')

        ano.value = ''
        mes.value = '' 
        dia.value = '' 
        tipo.value = ''
        descricao.value = '' 
        valor.value = ''

    } else {
        document.getElementById('modalTitulo').innerHTML = 'Erro na inclusão do registro.'
        document.getElementById('modalTituloDiv').className = 'modal-header text-danger'
        document.getElementById('modalConteudo').innerHTML = 'Erro na gravação. Verifique se todos os campos foram preenchidos corretamente.'
        document.getElementById('modalBtn').innerHTML = 'Voltar e corrigir'
        document.getElementById('modalBtn').className = 'btn btn-danger'

        //dialog de erro
        $('#modalRegistraDespesa').modal('show')
    }
}

function carregaListaDespesas() {

    let despesas = Array()
    despesas = bd.recuperarTodosRegistros() 

    //selecionando elemento <tbody>
    let listaDespesas = document.getElementById('listaDespesas')
    /* 
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>R$</td>
        </tr>
    */

    //percorrer o array despesas, listando cada despesa de forma dinâmica
    despesas.forEach(function(d) {

        console.log(d)

        //criando a linha (tr)
        let linha = listaDespesas.insertRow()

        //criar as colunas (td)
        linha.insertCell(0).innerHTML = `${d.dia}/${d.mes}/${d.ano}` 
        
        //ajustar o tipo
        switch(d.tipo) {
            case '1': d.tipo = 'Alimentação'
                break
    
            case '2': d.tipo = 'Educação'
                break
            
            case '3': d.tipo = 'Lazer'
                break

            case '4': d.tipo = 'Saúde'
                break
            
            case '5': d.tipo = 'Transporte'
                break

            case '6': d.tipo = 'Outros'
                break
        }

        linha.insertCell(1).innerHTML = d.tipo

        linha.insertCell(2).innerHTML = d.descricao
        linha.insertCell(3).innerHTML = d.valor
    
    })
}