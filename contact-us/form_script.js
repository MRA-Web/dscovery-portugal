xhr.onload = function() {
    if (xhr.status === 200) {
        console.log(xhr.responseText); // Adicione esta linha para ver a resposta completa no console
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
