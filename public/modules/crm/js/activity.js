var EOfficeCRMActivity = function () {

    const  activityContainer = "activity-gantt-container";

    const initGranttChart = function() {
        const url = $('#'+activityContainer).data('route');
        ajaxHandler( url, "GET")
            .then((data, textStatus, xhr) => {
                if (xhr.status == 200) {
                    let taskData = data;
                    console.log(taskData)
                    Highcharts.ganttChart(activityContainer, {
                        title: {
                            text: "Danh sách hoạt động"
                        },
                        time: {
                            timezoneOffset: -7 * 60
                        },
                        xAxis: {
                            tickPixelInterval: 70,
                            currentDateIndicator: {
                                width: 5,
                                dashStyle: 'solid',
                                color: 'red',
                                label: {
                                    format: '%d-%m-%Y, %H:%M'
                                }
                            }
                        },
                        yAxis: {
                            type: "category",
                            grid: {
                                enabled: true,
                                borderColor: "rgba(0,0,0,0.3)",
                                borderWidth: 1,
                                columns: [
                                    {
                                        title: {
                                            text: "Hoạt động",
                                        },
                                        labels: {
                                            format: "{point.name}",
                                        }
                                    },
                                    {
                                        title: {
                                            text: "Khách hàng",
                                        },
                                        labels: {
                                            format: "{point.customer}",
                                        }
                                    },
                                    {
                                        labels: {
                                            format: '{point.start:%d-%m-%Y}'
                                        },
                                        title: {
                                            text: "Bắt đầu",
                                        }
                                    },
                                    {
                                        title: {
                                            text: "Kết thúc",
                                        },
                                        offset: 30,
                                        labels: {
                                            format: '{point.end:%d-%m-%Y}'
                                        }
                                    }
                                ]
                            }
                        },

                        tooltip: {
                            xDateFormat: "%e %b %Y, %H:%M",
                        },

                        series: [
                            {
                                name: "Danh sách hoạt động",
                                data: taskData
                            }
                        ],

                        exporting: {
                            sourceWidth: 1000
                        }
                    });
                }else{
                    alert('server errors!');
                }
            })
            .catch((error) => toast(data.msg, "error"));
    }

    return {
        init: function init() {
            initGranttChart();
        }
    };
}();

jQuery(document).ready(function() {
    EOfficeCRMActivity.init();
});

