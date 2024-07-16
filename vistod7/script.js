document.addEventListener("DOMContentLoaded", () => {
  const blockQuestions = document.querySelectorAll(".block-question");

  blockQuestions.forEach((blockQuestion) => {
    const question = blockQuestion.querySelector(".question");
    const answer = blockQuestion.querySelector(".answer");
    const icon = question.querySelector(".icon"); // Seleciona a setinha

    
    answer.style.maxHeight = "0";
    answer.style.padding = "0 10px";

    question.addEventListener("click", () => {
      const isActive = blockQuestion.classList.contains("active");

      blockQuestions.forEach((item) => {
        item.classList.remove("active");
        item.querySelector(".answer").style.maxHeight = "0";
        item.querySelector(".answer").style.padding = "0 10px";
        item.querySelector(".icon").style.transform = "rotate(0deg)"; // Reseta a rotação da setinha
      });

      if (!isActive) {
        blockQuestion.classList.add("active");
        answer.style.maxHeight = answer.scrollHeight + "px";
        answer.style.padding = "10px";
        icon.style.transform = "rotate(90deg)"; // Gira a setinha
      }
    });
  });
});
