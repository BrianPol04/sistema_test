function classify() {
    const answers = {
        pra1: 'three',
        pra2: 'nine',
        pra3: 'twenty'
    };

    for (let i = 1; i <= 3; i++) {
        let answerInput = document.getElementById(`pra${i}`).value.trim().toLowerCase();
        let correctImg = document.getElementById(`img${i}-correct`);
        let incorrectImg = document.getElementById(`img${i}-incorrect`);

        if (answerInput === answers[`pra${i}`]) {
            correctImg.hidden = false;
            incorrectImg.hidden = true;
        } else {
            correctImg.hidden = true;
            incorrectImg.hidden = false;
        }
    }
}

function resetTest() {
    for (let i = 1; i <= 3; i++) {
        document.getElementById(`pra${i}`).value = '';
        document.getElementById(`img${i}-correct`).hidden = true;
        document.getElementById(`img${i}-incorrect`).hidden = true;
    }
}
