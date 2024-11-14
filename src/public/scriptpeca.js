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
    console.log(data)
}

async function fetchPecas(id) {
    let pecas = await fetch(`http://localhost:8080/src/api/part/motor?id=${id}`, {
        method: "GET",
    }).then(response => response);
    return pecas.json();
}


async function fetchPeca(id) {
    let pecas = await fetch(`http://localhost:8080/src/api/part?id=${id}`, {
        method: "GET",
    }).then(response => response);
    return pecas.json();
}

async function removePeca(meuId) {
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

    let fromGet = new URLSearchParams(window.location.search);
    if (fromGet.size != 0) {
        let id = parseInt(fromGet.get("id"));
        let dado = await fetchPecas(id);
        dado.forEach((peca) => {
            const linha = `<tr>
            <td>${peca.tipo}</td>
            <td>${peca.price}</td>
            <td>${peca.descricao}</td>
            <td>${peca.id_motors}</td>
            <td><button onclick="removePeca(${peca.id})">Deletar</button></td>
            <td><button onclick="window.location.href='/src/public/cadastropeca.html?id=${peca.id}'">Editar</button></td>

        </tr>`;
            tabela.innerHTML += linha;
        });
    }
}

carregarPecas()

async function onUpdate() {
    let fromGet = new URLSearchParams(window.location.search);
    if (fromGet.size != 0) {
        let id = parseInt(fromGet.get("id"));
        let pecaData = await fetchPeca(id);
        document.getElementById('tipo').value = pecaData["tipo"]
        document.getElementById('preco').value = pecaData["price"]
        document.getElementById('descricao').value = pecaData["descricao"]
        document.getElementById('motoId').value = pecaData["id_motors"]
        document.getElementById('motoId').style = "display:none";
    }
}

async function editPeca(id) {
    const peca = {
        id: id,
        tipo: document.getElementById('tipo').value,
        price: document.getElementById('preco').value,
        descricao: document.getElementById('descricao').value,
        id_motors: document.getElementById('motoId').value,
    };
    let data = await fetch("http://localhost:8080/src/api/part", {
        method: "PUT",
        body: JSON.stringify(peca)
    }).then(resp => resp.text());
    console.log(data);
}

function detectType() {
    let fromGet = new URLSearchParams(window.location.search);
    if (fromGet.size != 0) {
        editPeca(fromGet.get("id"));
    } else {
        registraPeca();
    }
}