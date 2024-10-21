import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);
export default async function gitChartsData(chartType = 'type') {

    let apiurl = `api/gitChartsData`;

    const controller = new AbortController();
    const signal = controller.signal;

    let config = {
        signal: signal, // 正確傳遞 signal
        mode: 'cors',
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',  // 告訴伺服器數據格式為 JSON
        },
        body: JSON.stringify({
            chartType: chartType
        })
    };

    fetch(apiurl, config)
        .then(function (response) {
            return response.json()
        })
        .then(function (data) {
            new Chart($('canvas[data-static-type="' + chartType + '"]'), data);
        })
        .catch(function (error) {
            console.error('Fetch error:', error);
        })
}

$(function () {

    $('.static-chart-container > canvas').map(function () {
        gitChartsData($(this).data('static-type'))
    })

    $('.static-chart-bar').on('click', function () {

        gitChartsData($(this).data('static-type'))
    })
})




