document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');
    const emailInput = document.getElementById('email');
    const senhaInput = document.getElementById('senha');

    loginForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        const email = emailInput.value.trim();
        const senha = senhaInput.value.trim();

        // Autenticação de usuário
        const loginValido = await autenticarUsuario(email, senha);
        if (loginValido) {
            window.location.href = "index.html";
        } else {
            alert('Credenciais inválidas. Tente novamente.');
            senhaInput.value = ''; // Limpa o campo de senha
        }
    });

    async function autenticarUsuario(email, senha) {
        try {
            const response = await fetch('http://localhost:5000/api/auth/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, senha })
            });

            if (response.ok) {
                return true; // Login bem-sucedido
            } else {
                return false; // Falha no login
            }
        } catch (error) {
            console.error('Erro na autenticação:', error);
            return false;
        }
    }
});
