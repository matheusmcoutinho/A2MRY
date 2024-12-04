document.getElementById('cadastro-form').addEventListener('submit', function(event) {
    const senha = document.getElementById('senha').value;
    const confirmSenha = document.getElementById('confirm-senha').value;

    if (senha !== confirmSenha) {
        event.preventDefault(); // Impede o envio do formulário
        document.querySelector('.erro-senha').style.display = 'block'; // Mostra a mensagem de erro
    }
});
