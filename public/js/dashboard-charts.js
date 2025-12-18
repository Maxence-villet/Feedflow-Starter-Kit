document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('myChart');

    if (canvas) {
    
        const labels = JSON.parse(canvas.getAttribute('data-labels'));
        const dataValues = JSON.parse(canvas.getAttribute('data-values'));

        new Chart(canvas, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Réponses au sondage',
                    data: dataValues,
                    borderColor:'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    }
});