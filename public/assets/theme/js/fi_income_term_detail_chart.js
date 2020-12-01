// Dashboard 1 Morris-chart
$(function () {
    "use strict";
  
 // Morris donut chart
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Marketing",
            value: 50,

        }, {
            label: "Sale",
            value: 30
        }, {
            label: "RnD",
            value: 20
        }],
        resize: true,
        colors:['#009efb', '#55ce63', '#2f3d4a']
    });

// Morris bar chart
    
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

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Marketing',
            a: 100,
            b: 50,
        }, {
            y: 'Sale',
            a: 75,
            b: 50,
        }, {
            y: 'RnD',
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