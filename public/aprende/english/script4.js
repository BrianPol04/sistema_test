function classify() {
    var correctAnswers = {
        q1: "am",
        q2: ["are not", "aren't"],
        q3: "is",
        q4: ["is not", "isn't"],
        q5: "is",
        q6: "are",
        q7: "are"
    };

    for (var i = 1; i <= 7; i++) {
        var userAnswer = document.getElementById('q' + i).value.trim().toLowerCase();
        var correctAnswer = correctAnswers['q' + i];
        
        if (Array.isArray(correctAnswer)) {
            if (correctAnswer.includes(userAnswer)) {
                document.getElementById('img' + i + '-correct').hidden = false;
                document.getElementById('img' + i + '-incorrect').hidden = true;
            } else {
                document.getElementById('img' + i + '-correct').hidden = true;
                document.getElementById('img' + i + '-incorrect').hidden = false;
            }
        } else {
            if (userAnswer === correctAnswer) {
                document.getElementById('img' + i + '-correct').hidden = false;
                document.getElementById('img' + i + '-incorrect').hidden = true;
            } else {
                document.getElementById('img' + i + '-correct').hidden = true;
                document.getElementById('img' + i + '-incorrect').hidden = false;
            }
        }
    }
}

function resetTest() {
    for (var i = 1; i <= 7; i++) {
        document.getElementById('q' + i).value = "";
        document.getElementById('img' + i + '-correct').hidden = true;
        document.getElementById('img' + i + '-incorrect').hidden = true;
    }
}
