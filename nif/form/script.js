//  declaração de variáveis

let currentStep = 0;
let allForms = [];
let etapa1 = 0;
let idiomaAtual;
const aTraduzir = document.querySelectorAll('.traduzir');
const formSteps = document.querySelectorAll('.form-step');
const formNumbers = document.querySelectorAll('.circulo');

const traducoesAlemao = [
`
    <!-- seletor de idiomas -->
    <button class="idioma-atual-desktop">
        <!-- alemão --><img class="icons-language" src ="/assets/images/countries/germany.png"> DE
    </button>

    <ul class="language-selector-content" >
        <!--português--><li><button class="opcao-idioma" onclick="traduzir('pt')"><img class="icons-language" src ="/assets/images/countries/portugal.png"> PT</button></li>
        <!--espanhol--><li><button class="opcao-idioma" onclick="traduzir('es')"><img class="icons-language" src ="/assets/images/countries/spain.png"> ES</button></li>
        <!--francês--><li><button class="opcao-idioma" onclick="traduzir('fr')"><img class="icons-language" src ="/assets/images/countries/france.png"> FR</button></li>
        <!--italiano--><li><button class="opcao-idioma" onclick="traduzir('it')"><img class="icons-language" src ="/assets/images/countries/italy.png"> IT</button></li>
        <!--inglês--><li><button class="opcao-idioma" onclick="traduzir('en')"><img class="icons-language" src ="/assets/images/countries/united-kingdom.png"> EN</button></li>
    </ul>
`,
"Persönliche Informationen",
"Vollständiger Name:",
"Telefon (mit Ländervorwahl):",
"Email:",
"Weiter",

"Alter",
`<input type="radio" name="idade" value="adulto"> Ich bin erwachsen`,
`<input type="radio" name="idade" value="crianca"> Ich bin ein Kind`,
"Zurück",
"Weiter",

"Dokumente",
"Haben Sie einen Personalausweis?",
`<input type="radio" name="passaporte" value="sim"> Ja`,
`<input type="radio" name="passaporte" value="nao"> Nein`,
"Zurück",
"Weiter",

"Haben Sie einen Adressnachweis?",
`<input type="radio" name="comprovante" value="sim"> Ja`,
`<input type="radio" name="comprovante" value="nao"> Nein`,
"Zurück",
"Weiter",

"Zahlung",
"Zurück",
"Weiter",

"Endgültige Details",
"Geburtsdatum:",
"Reisepass- oder Personalausweisnummer:",
"Ablaufdatum des Reisepasses oder Personalausweises:",
"Adresse:",
"Portugiesische NIF (falls zutreffend):",
"Name des Vaters:",
"Name der Mutter:",
"Zurück",
"Absenden"
];

const traducoesEspanhol = [
    `
    <!-- seletor de idiomas -->
    <button class="idioma-atual-desktop">
        <!-- espanhol --><img class="icons-language" src ="/assets/images/countries/spain.png"> ES
    </button>

    <ul class="language-selector-content" >
        <!--português--><li><button class="opcao-idioma" onclick="traduzir('pt')"><img class="icons-language" src ="/assets/images/countries/portugal.png"> PT</button></li>
        <!--alemão--><li><button class="opcao-idioma" onclick="traduzir('de')"><img class="icons-language" src ="/assets/images/countries/germany.png"> DE</button></li>
        <!--francês--><li><button class="opcao-idioma" onclick="traduzir('fr')"><img class="icons-language" src ="/assets/images/countries/france.png"> FR</button></li>
        <!--italiano--><li><button class="opcao-idioma" onclick="traduzir('it')"><img class="icons-language" src ="/assets/images/countries/italy.png"> IT</button></li>
        <!--inglês--><li><button class="opcao-idioma" onclick="traduzir('en')"><img class="icons-language" src ="/assets/images/countries/united-kingdom.png"> EN</button></li>
    </ul>
`,
"Información personal",
"Nombre completo:",
"Teléfono (con código del país):",
"Email:",
"Siguiente",

"Edad",
`<input type="radio" name="idade" value="adulto">  Soy adulto`,
`<input type="radio" name="idade" value="crianca"> Soy niño`,
"Anterior",
"Siguiente",

"Documentos",
"¿Tiene una tarjeta de identidad?",
`<input type="radio" name="passaporte" value="sim"> Sí`,
`<input type="radio" name="passaporte" value="nao"> No`,
"Anterior",
"Siguiente",

"¿Tiene una prueba de domicilio?",
`<input type="radio" name="comprovante" value="sim"> Sí`,
`<input type="radio" name="comprovante" value="nao"> No`,
"Anterior",
"Siguiente",

"Pago",
"Anterior",
"Siguiente",

"Detalles finales",
"Fecha de nacimiento:",
"Número de pasaporte o de tarjeta de identidad:",
"Fecha de vencimiento del pasaporte o tarjeta de identidad:",
"Dirección:",
"NIF portugués (si corresponde):",
"Nombre del padre:",
"Nombre de la madre:",
"Anterior",
"Enviar"
];

const traducoesItaliano = [
    `
    <!-- seletor de idiomas -->
    <button class="idioma-atual-desktop">
        <!-- italiano --><img class="icons-language" src ="/assets/images/countries/italy.png"> IT
    </button>

    <ul class="language-selector-content" >
        <!--português--><li><button class="opcao-idioma" onclick="traduzir('pt')"><img class="icons-language" src ="/assets/images/countries/portugal.png"> PT</button></li>
        <!--alemão--><li><button class="opcao-idioma" onclick="traduzir('de')"><img class="icons-language" src ="/assets/images/countries/germany.png"> DE</button></li>
        <!--francês--><li><button class="opcao-idioma" onclick="traduzir('fr')"><img class="icons-language" src ="/assets/images/countries/france.png"> FR</button></li>
        <!--espanhol--><li><button class="opcao-idioma" onclick="traduzir('es')"><img class="icons-language" src ="/assets/images/countries/spain.png"> ES</button></li>
        <!--inglês--><li><button class="opcao-idioma" onclick="traduzir('en')"><img class="icons-language" src ="/assets/images/countries/united-kingdom.png"> EN</button></li>
    </ul>
`,
"Informazioni personali",
"Nome e cognome:",
"Telefono (con prefisso internazionale):",
"Email:",
"Successivo",

"Età",
`<input type="radio" name="idade" value="adulto"> Sono un adulto`,
`<input type="radio" name="idade" value="crianca"> Sono un bambino`,
"Precedente",
"Successivo",

"Documenti",
"Hai una carta d'identità?",
`<input type="radio" name="passaporte" value="sim"> Sì`,
`<input type="radio" name="passaporte" value="nao"> No`,
"Precedente",
"Successivo",

"Hai una prova di indirizzo?",
`<input type="radio" name="comprovante" value="sim"> Sì`,
`<input type="radio" name="comprovante" value="nao"> No`,
"Precedente",
"Successivo",

"Pagamento",
"Precedente",
"Successivo",

"Dettagli finali",
"Data di nascita:",
"Numero del passaporto o della carta d'identità:",
"Data di scadenza del passaporto o della carta d'identità:",
"Indirizzo:",
"NIF portoghese (se applicabile):",
"Nome del padre:",
"Nome della madre:",
"Precedente",
"Invia"
];

const traducoesFrances = [
    `
    <!-- seletor de idiomas -->
    <button class="idioma-atual-desktop">
        <!-- francês --><img class="icons-language" src ="/assets/images/countries/france.png"> FR
    </button>

    <ul class="language-selector-content" >
        <!--português--><li><button class="opcao-idioma" onclick="traduzir('pt')"><img class="icons-language" src ="/assets/images/countries/portugal.png"> PT</button></li>
        <!--alemão--><li><button class="opcao-idioma" onclick="traduzir('de')"><img class="icons-language" src ="/assets/images/countries/germany.png"> DE</button></li>
        <!--italiano--><li><button class="opcao-idioma" onclick="traduzir('it')"><img class="icons-language" src ="/assets/images/countries/italy.png"> IT</button></li>
        <!--espanhol--><li><button class="opcao-idioma" onclick="traduzir('es')"><img class="icons-language" src ="/assets/images/countries/spain.png"> ES</button></li>
        <!--inglês--><li><button class="opcao-idioma" onclick="traduzir('en')"><img class="icons-language" src ="/assets/images/countries/united-kingdom.png"> EN</button></li>
    </ul>
`,
"Informations personnelles",
"Nom complet :",
"Téléphone (avec indicatif du pays) :",
"Email :",
"Suivant",

"Âge",
`<input type="radio" name="idade" value="adulto"> Je suis un adulte`,
`<input type="radio" name="idade" value="crianca"> Je suis un enfant`,
"Précédent",
"Suivant",

"Documents",
"Avez-vous une carte d'identité ?",
`<input type="radio" name="passaporte" value="sim"> Oui`,
`<input type="radio" name="passaporte" value="nao"> Non`,
"Précédent",
"Suivant",

"Avez-vous une preuve de domicile ?",
`<input type="radio" name="comprovante" value="sim"> Oui`,
`<input type="radio" name="comprovante" value="nao"> Non`,
"Précédent",
"Suivant",

"Paiement",
"Précédent",
"Suivant",

"Détails finaux",
"Date de naissance :",
"Numéro de passeport ou de carte d'identité :",
"Date d'expiration du passeport ou de la carte d'identité :",
"Adresse :",
"NIF portugais (si applicable) :",
"Nom du père :",
"Nom de la mère :",
"Précédent",
"Envoyer"
];

const traducoesPortugues = [
    `
    <!-- seletor de idiomas -->
    <button class="idioma-atual-desktop">
        <!-- português --><img class="icons-language" src ="/assets/images/countries/portugal.png"> PT
    </button>

    <ul class="language-selector-content" >
        <!--espanhol--><li><button class="opcao-idioma" onclick="traduzir('es')"><img class="icons-language" src ="/assets/images/countries/spain.png"> ES</button></li>
        <!--alemão--><li><button class="opcao-idioma" onclick="traduzir('de')"><img class="icons-language" src ="/assets/images/countries/germany.png"> DE</button></li>
        <!--francês--><li><button class="opcao-idioma" onclick="traduzir('fr')"><img class="icons-language" src ="/assets/images/countries/france.png"> FR</button></li>
        <!--italiano--><li><button class="opcao-idioma" onclick="traduzir('it')"><img class="icons-language" src ="/assets/images/countries/italy.png"> IT</button></li>
        <!--inglês--><li><button class="opcao-idioma" onclick="traduzir('en')"><img class="icons-language" src ="/assets/images/countries/united-kingdom.png"> EN</button></li>
    </ul>
`,
"Informações Pessoais",
"Nome completo:",
"Telefone (com código do país):",
"Email:",
"Próximo",

"Idade",
`<input type="radio" name="idade" value="adulto">  Sou adulto`,
`<input type="radio" name="idade" value="crianca"> Sou criança`,
"Anterior",
"Próximo",

"Documentos",
"Você possui um cartão de identidade?",
`<input type="radio" name="passaporte" value="sim"> Sim`,
`<input type="radio" name="passaporte" value="nao"> Não`,
"Anterior",
"Próximo",

"Você possui um comprovante de endereço?",
`<input type="radio" name="comprovante" value="sim"> Sim`,
`<input type="radio" name="comprovante" value="nao"> Não`,
"Anterior",
"Próximo",

"Pagamento",
"Anterior",
"Próximo",

"Detalhes finais",
"Data de nascimento:",
"Número de passaporte ou bilhete de identidade:",
"Data de Validade do Passaporte ou Bilhete de Identidade",
"Endereço:",
"NIF português (se tiver):",
"Nome do pai:",
"Nome da mãe:",
"Anterior",
"Enviar"
];

// declaração de funções

function traduzir(idioma){

    idiomaAtual = idioma;

    if(idioma == "en"){
        for (let i = 0; i < aTraduzir.length && i < traducoesIngles.length; i++) {
            aTraduzir[i].innerHTML = traducoesIngles[i];
        }
    }
    
    else if(idioma == "de"){
        for (let i = 0; i < aTraduzir.length && i < traducoesAlemao.length; i++) {
            aTraduzir[i].innerHTML = traducoesAlemao[i];
        }
    }
    
    else if(idioma == "es"){
        for (let i = 0; i < aTraduzir.length && i < traducoesEspanhol.length; i++) {
            aTraduzir[i].innerHTML = traducoesEspanhol[i];
        }
    }
    
    else if(idioma == "it"){
        for (let i = 0; i < aTraduzir.length && i < traducoesItaliano.length; i++) {
            aTraduzir[i].innerHTML = traducoesItaliano[i];
        }
    }
    
    else if(idioma == "fr"){
        for (let i = 0; i < aTraduzir.length && i < traducoesFrances.length; i++) {
            aTraduzir[i].innerHTML = traducoesFrances[i];
        }
    }
    
    else if(idioma == "pt"){
        for (let i = 0; i < aTraduzir.length && i < traducoesPortugues.length; i++) {
            aTraduzir[i].innerHTML = traducoesPortugues[i];
        }
    }

}

function showStep(step) {
    console.log("showStep(" + step + ")\n")
    formSteps.forEach((stepElement, index) => {
        stepElement.style.display = index === step ? 'block' : 'none';
    });
    formNumbers.forEach((stepNumber, index) => {
        stepNumber.style.backgroundColor = index === step ? 'rgba(9,54,121,1)' : 'aliceblue';
        stepNumber.style.color = index === step ? 'aliceblue' : 'rgba(9,54,121,1)';
    });
}

function nextStep() {
    console.log("nextStep() \n")
    if (currentStep < formSteps.length - 1) {
        currentStep++;
        showStep(currentStep);
    }
}

function prevStep() {
    console.log("prevStep() \n")
    if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
    }
}

function goStep(number){
    console.log("goStep() \n")
    currentStep = number
    showStep(currentStep)
}

function handleAge(event) {
    ageValue = '';

    console.log("handleAge() \n")
    event.preventDefault();
    const form = event.target;
    allForms.push(form)

    var ageValue = form.querySelector('input[name="idade"]:checked').value;
    
    if (ageValue === 'adulto') {
        handleAdult(form);
    } else if (ageValue === 'crianca') {
        handleChild(form);
    }

    ageValue = '';
}

function handleAdult(form){
    document.getElementById("adulto-crianca-1").innerHTML = `
    <label for="passaporteOuId" class="traduzir">Anexe seu passaporte (ou cartão de identidade, caso seja cidadão europeu):</label>
    <input type="file" id="passaporteOuId" name="passaporteOuId" required>

    <br><br>

    <label for="comprovanteEndereco" class="traduzir">Anexe seu comprovante de endereço</label>
    <input type="file" id="comprovanteEndereco" name="comprovanteEndereco" required>
    
    <br><br>

    <button type="button" onclick="prevStep()" class="traduzir">Previous</button>
    <button type="submit" class="traduzir">Next</button>
    `

    document.getElementById("adulto-crianca-2").innerHTML = `
    <h2 class="traduzir">Final details</h2>
    
    <label for="dataNascimento" class="traduzir">Date of Birth:</label>
    <input type="date" id="dataNascimento" name="dataNascimento" required="">
    
    <label for="numPassaporteOuId" class="traduzir">Passport or ID card number:</label>
    <input type="text" id="numPassaporteOuId" name="numPassaporteOuId" required="">
    
    <label for="validadePassaporteOuId" class="traduzir">Passport or ID card Expiry Date:</label>
    <input type="date" id="validadePassaporteOuId" name="validadePassaporteOuId" required="">
    
    <label for="endereco" class="traduzir">Address:</label>
    <input type="text" id="endereco" name="endereco" required="">
    
    <button type="button" onclick="prevStep()" class="traduzir">Previous</button>
    <button type="submit" class="traduzir">Next</button>
    `

    if (form.checkValidity()) {
        nextStep();
    } else {
        form.reportValidity();
    }
}

function handleChild(form){
    console.log("handleChild()")
    document.getElementById("adulto-crianca-1").innerHTML = `
    <label for="passaporteOuIdCrianca" class="traduzir">Anexe o passaporte da criança (caso seja cidadão europeu, pode anexar o cartão de identidade):</label>
    <input type="file" id="passaporteOuIdCrianca" name="passaporteOuIdCrianca" required>

    <br><br>

    <label for="passaporteOuIdResponsavel" class="traduzir">Anexe o passaporte do responsável da criança (caso seja cidadão europeu, pode anexar o cartão de identidade):</label>
    <input type="file" id="passaporteOuIdResponsavel" name="passaporteOuIdResponsavel" required>

    <br><br>

    <label for="comprovanteEndereco" class="traduzir">Anexe o comprovante de endereço</label>
    <input type="file" id="comprovanteEndereco" name="comprovanteEndereco" required>
    
    <br><br>

    <button type="button" onclick="prevStep()" class="traduzir">Previous</button>
    <button type="submit" class="traduzir">Next</button>
    `

    document.getElementById("adulto-crianca-2").innerHTML = `
    <h2 class="traduzir">Final details</h2>
    
    <!-- info sobre a criança -->
    
    <label for="dataNascimentoCrianca" class="traduzir">Data de nascimento da criança:</label>
    <input type="date" id="dataNascimentoCrianca" name="dataNascimentoCrianca" required="">
    
    <label for="numPassaporteOuIdCrianca" class="traduzir">nº do passaporte ou cartão de identidade da criança:</label>
    <input type="text" id="numPassaporteOuIdCrianca" name="numPassaporteOuIdCrianca" required="">
    
    <label for="validadePassaporteOuIdCrianca" class="traduzir">Data de validade do passaporte ou cartão de identidade da criança:</label>
    <input type="date" id="validadePassaporteOuIdCrianca" name="validadePassaporteOuIdCrianca" required="">

    <!-- info sobre o responsável da criança -->

    <label for="dataNascimentoResponsavel" class="traduzir">Data de nascimento do responsável:</label>
    <input type="date" id="dataNascimentoResponsavel" name="dataNascimentoResponsavel" required="">
    
    <label for="numPassaporteOuIdResponsavel" class="traduzir">nº do passaporte ou cartão de identidade do responsável:</label>
    <input type="text" id="numPassaporteOuIdResponsavel" name="numPassaporteOuIdResponsavel" required="">
    
    <label for="validadePassaporteOuIdResponsavel" class="traduzir">Data de validade do passaporte ou cartão de identidade do responsável:</label>
    <input type="date" id="validadePassaporteOuIdResponsavel" name="validadePassaporteOuIdResponsavel" required="">
    
    <!-- presumimos que os dois moram no mesmo endereço -->

    <label for="endereco" class="traduzir">Address:</label>
    <input type="text" id="endereco" name="endereco" required="">
    
    <button type="button" onclick="prevStep()" class="traduzir">Previous</button>
    <button type="submit" class="traduzir">Next</button>
    `

    if (form.checkValidity()) {
        nextStep();
    } else {
        form.reportValidity();
    }
}

function handleNext(event) {
    console.log("handleNext() \n")
    event.preventDefault();
    const form = event.target;
    allForms.push(form)

    if (form.checkValidity()) {
        nextStep();
    } else {
        form.reportValidity();
    }
}

function handleSubmit(event) {
    console.log("handleSubmit() \n")
    event.preventDefault();
    const form = event.target;
    allForms.push(form)

    if (form.checkValidity()) {
        alert('Formulário enviado com sucesso!');
    } else {
        form.reportValidity();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    showStep(currentStep);
});

// window.addEventListener('beforeunload', function (event) {
//     var mensagem = "Tem certeza que deseja sair desta página? Você perderá o seu progresso.";
//     event.returnValue = mensagem; // Padrão para a maioria dos navegadores
//     return mensagem; // Para o Chrome
// });

showStep(currentStep);