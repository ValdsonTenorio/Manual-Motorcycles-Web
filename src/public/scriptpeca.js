async function registraPeca() {
    const peca = {
        tipo: document.getElementById('tipo').value,
        price: document.getElementById('preco').value,
        descricao: document.getElementById('descricao').value,
        id_motors: document.getElementById('motoId').value,
    };
    let data = await fetch("http://localhost:8080/src/api/part", {
        method: "POST",
        body: JSON.stringify(peca)
    }).then(resp => resp.text());
}

async function fetchPecas(){
    let pecas = await fetch(`http://localhost:8080/src/api/part`,{
        method: "GET",
    }).then(response => response);
    return pecas.json();
}

async function removePeca(meuId){
    let data = await fetch("http://localhost:8080/src/api/part", {
        method: "DELETE",
        body: JSON.stringify({
            id: meuId
        })
    }).then(resp => resp.text());
    window.location.reload();
}

async function carregarPecas() {
    const tabela = document.querySelector('#pecaTable tbody');
    tabela.innerHTML = '';
    let dado = await fetchPecas();
    dado.forEach((peca) => {
        const linha = `<tr>
            <td>${peca.tipo}</td>
            <td>${peca.price}</td>
            <td>${peca.descricao}</td>
            <td>${peca.id_motors}</td>
            <td><button onclick="removeMoto(${peca.id})">Deletar</button></td>
            <td><button onclick="">Editar</button></td>
            <td><button onclick="window.location.href='/src/public/viewpeca.html'">Visualizar</button></td>
        </tr>`;
        tabela.innerHTML += linha;
    });
}

carregarPecas()