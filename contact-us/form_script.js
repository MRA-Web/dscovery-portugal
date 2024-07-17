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
                alert('Your message has been sent successfully!');
                // Você pode adicionar uma mensagem de sucesso no HTML se preferir
            } else {
                alert('Error: ' + response.message);
            }
        } else {
            alert('An error occurred while submitting the form.');
        }
    };

    xhr.onerror = function() {
        alert('Network error occurred. Please try again later.');
    };

    xhr.send(formData);
});
