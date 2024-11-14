async function registramoto() {
    const moto = {
        nome: document.getElementById('nome').value,
        mark: document.getElementById('marca').value,
        cylinder: document.getElementById('cilindrada').value,
        ano: document.getElementById('ano').value,
    };
    let data = await fetch("http://localhost:8080/src/api/motor", {
        method: "POST",
        body: JSON.stringify(moto)
    }).then(resp => resp.text());
}

async function fetchMotos() {
    let motos = await fetch(`http://localhost:8080/src/api/motor`, {
        method: "GET",
    }).then(response => response);
    return motos.json();
}

async function fetchMoto(id) {
    let motos = await fetch(`http://localhost:8080/src/api/motor?id=${id}`, {
        method: "GET",
    }).then(response => response);
    return motos.json();
}

async function removeMoto(meuId) {
    let data = await fetch("http://localhost:8080/src/api/motor", {
        method: "DELETE",
        body: JSON.stringify({
            id: meuId
        })
    }).then(resp => resp.text());
    window.location.reload();
}

async function carregarMotos() {
    const tabela = document.querySelector('#motoTable tbody');
    tabela.innerHTML = '';
    let dado = await fetchMotos();
    dado.forEach((moto) => {
        const linha = `<tr>
            <td>${moto.id}</td>
            <td>${moto.nome}</td>
            <td>${moto.mark}</td>
            <td>${moto.cylinder}</td>
            <td>${moto.ano}</td>
            <td><button onclick="removeMoto(${moto.id})">Deletar</button></td>
            <td><button onclick="window.location.href='/src/public/cadastromoto.html?id=${moto.id}'">Editar</button></td>
            <td><button onclick="window.location.href='/src/public/viewpeca.html?id=${moto.id}'">Visualizar</button></td>
        </tr>`;
        tabela.innerHTML += linha;
    });
}

carregarMotos()

async function onUpdate() {
    let fromGet = new URLSearchParams(window.location.search);
    if (fromGet.size != 0) {
        let id = parseInt(fromGet.get("id"));
        let motoData = await fetchMoto(id);
        document.getElementById('nome').value = motoData["nome"]
        document.getElementById('marca').value = motoData["mark"]
        document.getElementById('cilindrada').value = motoData["cylinder"]
        document.getElementById('ano').value = motoData["ano"]
    }
}

async function editMoto(id){
    const moto = {
        id: id,
        nome: document.getElementById('nome').value,
        mark: document.getElementById('marca').value,
        cylinder: document.getElementById('cilindrada').value,
        ano: document.getElementById('ano').value,
    };
    let data = await fetch("http://localhost:8080/src/api/motor", {
        method: "PUT",
        body: JSON.stringify(moto)
    }).then(resp => resp.text());
}

function detectType(){
    let fromGet = new URLSearchParams(window.location.search);
    if (fromGet.size != 0) {
        editMoto(fromGet.get("id"));
    }else {
        registramoto();
    }
}

onUpdate();