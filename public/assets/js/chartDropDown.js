const dropDownChart = document.getElementById('dropdownChart');
const chartBtn = document.getElementById('chartBtn');

function onChartClick() {
    const isContains = dropDownChart.classList.contains('hidden');
    if (isContains) {
        dropDownChart.classList.replace('hidden', 'absolute');
    } else {
        dropDownChart.classList.replace('absolute', 'hidden');
    }
}