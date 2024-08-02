let divCrianca;
let formCrianca;
let fieldsetsCrianca;
let currentStep = 0;

divCrianca = document.getElementById("div-child");
formCrianca = divCrianca.querySelector('#multiStepForm');
fieldsetsCrianca = formCrianca.querySelectorAll('fieldset');

divAdulto = document.getElementById("div-adult");
formAdulto = divAdulto.querySelector('#multiStepForm');
fieldsetsAdulto = formAdulto.querySelectorAll('fieldset');

let globalFieldsets;

function showStep(step) {
  globalFieldsets.forEach((fieldset, index) => {
    fieldset.classList.toggle('active', index === step);
  });
}

function formAdult(){
  document.getElementById("decisao").classList.add("hidden");
  document.getElementById("div-adult").classList.remove("hidden")

  atual = "adult";
  globalFieldsets = fieldsetsAdulto;
}

function revertAdult(){
  document.getElementById("div-adult").classList.add("hidden");
  document.getElementById("decisao").classList.remove("hidden")
}

function formChild(){
  document.getElementById("decisao").classList.add("hidden");
  document.getElementById("div-child").classList.remove("hidden")
  
  atual = "child";
  globalFieldsets = fieldsetsCrianca;
}

function revertChild(){
  document.getElementById("div-child").classList.add("hidden");
  document.getElementById("decisao").classList.remove("hidden")
}

function validateStep(step) {
  const inputs = globalFieldsets[step].querySelectorAll('input');
  for (const input of inputs) {
    if (!input.checkValidity()) {
      input.reportValidity();
      return false;
    }
  }
  return true;
}

divCrianca.querySelector('#next1').addEventListener('click', function () {
  if (validateStep(currentStep)) {
    currentStep++;
    showStep(currentStep);
  }
});

divCrianca.querySelector('#next2').addEventListener('click', function () {
  if (validateStep(currentStep)) {
    currentStep++;
    showStep(currentStep);
  }
});

divCrianca.querySelector('#next3').addEventListener('click', function () {
  if (validateStep(currentStep)) {
    currentStep++;
    showStep(currentStep);
  }
});

divCrianca.querySelector('#prev2').addEventListener('click', function () {
  currentStep--;
  showStep(currentStep);
});

divCrianca.querySelector('#prev3').addEventListener('click', function () {
  currentStep--;
  showStep(currentStep);
});

divCrianca.querySelector('#prev4').addEventListener('click', function () {
  currentStep--;
  showStep(currentStep);
});

formCrianca.addEventListener('submit', function (event) {
  if (!validateStep(currentStep)) {
    event.preventDefault();
  }
});



divAdulto.querySelector('#next1').addEventListener('click', function () {
  if (validateStep(currentStep)) {
    currentStep++;
    showStep(currentStep);
  }
});

divAdulto.querySelector('#next2').addEventListener('click', function () {
  if (validateStep(currentStep)) {
    currentStep++;
    showStep(currentStep);
  }
});

divAdulto.querySelector('#next3').addEventListener('click', function () {
  if (validateStep(currentStep)) {
    currentStep++;
    showStep(currentStep);
  }
});

divAdulto.querySelector('#prev2').addEventListener('click', function () {
  currentStep--;
  showStep(currentStep);
});

divAdulto.querySelector('#prev3').addEventListener('click', function () {
  currentStep--;
  showStep(currentStep);
});

divAdulto.querySelector('#prev4').addEventListener('click', function () {
  currentStep--;
  showStep(currentStep);
});

formAdulto.addEventListener('submit', function (event) {
  if (!validateStep(currentStep)) {
    event.preventDefault();
  }
});
