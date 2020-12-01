// Dashboard 1 Morris-chart
$(function () {
    "use strict";    
    Morris.Bar({
        element: 'morris-bar-chart1',
        data: [{
            y: 'Item 1',
            a: 100,
            b: 50,
        }, {
            y: 'Item 2',
            a: 75,
            b: 50,
        }, {
            y: 'Item 3',
            a: 60,
            b: 50,
        }, {
            y: 'Item 4',
            a: 80,
            b: 60,
        }, {
            y: 'Item 5',
            a: 100,
            b: 40,
        }, {
            y: 'Item 6',
            a: 80,
            b: 70,
        }
        ],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Real'],
        barColors:['#55ce63', '#2f3d4a'],
        hideHover: 'auto',
        gridLineColor: '#eef0f2',
        resize: true
    });

  

 });    