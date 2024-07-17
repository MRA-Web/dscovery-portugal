document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_form.php', true); // Altere 'process_form.php' para o caminho real do seu arquivo

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
                console.error('Error parsing JSON response:', e);
                alert('Error parsing JSON response.');
            }
        } else {
            alert('An error occurred while submitting the form.');
        }
    };
    xhr.send(formData);
});
