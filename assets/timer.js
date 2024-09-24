let duration = 240; // 4 Minuten in Sekunden
let timerCircle = document.getElementById('timerCircle');
let form = document.getElementById('taskForm');

function startTimer(duration) {
    let start = Date.now();
    let interval = setInterval(() => {
        let elapsed = (Date.now() - start) / 1000;
        let remaining = duration - elapsed;

        // Berechnung des Fortschritts für den Kreis
        let percentage = (remaining / duration) * 100;
        timerCircle.style.background = `conic-gradient(#4CAF50 ${percentage * 3.6}deg, #eee ${percentage * 3.6}deg)`;

        if (remaining <= 0) {
            clearInterval(interval);
            form.style.display = 'block'; // Formular anzeigen
            timerCircle.style.display = 'none'; // Timer verstecken
        }
    }, 1000);
}

// Timer starten
window.onload = function() {
    startTimer(duration);
};
