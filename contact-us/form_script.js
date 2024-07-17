document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_form.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log(xhr.responseText); // Exibe a resposta completa para depuração
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    document.getElementById('contactForm').reset(); // Limpa os campos do formulário
                    alert(response.message); // Exibe a mensagem de sucesso
                } else {
                    alert('Error: ' + response.message); // Exibe a mensagem de erro
                }
            } catch (e) {
                alert('Error parsing JSON response: ' + e.message); // Exibe erro de análise JSON
            }
        } else {
            alert('An error occurred while submitting the form. Status: ' + xhr.status); // Exibe erro com o status
        }
    };
    xhr.onerror = function() {
        alert('Request failed.'); // Mensagem de falha na requisição
    };
    xhr.send(formData);
});
