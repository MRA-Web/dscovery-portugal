document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita o envio padrão do formulário
    
    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    
    xhr.open('POST', 'process_form.php', true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                // Exibe o conteúdo da resposta para depuração
                console.log('Resposta do servidor:', xhr.responseText);
                const response = JSON.parse(xhr.responseText);
                
                if (response.status === 'success') {
                    document.getElementById('contactForm').reset(); // Limpa os campos do formulário
                    console.log('Formulário enviado com sucesso!');
                } else {
                    console.error('Erro na resposta do servidor: ' + response.message);
                }
            } catch (e) {
                console.error('Erro ao processar a resposta: ' + e.message);
                console.error('Conteúdo da resposta que causou o erro:', xhr.responseText);
            }
        } else {
            console.error('Ocorreu um erro ao enviar o formulário. Status: ' + xhr.status);
            console.error('Resposta do servidor:', xhr.responseText);
        }
    };
    
    xhr.onerror = function() {
        console.error('Falha na requisição. Tente novamente mais tarde.');
    };
    
    xhr.send(formData);
});
