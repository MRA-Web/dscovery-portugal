const btGerador = document.querySelector("#generate-pdf");

btGerador.addEventListener("click", () => {

  // conteudo do pdf

  const form = document.getElementById("formulario");
  const content = form.querySelector('input[name="palavra"]').value;

  // configuracao

  const options = {
    margin: [10, 10, 10, 10],
    filename: "resultado.pdf",
    html2canvas: {scale: 6},
    jsPDF: {unit: "mm", format: "a4", orientation: "portrait"}
  }

  // gerar e baixar pdf

  html2pdf().set(options).from(content).save();
})