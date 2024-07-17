document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_form.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    document.getElementById('contactForm').reset(); // Limpa os campos do formulário
                    alert(response.message); // Exibe a mensagem de sucesso
                } else {
                    alert('Error: ' + response.message); // Exibe a mensagem de erro
                }
            } catch (e) {
                alert('Error parsing JSON response.'); // Exibe erro de análise JSON
            }
        } else {
            alert('An error occurred while submitting the form.');
        }
    };
    xhr.onerror = function() {
        alert('An error occurred while submitting the form.');
    };
    xhr.send(formData);
});
