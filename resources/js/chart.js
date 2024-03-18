import Chart from "chart.js/auto";
import $ from "jquery";

$(document).ready(function () {
    console.log("first");
    async function getVisitData(){
        let response = await $.ajax({
            type: "get",
            url: "/visits",
        });
        return response
    }

    async function drawBarGraph() {
        let ctx = document.getElementById("myChart");
        // console.log(ctx);
        let labels = []
        let data = []
        try {
            let response = await getVisitData();
            for (const key in response) {
                // console.log(key)
                labels.push(key)
                // console.log(response[key].length)
                data.push(response[key].length)
            }

            new Chart(ctx, {
                type: "pie",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "# of Votes",
                            data: data,
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }
    drawBarGraph();
});
