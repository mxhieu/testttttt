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
            label: "Sales",
            value: 30
        }, {
            label: "Development",
            value: 20
        }],
        resize: true,
        colors:['#009efb', '#55ce63', '#2f3d4a']
    });

// Morris bar chart
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
            y: 'Development',
            a: 50,
            b: 50,
        }],
        xkey: 'y',
        ykeys: ['a','b'],
        labels: ['Income','Expense'],
        barColors:['#55ce63', '#2f3d4a'],
        hideHover: 'auto',
        gridLineColor: '#eef0f2',
        resize: true
    });
// Extra chart

 });    