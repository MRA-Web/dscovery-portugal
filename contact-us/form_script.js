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
            alert('An error occurred while submitting the form.');
        }
    };
    xhr.send(formData);
});


document.addEventListener('DOMContentLoaded', function() {
    // Inicialize o EmailJS com sua chave pública
    emailjs.init('mH7Y-YFYHmYbEO9h7');  // Substitua pela sua chave pública

    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        var form = document.getElementById("contactForm");
        var nome = form.querySelector('input[name="name"]').value;
        var telefone = form.querySelector('input[name="tel"]').value;
        var email = form.querySelector('input[name="email"]').value;
        var assunto = form.querySelector('input[name="subject"]').value;
        var mensagem = form.querySelector('textarea[name="message"]').value;

        generateAndSendPDF(nome, telefone, email, assunto, mensagem);
    });

    const { jsPDF } = window.jspdf;

    function generateAndSendPDF(nome, telefone, email, assunto, mensagem) {
        var doc = new jsPDF();
        doc.text("Nome: " + nome, 10, 10);
        doc.text("Telefone: " + telefone, 10, 20);
        doc.text("Email: " + email, 10, 30);
        doc.text("Assunto: " + assunto, 10, 40);
        doc.text("Mensagem: " + mensagem, 10, 50);

        var pdfBlob = doc.output('blob');
        sendEmail(pdfBlob, nome, telefone, email, assunto, mensagem);
    }

    function sendEmail(pdfBlob, nome, telefone, email, assunto, mensagem) {
        var reader = new FileReader();
        reader.readAsDataURL(pdfBlob);
        reader.onloadend = function() {
            var base64data = reader.result.split(',')[1];
    
            var templateParams = {
                to_email: email, // O e-mail do destinatário
                name: nome,
                tel: telefone,
                subject: assunto,
                message: mensagem,
                pdf: base64data // Se o template suportar anexos
            };
    
            emailjs.send('service_9skp7pg', 'template_25j1jmr', templateParams)
                .then(function(response) {
                    console.log('Email enviado com sucesso!', response.status, response.text);
                }, function(error) {
                    console.error('Falha ao enviar o email.', error);
                });
        };
    }
    
});
