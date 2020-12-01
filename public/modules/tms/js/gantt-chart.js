$(function () {
    const TASK_NONE_PROJECT_URL = BASE_URL + '/api/v1/task-none-project'
    ajaxHandler( TASK_NONE_PROJECT_URL, "GET")
        .then((data, textStatus, xhr) => {
            if (xhr.status == 200) {
                let taskData = data;
                Highcharts.ganttChart("container", {
                    title: {
                        text: "Công việc không thuộc dự án",
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
                        },
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
                                        text: "Công việc",
                                    },
                                    labels: {
                                        format: "{point.name}",
                                    },
                                },
                                {
                                    title: {
                                        text: "Người thực hiện",
                                    },
                                    labels: {
                                        format: "{point.assignee}",
                                    },
                                },
                                {
                                    labels: {
                                        format: '{point.start:%d-%m-%Y}'
                                    },
                                    title: {
                                        text: "Bắt đầu",
                                    },
                                },
                                {
                                    title: {
                                        text: "Kết thúc",
                                    },
                                    offset: 30,
                                    labels: {
                                        format: '{point.end:%d-%m-%Y}'
                                    },
                                },
                            ],
                        },
                    },

                    tooltip: {
                        xDateFormat: "%e %b %Y, %H:%M",
                    },

                    series: [
                        {
                            name: "Công việc không thuộc dự án",
                            data: taskData,
                        },
                    ],

                    exporting: {
                        sourceWidth: 1000,
                    },
                });
            }else{
                alert('server errors!')
            }
        })
        .catch((error) => toast(data.msg, "error"));
});
