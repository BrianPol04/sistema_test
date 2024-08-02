function classify() {
    // Obtener los valores ingresados por el usuario
    const answers = [
        { day: document.getElementById('Wednesday').value, month: document.getElementById('June').value },
        { day: document.getElementById('Friday').value, month: document.getElementById('November').value },
        { day: document.getElementById('Saturday').value, month: document.getElementById('August').value },
        { day: document.getElementById('Tuesday').value, month: document.getElementById('March').value },
        { day: document.getElementById('Monday').value, month: document.getElementById('January').value }
    ];

    // Respuestas correctas (debes ajustar estas respuestas según tu contenido)
    const correctAnswers = [
        { day: 'wednesday', month: 'june' },
        { day: 'friday', month: 'november' },
        { day: 'saturday', month: 'august' },
        { day: 'tuesday', month: 'march' },
        { day: 'monday', month: 'january' }
    ];

    // Validar respuestas
    answers.forEach((answer, index) => {
        const correctAnswer = correctAnswers[index];
        const isCorrect = (answer.day.trim() === correctAnswer.day) && (answer.month.trim().toLowerCase() === correctAnswer.month.toLowerCase());

        document.getElementById(`img${index + 1}-correct`).hidden = !isCorrect;
        document.getElementById(`img${index + 1}-incorrect`).hidden = isCorrect;
    });
}

function resetTest() {
    // Resetear los campos de texto
    const inputs = document.querySelectorAll('.textbox');
    inputs.forEach(input => {
        input.value = '';
    });

    // Ocultar las imágenes de feedback
    const feedbackImages = document.querySelectorAll('.feedback-img');
    feedbackImages.forEach(img => {
        img.hidden = true;
    });
}
