$(function () {
    const TASK_IN_WEEK_URL = BASE_URL + "/api/v1/task-in-week";
    ajaxHandler(TASK_IN_WEEK_URL, "GET").then((data) => {
        console.log(data.Mon.length);
        taskInWeekChart(data);
    });
    function resize() {
        setTimeout(function () {
            myChart.resize();
        }, 100);
    }
    $(window).on("resize", resize), $(".sidebartoggler").on("click", resize);
});
function taskInWeekChart(data) {
    var myChart = echarts.init(document.getElementById("bar-chart"));
    option = {
        tooltip: {
            trigger: "axis",
        },
        legend: {
            data: ["Task"],
        },
        toolbox: {
            show: true,
            feature: {
                magicType: { show: true, type: ["line", "bar"] },
                restore: { show: true },
                saveAsImage: { show: true },
            },
        },
        color: ["#55ce63", "#f62d51"],
        calculable: true,
        xAxis: [
            {
                type: "category",
                data: [
                    "Thứ 2",
                    "Thứ 3",
                    "Thứ 4",
                    "Thứ 5",
                    "Thứ 6",
                    "Thứ 7",
                    "Chủ nhật",
                ],
            },
        ],
        yAxis: [
            {
                type: "value",
            },
        ],
        series: [
            {
                name: "Task",
                type: "bar",
                data: [
                    data.Mon.length,
                    data.Tue.length,
                    data.Wed.length,
                    data.Thu.length,
                    data.Fri.length,
                    data.Sat.length,
                    data.Sun.length,
                ],
                markPoint: {
                    data: [
                        { type: "max", name: "Max" },
                        { type: "min", name: "Min" },
                    ],
                },
            },
        ],
    };
    // use configuration item and data specified to show chart
    myChart.setOption(option, true);
}
