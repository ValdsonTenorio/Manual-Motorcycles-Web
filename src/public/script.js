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

async function fetchMotos(){
    let motos = await fetch(`http://localhost:8080/src/api/motor`,{
        method: "GET",
    }).then(response => response);
    return motos.json();
}

async function removeMoto(meuId){
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
            <td>${moto.nome}</td>
            <td>${moto.mark}</td>
            <td>${moto.cylinder}</td>
            <td>${moto.ano}</td>
            <td><button onclick="removeMoto(${moto.id})">Deletar</button></td>
            <td><button onclick="">Editar</button></td>
            <td><button onclick="window.location.href='/src/public/viewpeca.html'">Visualizar</button></td>
        </tr>`;
        tabela.innerHTML += linha;
    });
}

carregarMotos()