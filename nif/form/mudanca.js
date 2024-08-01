let divEscolhida;
let form;
let fieldsets;
let currentStep = 0;
let circulos = document.querySelectorAll(".circulo");

circulos[0].classList.add("active");

function formAdult(){
  document.getElementById("decisao").classList.add("hidden");
  document.getElementById("div-adult").classList.remove("hidden")

  atual = "adult";
  start("#div-adult");
}

function revertAdult(){
  document.getElementById("div-adult").classList.add("hidden");
  document.getElementById("decisao").classList.remove("hidden");

  circulos[0].classList.add("active");
  circulos[1].classList.remove("active");

  divEscolhida = 0;
  form = 0;
  fieldsets = 0;
  currentStep = 0;
}

function formChild(){
  document.getElementById("decisao").classList.add("hidden");
  document.getElementById("div-child").classList.remove("hidden")
  
  atual = "child";
  start("#div-child");
}

function revertChild(){
  document.getElementById("div-child").classList.add("hidden");
  document.getElementById("decisao").classList.remove("hidden");

  circulos[0].classList.add("active");
  circulos[1].classList.remove("active");

  divEscolhida = 0;
  form = 0;
  fieldsets = 0;
  currentStep = 0;
}

function start(choice) {
  divEscolhida = document.querySelector(choice);
  form = divEscolhida.querySelector('#multiStepForm');
  fieldsets = form.querySelectorAll('fieldset');
  currentStep = 0;

  circulos[0].classList.remove("active");
  circulos[1].classList.add("active");

  // for(let i = 0; i < fieldsets.length; i++){
  //   console.log(fieldsets[i]);
  // }

  function showStep(step) {
    console.log("tentando mostrar o passo " + step);
    console.log(fieldsets[step])
    console.log("esse é o passo")

    console.log("\n\n\n\n")
    fieldsets.forEach((fieldset, index) => {
      fieldset.classList.toggle('active', index === step);
    }); 

    circulos.forEach((circulo, index) => {
      circulo.classList.toggle('active', index === step+1);
    });

  }

  function validateStep(step) {
    const inputs = fieldsets[step].querySelectorAll('input');
    for (const input of inputs) {
      if (!input.checkValidity()) {
        input.reportValidity();
        return false;
      }
    }
    return true;
  }

  divEscolhida.querySelector('#next1').addEventListener('click', function () {
    if (validateStep(currentStep)) {
      currentStep++;
      showStep(currentStep);
    }
  });

  divEscolhida.querySelector('#next2').addEventListener('click', function () {
    if (validateStep(currentStep)) {
      currentStep++;
      showStep(currentStep);
    }
  });

  divEscolhida.querySelector('#next3').addEventListener('click', function () {
    if (validateStep(currentStep)) {
      currentStep++;
      showStep(currentStep);
    }
  });

  divEscolhida.querySelector('#prev2').addEventListener('click', function () {
    currentStep--;
    showStep(currentStep);
  });

  divEscolhida.querySelector('#prev3').addEventListener('click', function () {
    currentStep--;
    showStep(currentStep);
  });

  divEscolhida.querySelector('#prev4').addEventListener('click', function () {
    currentStep--;
    showStep(currentStep);
  });

  form.addEventListener('submit', function (event) {
    if (!validateStep(currentStep)) {
      event.preventDefault();
    }
  });
}

// window.addEventListener('beforeunload', function (event) {
//     var mensagem = "Tem certeza que deseja sair desta página? Você perderá o seu progresso.";
//     event.returnValue = mensagem; // Padrão para a maioria dos navegadores
//     return mensagem; // Para o Chrome
// });