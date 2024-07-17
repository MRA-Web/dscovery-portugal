document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    
    // Altere 'process_form.php' para o caminho correto, se necessário
    xhr.open('POST', 'process_form.php', true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    document.getElementById('contactForm').reset(); // Limpa os campos do formulário
                    alert('Form submitted successfully!');
                } else {
                    alert('Error: ' + response.message);
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
                alert('Received an unexpected response from the server.');
            }
        } else {
            alert('An error occurred while submitting the form. Status: ' + xhr.status);
        }
    };
    
    xhr.onerror = function() {
        alert('Request failed. Please check your connection.');
    };
    
    xhr.send(formData);
});
