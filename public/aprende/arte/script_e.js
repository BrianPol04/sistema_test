function checkTest() {
    const answers = {
        q1: 'b',
        q2: 'c',
        q3: 'b',
        q4: 'b',
        q5: 'b'
    };

    let correct = 0;
    let total = 5;

    for (let i = 1; i <= total; i++) {
        const radios = document.getElementsByName(`q${i}`);
        let userAnswer = '';

        radios.forEach((radio) => {
            if (radio.checked) {
                userAnswer = radio.value;
            }
        });

        const correctAnswer = answers[`q${i}`];
        const questionElement = document.querySelector(`input[name="q${i}"]:checked`);

        if (userAnswer === correctAnswer) {
            correct++;
            if (questionElement) {
                questionElement.parentElement.classList.add('correct');
            }
        } else {
            if (questionElement) {
                questionElement.parentElement.classList.add('incorrect');
            }
        }
    }

    const resultsElement = document.getElementById('results');
    resultsElement.textContent = `Has acertado ${correct} de ${total} preguntas.`;
}

function resetTest() {
    for (let i = 1; i <= 5; i++) {
        const radios = document.getElementsByName(`q${i}`);
        radios.forEach((radio) => {
            radio.checked = false;
            radio.parentElement.classList.remove('correct', 'incorrect');
        });
    }

    const resultsElement = document.getElementById('results');
    resultsElement.textContent = '';
}