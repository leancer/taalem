Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// const CHART = document.getElementById("barchart");

// Chart.defaults.scale.ticks.beginAtZero = true;

// let barChart = new Chart(CHART,{
// 	type:'bar',
// 	data:{
// 		labels:['Jan','Feb','Mar','Apr'],
// 		datasets:[
// 			{
// 				backgroundColor:'#0077f7',
// 				borderColor:'#0077f7',
// 				borderWidth:2,
// 				data:[10,20,55,30]
// 			}
// 		]
// 	}
// });
$(document).ready(function(){

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
var uid = document.getElementById("regid").innerHTML;
console.log(uid);
  //no of course last 5 days in bar chart
  $.ajax({
    url: "../inc/5daysincome.php",
    method: "post",
    data:{ regid : uid},
    dataType: 'json',
    success: function(data){
      var noc = [];
      for(var i in data){
        noc.push(data[i]);
      }
      console.log(noc);
      var forgreat = noc;
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
      data: noc,
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

});