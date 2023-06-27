//definindo a dimensão do palco do jogo (window.innerHeight (eixo y) e window.innerWidth (eixo x))

var altura = 0
var largura = 0
var vidas = 1
var tempo = 100

var criaMosquitoTempo = 1500

var nivel = window.location.search
nivel = nivel.replace('?', '')

if (nivel === 'normal') {
    //1500
    criaMosquitoTempo = 1500
} else if (nivel === 'dificil') {
    //1000
    criaMosquitoTempo = 1000
} else if (nivel === 'muitodificil'){
    //750
    criaMosquitoTempo = 750
}

function ajustaTamanhoPalcoJogo(){
    altura = window.innerHeight
    largura = window.innerWidth

    console.log(largura, altura)
}

ajustaTamanhoPalcoJogo()

var cronometro = setInterval(function () {

    tempo -= 1 

    if(tempo < 0){
        clearInterval(cronometro)
        clearInterval(criaMosca)
        window.location.href = 'vitoria.html'
    } else {
        document.getElementById('cronometro').innerHTML = tempo
    }
}, 1000)


//criando posições randômicas usando style.left e style.right
function posicaoRandomica() {

    //removendo a mosca anterior (caso exista)
    if (document.getElementById('mosca')) {
        document.getElementById('mosca').remove()
    
        if (vidas > 3) {
            window.location.href = 'game_over.html'
        } else {
            document.getElementById('v' + vidas).src = "img/coracao_vazio.png"
            vidas++
        } 
    }

    //Usando Math.floor para tirar as casas decimais 
    var posicaoX = Math.floor(Math.random() * largura) - 90
    var posicaoY = Math.floor(Math.random() * altura) - 90

    posicaoX = posicaoX < 0 ? 0 : posicaoX
    posicaoY = posicaoY < 0 ? 0 : posicaoY
 
    console.log(posicaoX, posicaoY)

    //criar elemento html
    var mosca = document.createElement('img')
    mosca.src = 'img/mosca.png'
    mosca.className = tamanhoAleatorio() + ' ' + ladoAleatorio()
    mosca.style.left = posicaoX + 'px'
    mosca.style.top = posicaoY + 'px'
    mosca.style.position = 'absolute'
    mosca.id = 'mosca'
    mosca.onclick = function() { //controlando pontos de vida
        this.remove()
    }

    document.body.appendChild(mosca)
}

//modificando os tamanhos aleatórios dos mosquitos
function tamanhoAleatorio() {
    var classe = Math.floor(Math.random() * 3) 
    
    switch (classe) {
        case 0:
            return 'mosca1'
        case 1:
            return 'mosca2'
        case 2:
            return 'mosca3'
    }       
}

//ajustando orientação da mosca: direita ou esquerda (ladoA ou ladoB)
function ladoAleatorio() {
    var classe = Math.floor(Math.random() * 2) 
    
    switch (classe) {
        case 0:
            return 'ladoA'
        case 1:
            return 'ladoB'
    }  
}
