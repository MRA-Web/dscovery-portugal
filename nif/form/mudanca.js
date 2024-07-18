let divEscolhida;
let form;
let fieldsets;
let currentStep = 0;


function formAdult(){
  document.getElementById("decisao").classList.add("hidden");
  document.getElementById("div-adult").classList.remove("hidden")

  atual = "adult";
  start("#div-adult");
}

function revertAdult(){
  document.getElementById("div-adult").classList.add("hidden");
  document.getElementById("decisao").classList.remove("hidden")
}

function formChild(){
  document.getElementById("decisao").classList.add("hidden");
  document.getElementById("div-child").classList.remove("hidden")
  
  atual = "child";
  start("#div-child");
}

function revertChild(){
  document.getElementById("div-child").classList.add("hidden");
  document.getElementById("decisao").classList.remove("hidden")
}

function start(choice) {
  divEscolhida = document.querySelector(choice);
  form = divEscolhida.querySelector('#multiStepForm');
  fieldsets = form.querySelectorAll('fieldset');
  currentStep = 0;

  for(let i = 0; i < fieldsets.length; i++){
    console.log(fieldsets[i]);
  }
}


function showStep(step) {
  fieldsets.forEach((fieldset, index) => {
    fieldset.classList.toggle('active', index === step);
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
