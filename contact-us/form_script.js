document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita o envio padrão do formulário
    
    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    
    xhr.open('POST', 'process_form.php', true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    document.getElementById('contactForm').reset(); // Limpa os campos do formulário
                    alert('Formulário enviado com sucesso!');
                } else {
                    alert('Error: ' + response.message);
                }
            } catch (e) {
                alert('Erro ao processar a resposta: ' + e.message);
            }
        } else {
            alert('An error occurred while submitting the form. Status: ' + xhr.status);
        }
    };
    
    xhr.onerror = function() {
        alert('Request failed. Please try again later.');
    };
    
    xhr.send(formData);
});
