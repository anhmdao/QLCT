(function($) {
    "use strict";
    

    $.ajax({
        url: 'http://127.0.0.1:8000/api/transactions/index/chart', // Adjust the URL to match your route
        method: 'GET',
        success: function (data) {
            // Assuming your transactions variable is an array of transactions with 'month', 'total_income', and 'total_spending' attributes
            var transactions = data;
    
            // Prepare data for Morris.js
            var data = [];
            transactions.forEach(function (transaction) {
                // Convert the date string to a JavaScript Date object
                var date = new Date(transaction.month);
    
                // Get the name of the month
                var monthName = date.toLocaleString('default', { month: 'long' });
    
                data.push({ x: monthName, income: transaction.total_income, spending: transaction.total_spending });
            });
    
            // Initialize Morris.js Bar Chart to display both income and spending
            new Morris.Bar({
                element: 'morris-bar-chart',
                data: data,
                xkey: 'x',
                ykeys: ['income', 'spending'],
                labels: ['Total Income', 'Total Spending'],
                barColors: ['#1e88e5', '#e74c3c'], // Customize bar colors
                hideHover: 'auto',
                resize: true,
                
            });
        },
        error: function (error) {
            console.log('Error fetching data:', error);
        }
    });
    
    $.ajax({
        url: 'http://127.0.0.1:8000/api/transactions/spending/chart', // Adjust the URL to match your route
        method: 'GET',
        success: function(data) {
            var chartData = [];
            data.forEach(function(category) {
                chartData.push({ label: category.name, value: category.total });
            });

            // Initialize Morris.js Pie Chart
            new Morris.Donut({
                element: 'pie-chart',
                data: chartData,
                colors: ['#1e88e5', '#ff5722', '#4caf50', '#e91e63', '#ffeb3b'], // Add more colors if needed
                resize: true
            });
        },
        error: function(error) {
            console.log('Error fetching data:', error);
        }
    });
    // // Morris bar chart
    // Morris.Bar({
    //     element: 'morris-bar-chart',
    //     data: [{
    //         y: '2006',
    //         a: 100,
    //         b: 90
    //     }, {
    //         y: '2007',
    //         a: 75,
    //         b: 65
    //     }, {
    //         y: '2008',
    //         a: 50,
    //         b: 40
    //     }, {
    //         y: '2009',
    //         a: 75,
    //         b: 65
    //     }, {
    //         y: '2010',
    //         a: 50,
    //         b: 40
    //     }, {
    //         y: '2011',
    //         a: 75,
    //         b: 65
    //     }, {
    //         y: '2012',
    //         a: 100,
    //         b: 90
    //     }],
    //     xkey: 'y',
    //     ykeys: ['a', 'b'],
    //     labels: ['A', 'B'],
    //     barColors: ['#343957', '#5873FE'],
    //     hideHover: 'auto',
    //     gridLineColor: '#eef0f2',
    //     resize: true
    // });

    // $('#info-circle-card').circleProgress({
    //     value: 0.70,
    //     size: 100,
    //     fill: {
    //         gradient: ["#a389d5"]
    //     }
    // });

    // $('.testimonial-widget-one .owl-carousel').owlCarousel({
    //     singleItem: true,
    //     loop: true,
    //     autoplay: false,
    //     //        rtl: true,
    //     autoplayTimeout: 2500,
    //     autoplayHoverPause: true,
    //     margin: 10,
    //     nav: false,
    //     dots: false,
    //     responsive: {
    //         0: {
    //             items: 1
    //         },
    //         600: {
    //             items: 1
    //         },
    //         1000: {
    //             items: 1
    //         }
    //     }
    // });

    // $('#vmap13').vectorMap({
    //     map: 'usa_en',
    //     backgroundColor: 'transparent',
    //     borderColor: 'rgb(88, 115, 254)',
    //     borderOpacity: 0.25,
    //     borderWidth: 1,
    //     color: 'rgb(88, 115, 254)',
    //     enableZoom: true,
    //     hoverColor: 'rgba(88, 115, 254)',
    //     hoverOpacity: null,
    //     normalizeFunction: 'linear',
    //     scaleColors: ['#b6d6ff', '#005ace'],
    //     selectedColor: 'rgba(88, 115, 254, 0.9)',
    //     selectedRegions: null,
    //     showTooltip: true,
    //     // onRegionClick: function(element, code, region) {
    //     //     var message = 'You clicked "' +
    //     //         region +
    //     //         '" which has the code: ' +
    //     //         code.toUpperCase();

    //     //     alert(message);
    //     // }
    // });

    // var nk = document.getElementById("sold-product");
    // // nk.height = 50
    // new Chart(nk, {
    //     type: 'pie',
    //     data: {
    //         defaultFontFamily: 'Poppins',
    //         datasets: [{
    //             data: [45, 25, 20, 10],
    //             borderWidth: 0,
    //             backgroundColor: [
    //                 "rgba(89, 59, 219, .9)",
    //                 "rgba(89, 59, 219, .7)",
    //                 "rgba(89, 59, 219, .5)",
    //                 "rgba(89, 59, 219, .07)"
    //             ],
    //             hoverBackgroundColor: [
    //                 "rgba(89, 59, 219, .9)",
    //                 "rgba(89, 59, 219, .7)",
    //                 "rgba(89, 59, 219, .5)",
    //                 "rgba(89, 59, 219, .07)"
    //             ]

    //         }],
    //         labels: [
    //             "one",
    //             "two",
    //             "three",
    //             "four"
    //         ]
    //     },
    //     options: {
    //         responsive: true,
    //         legend: false,
    //         maintainAspectRatio: false
    //     }
    // });



})(jQuery);

// (function($) {
//     "use strict";

//     var data = [],
//         totalPoints = 300;

//     function getRandomData() {

//         if (data.length > 0)
//             data = data.slice(1);

//         // Do a random walk

//         while (data.length < totalPoints) {

//             var prev = data.length > 0 ? data[data.length - 1] : 50,
//                 y = prev + Math.random() * 10 - 5;

//             if (y < 0) {
//                 y = 0;
//             } else if (y > 100) {
//                 y = 100;
//             }

//             data.push(y);
//         }

//         // Zip the generated y values with the x values

//         var res = [];
//         for (var i = 0; i < data.length; ++i) {
//             res.push([i, data[i]])
//         }

//         return res;
//     }

//     // Set up the control widget

//     var updateInterval = 30;
//     $("#updateInterval").val(updateInterval).change(function() {
//         var v = $(this).val();
//         if (v && !isNaN(+v)) {
//             updateInterval = +v;
//             if (updateInterval < 1) {
//                 updateInterval = 1;
//             } else if (updateInterval > 3000) {
//                 updateInterval = 3000;
//             }
//             $(this).val("" + updateInterval);
//         }
//     });

//     var plot = $.plot("#cpu-load", [getRandomData()], {
//         series: {
//             shadowSize: 0 // Drawing is faster without shadows
//         },
//         yaxis: {
//             min: 0,
//             max: 100
//         },
//         xaxis: {
//             show: false
//         },
//         colors: ["#007BFF"],
//         grid: {
//             color: "transparent",
//             hoverable: true,
//             borderWidth: 0,
//             backgroundColor: 'transparent'
//         },
//         tooltip: true,
//         tooltipOpts: {
//             content: "Y: %y",
//             defaultTheme: false
//         }


//     });

//     function update() {

//         plot.setData([getRandomData()]);

//         // Since the axes don't change, we don't need to call plot.setupGrid()

//         plot.draw();
//         setTimeout(update, updateInterval);
//     }

//     update();


// })(jQuery);


const wt = new PerfectScrollbar('.widget-todo');
const wtl = new PerfectScrollbar('.widget-timeline');