// Função lambda para calcular a média
const calcularMedia = (notas) => {
    const total = notas.reduce((acc, nota) => acc + nota, 0);
    return total / notas.length;
};

// Função flecha para verificar se o aluno foi aprovado ou reprovado
const verificarStatus = (media) => (media >= 6 ? "Aprovado" : "Reprovado");

// Método de vetores para ordenar as notas
const ordenarNotas = (notas) => notas.sort((a, b) => b - a);

// Função principal
const main = () => {
    const notas = [];
    const quantidadeNotas = parseInt(prompt("Quantas notas você quer inserir?"));

    // Loop para receber as notas
    for (let i = 0; i < quantidadeNotas; i++) {
        const nota = parseFloat(prompt(`Insira a nota ${i + 1}:`));
        notas.push(nota);
    }

    // Calculando a média
    const media = calcularMedia(notas);
    console.log("Notas:", notas);
    console.log("Média:", media.toFixed(2));

    // Verificando o status do aluno
    const status = verificarStatus(media);
    console.log("Status:", status);

    // Ordenando as notas
    const notasOrdenadas = ordenarNotas(notas);
    console.log("Notas Ordenadas:", notasOrdenadas);
};

// Chamando a função principal
main();