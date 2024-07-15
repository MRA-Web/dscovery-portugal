document.addEventListener('DOMContentLoaded', () => {
  const blockQuestions = document.querySelectorAll('.block-question');

  blockQuestions.forEach((blockQuestion) => {
    const question = blockQuestion.querySelector('.question');
    const answer = blockQuestion.querySelector('.answer');

    // Oculta todas as respostas ao carregar a página
    answer.style.maxHeight = '0';
    answer.style.padding = '0 10px';

    question.addEventListener('click', () => {
      const isActive = blockQuestion.classList.contains('active');

      // Fecha todas as respostas antes de abrir a clicada
      blockQuestions.forEach((item) => {
        item.classList.remove('active');
        item.querySelector('.answer').style.maxHeight = '0';
        item.querySelector('.answer').style.padding = '0 10px';
      });

      // Abre a resposta apenas se não estiver ativa
      if (!isActive) {
        blockQuestion.classList.add('active');
        answer.style.maxHeight = answer.scrollHeight + 'px';
        answer.style.padding = '10px';
      }
    });
  });
});
