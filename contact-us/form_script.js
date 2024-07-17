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
            } else {
                alert('Error: ' + response.message);
            }
        } else {
            alert('An error occurred while submitting the form. Status: ' + xhr.status);
        }
    };
    
    xhr.onerror = function() {
        alert('An error occurred during the transaction.');
    };
    
    console.log('Sending form data...');
    xhr.send(formData);
});
