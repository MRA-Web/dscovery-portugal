document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_form.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                document.getElementById('contactForm').reset(); // Limpa os campos do formulário
                alert('Formulário enviado com sucesso!');
            } else {
                alert('Erro: ' + response.message);
            }
        } else {
            alert('Ocorreu um erro ao enviar o formulário.');
        }
    };
    xhr.send(formData);
});
