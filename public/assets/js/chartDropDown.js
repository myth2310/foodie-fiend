const dropDownChart = document.getElementById('dropdownChart');
const chartBtn = document.getElementById('chartBtn');

window.addEventListener('scroll', function() {
    if (this.window.scrollY > 100) {
        dropDownChart.classList.replace('absolute', 'hidden');
    }
});

function onChartClick() {
    const isContains = dropDownChart.classList.contains('hidden');
    if (isContains) {
        dropDownChart.classList.replace('hidden', 'absolute');
    } else {
        dropDownChart.classList.replace('absolute', 'hidden');
    }
}