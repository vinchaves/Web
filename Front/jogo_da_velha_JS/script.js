// Dados iniciais
let quadro = {
    a1:"", a2:"", a3:"",
    b1:"", b2:"", b3:"",
    c1:"", c2:"", c3:""
};
let jogador = "x";
let msg = "";
let jogando = false;
// Eventos
reset();
document.querySelector(".reset").addEventListener('click',reset);
document.querySelectorAll(".item").forEach((item)=>{
    item.addEventListener('click',itemClick)
});
// Funções
function itemClick(event){
    let item = event.target.getAttribute('data-item');
    if(jogando && quadro[item]===''){
        quadro[item] = jogador;
        preencherQuadro();
        alternarJogador();
    }
}
function reset(){
    msg = "";
    let aleatorio = Math.floor(Math.random() * 2);
    jogador = aleatorio === 0 ? "x" : "o";
    for(let i in quadro){
        quadro[i]="";
    };
    
    preencherQuadro();
    preencherInfo();

    jogando = true;
};

function preencherQuadro() { 
    for(let i in quadro){
        let item = document.querySelector(`div[data-item=${i}]`);
        if(quadro[i]!== ''){
            item.innerHTML = quadro[i];
        }else{
            item.innerHTML = '';
        }
        
    };
    checarJogo();
}
function preencherInfo() {
    document.querySelector('.vez').innerHTML = jogador;
    document.querySelector('.resultado').innerHTML = msg;
};
function alternarJogador(){
    jogador = jogador === "x" ? "o" : "x";
    preencherInfo();
}
function checarJogo(){
    if(quemGanhou('x')){
        msg = 'X Ganhou!'
        jogando = false;
    }else if(quemGanhou('o')){
        msg = 'O Ganhou!'
        jogando = false;
    }else if(empate()){
        msg = 'Empate!'
        jogando = false
    }
}

function quemGanhou(jogador) { 
    let posicao = [
        'a1,a2,a3',
        'b1,b2,b3',
        'c1,c2,c3',

        'a1,b1,c1',
        'a2,b2,c2',
        'a3,b3,c3',

        'a1,b2,c3',
        'a3,b2,c1'
    ];
    for(let w in posicao){
        let pArray = posicao[w].split(',');
        let venceu = pArray.every(option => quadro[option] === jogador);
        if(venceu){
            return true;
        }
    }
    return false;
}

function empate(){
    for(let i in quadro){
        if(quadro[i]===''){
            return false;
        }
    }
    return true;
};