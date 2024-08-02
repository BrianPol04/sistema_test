function checkTest() {
    const answers = {
        q1: 'does',
        q2: 'does',
        q3: 'do',
        q4: 'do',
        q5: 'does'
    };

    let correct = 0;
    let total = 5;

    for (let i = 1; i <= total; i++) {
        const answer = document.getElementById(`q${i}`).value.trim().toLowerCase();
        const correctAnswer = answers[`q${i}`];
        const questionElement = document.getElementById(`q${i}`);

        if (answer === correctAnswer) {
            correct++;
            questionElement.style.borderColor = 'green';
            questionElement.style.backgroundImage = 'url(correcto.png)';
            questionElement.style.backgroundRepeat = 'no-repeat';
            questionElement.style.backgroundPosition = 'right';
        } else {
            questionElement.style.borderColor = 'red';
            questionElement.style.backgroundImage = 'url(incorrecto.png)';
            questionElement.style.backgroundRepeat = 'no-repeat';
            questionElement.style.backgroundPosition = 'right';
        }
    }

    const resultsElement = document.getElementById('results');
    resultsElement.textContent = `Has acertado ${correct} de ${total} preguntas.`;
}

function resetTest() {
    for (let i = 1; i <= 5; i++) {
        const questionElement = document.getElementById(`q${i}`);
        questionElement.value = '';
        questionElement.style.borderColor = '#ccc';
        questionElement.style.backgroundImage = 'none';
    }

    const resultsElement = document.getElementById('results');
    resultsElement.textContent = '';
}
