// Função para carregar os detalhes do usuário
async function carregarUsuario() {
    const token = localStorage.getItem('token');
    const urlParams = new URLSearchParams(window.location.search);
    const userId = urlParams.get('id');

    if (!userId) {
        mostrarErro('ID do usuário não fornecido.');
        return;
    }

    if (!token) {
        mostrarErro('Você precisa estar logado para visualizar os detalhes do usuário.');
        mostrarBotaoLogin();
        return;
    }

    try {
        const response = await fetch(`http://localhost:8000/api/user/${userId}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
            },
        });

        if (response.ok) {
            const usuario = await response.json();
            mostrarDetalhes(usuario);
        } else {
            throw new Error('Erro ao buscar os detalhes do usuário.');
        }
    } catch (error) {
        console.error('Erro:', error);
        mostrarErro('Erro ao carregar os detalhes do usuário.');
    }
}

// Função para mostrar os detalhes do usuário
function mostrarDetalhes(usuario) {
    document.getElementById('usuarioNome').textContent = usuario.name;
    document.getElementById('usuarioEmail').textContent = usuario.email;
    const dataCriacao = new Date(usuario.created_at);
    const dataFormatada = dataCriacao.toLocaleString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false // Formato 24 horas
    });
    document.getElementById('usuarioDataCriacao').textContent = `Criado em: ${dataFormatada}`;
    document.getElementById('usuarioDetalhes').classList.remove('d-none');
}

// Função para mostrar mensagem de erro
function mostrarErro(mensagem) {
    const mensagemErro = document.getElementById('mensagemErro');
    mensagemErro.textContent = mensagem;
    mensagemErro.classList.remove('d-none');
}

// Função para mostrar botão de login
function mostrarBotaoLogin() {
    const loginBtn = document.getElementById('loginBtn');
    loginBtn.classList.remove('d-none');
    loginBtn.addEventListener('click', () => {
        window.location.href = 'login.html'; // Redireciona para a página de login
    });
}

// Função para voltar à página anterior
document.getElementById('voltarBtn').addEventListener('click', function() {
    window.history.back();
});

// Chama a função para carregar o usuário ao carregar a página
document.addEventListener('DOMContentLoaded', carregarUsuario);
