document.addEventListener('DOMContentLoaded', function () {
    // Seleciona o formulário
    const form = document.getElementById('contactForm');

    // Adiciona um ouvinte de evento para o envio do formulário
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        // Coleta os dados do formulário
        const name = document.getElementById('name').value.trim();
        const tel = document.getElementById('tel').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();

        // Verifica se todos os campos obrigatórios estão preenchidos
        if (name === '' || email === '' || message === '') {
            alert('Por favor, preencha todos os campos obrigatórios.');
            return;
        }

        // Valida o formato do e-mail
        if (!validateEmail(email)) {
            alert('O e-mail fornecido é inválido.');
            return;
        }

        // Cria um objeto FormData para enviar os dados do formulário
        const formData = new FormData(form);

        // Envia os dados usando Fetch API
        fetch('process_form.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Sua mensagem foi enviada com sucesso!');
                form.reset(); // Limpa o formulário
            } else {
                alert('Erro ao enviar a mensagem: ' + data.message);
            }
        })
        .catch(error => {
            alert('Erro ao enviar a mensagem: ' + error.message);
        });
    });

    // Função para validar o formato do e-mail
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});
