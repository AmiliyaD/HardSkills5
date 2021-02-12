var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: sessionsName,
       
        datasets: [{
            
            label: 'Capacity',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: capacity
        },
    {
        label: 'Session registraion',
        
        backgroundColor: 'rgb(95,146,700)',
        borderColor: 'rgb(255,45,700)',
        data: sessionReg,
      
    }
    
        ],
      
    },

    // Configuration options go here
    options: {
        responsive: true,
        
        // tooltips: {
        //     mode: 'index'
        // },
        scales: {
            yAxes: [{
                ticks: {
                    suggestedMin: 50,
                    suggestedMax: 100
                }
            }]
        },
        color: {
            function(context) {
                var index = context.dataIndex;
                var value = context.dataset.data[index];
                return value < 0 ? 'red' :  // draw negative values in red
                    index % 2 ? 'blue' :    // else, alternate values in blue and green
                    'green';
            }
        } 
        
    }
});
for (let i = 0; i < sessionReg.length; i++) {

    // console.log(capacity[i] + ' capac')
    if (sessionReg[i] > 0) {
        if (sessionReg[i] > capacity[i]) {
        console.log(sessionReg[i])
    }
    }
    
}
console.log(chart)