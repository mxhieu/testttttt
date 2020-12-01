// Dashboard 1 Morris-chart
$(function () {
    "use strict";
  
 // Morris donut chart
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Term 1",
            value: 50,

        }, {
            label: "Term 2",
            value: 30
        }, {
            label: "Term 3",
            value: 20
        }],
        resize: true,
        colors:['#009efb', '#55ce63', '#2f3d4a']
    });

// Morris bar chart
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Term 1',
            a: 100,
            b: 50,
        }, {
            y: 'Term 2',
            a: 75,
            b: 50,
        }, {
            y: 'Term 3',
            a: 50,
            b: 50,
        }],
        xkey: 'y',
        ykeys: ['a','b'],
        labels: ['Plan','Real'],
        barColors:['#55ce63', '#2f3d4a'],
        hideHover: 'auto',
        gridLineColor: '#eef0f2',
        resize: true
    });
// Extra chart

 });    