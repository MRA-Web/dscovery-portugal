function enviarFormulario(event) {
    event.preventDefault();

    const form = document.querySelector('form');
    const formData = new FormData(form);

    fetch('process_form.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            form.reset(); // Esvazia os campos do formulário
            alert('Mensagem enviada com sucesso!'); // Opcional: Mostra uma mensagem de sucesso
        } else {
            alert('Erro ao enviar a mensagem: ' + data.message);
        }
    })
    .catch(error => {
        alert('Erro ao enviar a mensagem: ' + error);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('form').addEventListener('submit', enviarFormulario);
});