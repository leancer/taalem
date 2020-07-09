// Chart.js scripts
// -- Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

//Area Chart Example





// -- Bar Chart Example



// -- Pie Chart Example

$(document).ready(function(){


  function formatYear(date){
    var yyyy = date.getFullYear();
    return yyyy;
 }



function Last5years () {
    var result = [];
    for (var i=0; i<5; i++) {
        var d = new Date();
        d.setFullYear(d.getFullYear() - i);
        result.push( formatYear(d) )
    }

    return(result);
 }

//no of course last 5 Year in bar chart
  $.ajax({
    url: "inc/coursebyyear.php",
    method: "GET",
    dataType: 'json',
    success: function(data){
      var nocy = [];
      for(var i in data){
        nocy.push(data[i]);
      }
      var forgreat = nocy;
      var largest = Math.max.apply(Math, forgreat);

      var ctx = document.getElementById("ChartByYear");
    var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: Last5years(),
        datasets: [{
          label: "Courses",
          backgroundColor: "rgba(2,117,216,1)",
          borderColor: "rgba(2,117,216,1)",
          data: nocy,
        }],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'month'
            },
            gridLines: {
              display: false
            },
            ticks: {
              maxTicksLimit: 6
            }
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: largest+2,
            },
            gridLines: {
              display: true
            }
          }],
        },
        legend: {
          display: false
        }
      }
    });
    },
    error: function(data){
      console.log(data);
    }
  }); 


  function formatMonths(date){
    var months = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"];
    var mm = months[date.getMonth()];
    return mm;
 }



function Last5Months () {
    var result = [];
    for (var i=0; i<5; i++) {
        var d = new Date();
        d.setMonth(d.getMonth() - i);
        result.push( formatMonths(d) )
    }

    return(result);
 }

//no of course last 5 MOnths in bar chart
  $.ajax({
    url: "inc/coursebymonths.php",
    method: "GET",
    dataType: 'json',
    success: function(data){
      var nocm = [];
      for(var i in data){
        nocm.push(data[i]);
      }
      var forgreat = nocm;
      var largest = Math.max.apply(Math, forgreat);

      var ctx = document.getElementById("ChartByMonths");
    var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: Last5Months(),
        datasets: [{
          label: "Courses",
          backgroundColor: "rgba(2,117,216,1)",
          borderColor: "rgba(2,117,216,1)",
          data: nocm,
        }],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'month'
            },
            gridLines: {
              display: false
            },
            ticks: {
              maxTicksLimit: 6
            }
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: largest+2,
            },
            gridLines: {
              display: true
            }
          }],
        },
        legend: {
          display: false
        }
      }
    });
    },
    error: function(data){
      console.log(data);
    }
  }); 

  function formatDate(date){
    var dd = date.getDate();
    var mm = date.getMonth()+1;
    var yyyy = date.getFullYear();
    if(dd<10) {dd='0'+dd}
    if(mm<10) {mm='0'+mm}
    date = mm+'/'+dd+'/'+yyyy;
    return date
 }



function Last5Days () {
    var result = [];
    for (var i=0; i<5; i++) {
        var d = new Date();
        d.setDate(d.getDate() - i);
        result.push( formatDate(d) )
    }

    return(result);
 }

  //no of course last 5 days in bar chart
  $.ajax({
    url: "inc/barchartcourses.php",
    method: "GET",
    dataType: 'json',
    success: function(data){
      var noc = [];
      for(var i in data){
        noc.push(data[i]);
      }
      var forgreat = noc;
      var largest = Math.max.apply(Math, forgreat);

      var ctx = document.getElementById("ChartByDays");
    var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: Last5Days(),
        datasets: [{
          label: "Courses",
          backgroundColor: "rgba(2,117,216,1)",
          borderColor: "rgba(2,117,216,1)",
          data: noc,
        }],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'month'
            },
            gridLines: {
              display: false
            },
            ticks: {
              maxTicksLimit: 6
            }
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: largest+2,
            },
            gridLines: {
              display: true
            }
          }],
        },
        legend: {
          display: false
        }
      }
    });
    },
    error: function(data){
      console.log(data);
    }
  });

// last 5 Days Income
var uid = 1;
$.ajax({
    url: "inc/5daysincome.php",
    method: "post",
    data:{ regid : uid },
    dataType: 'json',
    success: function(data){
      var noci = [];
      for(var i in data){
        noci.push(data[i]);
      }
      console.log(noci);
      var forgreat = noci;
      var largest = Math.max.apply(Math, forgreat);

var ctx = document.getElementById("earningChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: Last5Days(),
    datasets: [{
      label: "Earning",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 20,
      pointBorderWidth: 2,
      data: noci,
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: largest+2,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
},
    error: function(data){
      console.log(data);
    }
});


  // Get User for Pie chart
  $.ajax({
    url: "inc/piechartuser.php",
    method: "GET",
    dataType: 'json',
    success: function(data){
      var nou = [];
      for(var i in data){
        nou.push(data[i]);
      }
      var ctx = document.getElementById("myPieChart");
      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ["Student", "Instructor"],
          datasets: [{
            data: nou,
            backgroundColor: ['#007bff', '#dc3545'],
          }],
        },
        options: {
          legend: {
              labels: {
                  // This more specific font property overrides the global property
                  fontColor: 'black',
                  fontSize: 20
              }
          }
      }
      });
    },
    error: function(data){
      console.log(data);
    }
  });

  
});