document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('multiStepForm');
  const fieldsets = form.querySelectorAll('fieldset');
  let currentStep = 0;

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

  document.getElementById('next1').addEventListener('click', function () {
    if (validateStep(currentStep)) {
      currentStep++;
      showStep(currentStep);
    }
  });

  document.getElementById('next2').addEventListener('click', function () {
    if (validateStep(currentStep)) {
      currentStep++;
      showStep(currentStep);
    }
  });

  document.getElementById('prev2').addEventListener('click', function () {
    currentStep--;
    showStep(currentStep);
  });

  document.getElementById('prev3').addEventListener('click', function () {
    currentStep--;
    showStep(currentStep);
  });

  form.addEventListener('submit', function (event) {
    if (!validateStep(currentStep)) {
      event.preventDefault();
    }
  });
});