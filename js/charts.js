

const getPieColor = (d) => {
  return d == 'SOUTHWEST' ? 'Yellow' :
         d == 'CENTRAL'? 'Blue' :
         d == 'NORTH HOLLYWOOD'? 'Green' :
         d == 'MISSION' ? 'Red' :
         d == 'DEVONSHIRE' ? 'Orange' :
         d == 'NORTHEAST' ? 'Purple' :
         d == 'HARBOR'? 'Teal' :
         d == 'VAN NUYS'? 'Gray' :
         d == 'WEST VALLEY'? 'Black' :
         d == "WEST LOS ANGELES"? 'White' :
         d == "WILSHIRE"? 'lawngreen' :
         d == 'PACIFIC'? 'lightskyblue' :
         d == 'RAMPART'? 'Brown' :
         d == '77TH STREET'? 'Goldenrod' :
         d == 'HOLLENBECK'? 'Pink' :
         d == 'SOUTHEAST' ? 'Olive' :
         d == 'HOLLYWOOD'? 'Tan' :
         d == 'NEWTON'? 'Lime' :
         d == 'FOOTHILL'? 'MediumSpringGreen' :
         d == 'OLYMPIC'? 'Silver' :
         d == 'TOPANGA'? 'Plum' :
                       '#BD0026'
  
  }

  let getDoughnutColor = (d) => {
    return d == 'BATTERY' ? 'Yellow' :
           d == 'SEX'? 'Blue' :
           d == 'VANDALISM'? 'Green' :
           d == 'RAPE' ? 'Red' :
           d == 'SHOPLIFTING' ? 'Orange' :
           d == 'OTHER' ? 'Purple' :
           d == 'THEFT-GRAND'? 'Teal' :
           d == 'BURGLARY'? 'Gray' :
           d == 'CRIMINAL'? 'Black' :
           d == 'ARSON'? 'White' :
           d == 'INTIMATE'? 'lawngreen' :
           d == 'THEFT'? 'lightskyblue' :
           d == 'ROBBERY'? 'Brown' :
           d == 'ASSAULT'? 'Goldenrod' :
           d == 'VEHICLE'? 'Pink' :
           d == 'BRANDISH' ? 'Olive' :
           d == 'BUNCO'? 'Tan' :
           d == 'BIKE'? 'Lime' :
           d == 'LETTERS'? 'MediumSpringGreen' :
           d == 'VIOLATION'? 'Silver' :
           d == 'TRESPASSING'? 'Plum' :
           d == 'DISTURBING'? 'Purple' :
           d == 'THROWING'? 'Gold' :
           d == 'EXTORATION'? 'Teal' :
           d == 'CHILD'? 'FireBrick' :
                         '#BD0026'
    
    }


const API_URL = 'https://data.lacity.org/resource/2nrs-mtv8.json';

const counts = {};
const crimeCounts = {};
let areaArray = [];
let crimeArray = [];
let areaSet = new Set();
let crimeSet = new Set();
let crimeShortSet = new Set();
let barLabels;
let pielabels;





fetch(API_URL)
    .then(response => response.json())
    .then(data => {


        


        for (let i = 0; i < data.length; i++) {
          areaArray.push(data[i].area_name)
          crimeArray.push(data[i].crm_cd_desc)

          areaSet.add(data[i].area_name);
          crimeSet.add(data[i].crm_cd_desc);

          let mySplit = data[i].crm_cd_desc.split(/[ ,]+/);
          let crimeShort = mySplit[0];
          crimeShortSet.add(crimeShort);
        }
      
        for (const element of areaArray) {
          counts[element] = counts[element] ? counts[element] + 1 : 1;
        }

        for (const element of crimeArray) {
          crimeCounts[element] = crimeCounts[element] ? crimeCounts[element] + 1 : 1;
        }
      

        let pieLabels = Array.from(areaSet);
        let barLabels = Array.from(crimeSet);
        let crimeShortArray = Array.from(crimeShortSet);

        console.log(pieLabels);
        console.log(barLabels);
        console.log(crimeShortArray);

        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
          type: 'pie',
          data: {
            labels: pieLabels,
            datasets: [{
              label: 'Crime Count',
              data: Object.values(counts),
              borderWidth: 1,
              backgroundColor: pieLabels.map(d => getPieColor(d.toUpperCase()))


            }]
          },
          options:{
            tooltips: {
              enabled: true
            },
            indexAxis: 'y',
            plugins: {
              legend: {
                display: false
              }
            },
            title: {
              display: true,
              text: 'Overall Crime Count'
            }
          }
        });


        const ctx2 = document.getElementById('myChart2');

        new Chart(ctx2, {
          type: 'doughnut',
          data: {
            labels: barLabels,
            datasets: [{
              label: 'Count',
              data: Object.values(crimeCounts),
              borderWidth: 1,
              backgroundColor: crimeShortArray.map(d => getDoughnutColor(d).toUpperCase())
            }]
          },
          options:{
            tooltips: {
              enabled: true
            },
            indexAxis: 'y',
            plugins: {
              legend: {
                display: false
              }
            },
            title: {
              display: true,
              text: 'Overall Crime Count'
            }
          }
          
        });

        let tableHtml = '<table><tr><th>Area Number</th><th>Area Name</th><th>Time Occurred</th><th>Crime Description</th></tr>';

        for (let i = 0; i < data.length; i++) {
          let rowHtml = '<tr>';
          rowHtml += '<td>' + data[i].area + '</td>';
          rowHtml += '<td>' + data[i].area_name + '</td>';
          rowHtml += '<td>' + data[i].time_occ + '</td>';
          rowHtml += '<td>' + data[i].crm_cd_desc + '</td>';
          rowHtml += '</tr>';
          tableHtml += rowHtml;
        }

        tableHtml+= '</table>';

        // Add the table to the HTML document
        document.getElementById('table-container').innerHTML = tableHtml;
    
});


function generatePDF() {
  // Get the canvas elements
  var canvas1 = document.getElementById("myChart");
  var canvas2 = document.getElementById("myChart2");

  // Create a new jsPDF instance
  var doc = new jsPDF();

  // Add the first chart as an image to the PDF
  var imgData1 = canvas1.toDataURL("image/jpeg", 1.0);
  doc.addImage(imgData1, "JPEG", 10, 10, 100, 50);

  // Add the second chart as an image to the PDF
  var imgData2 = canvas2.toDataURL("image/jpeg", 1.0);
  doc.addImage(imgData2, "JPEG", 10, 70, 100, 50);

  // Convert the table-container element to a canvas using html2canvas
  var tableContainer = document.getElementById("table-container");
  setTimeout(function() {
    html2canvas(tableContainer).then(function(canvas3) {
      // Add the canvas as an image to the PDF
      var imgData3 = canvas3.toDataURL("image/jpeg", 1.0);
      doc.addImage(imgData3, "JPEG", 10, 130, 100, 50);

      // Save the PDF
      doc.save("crime-charts.pdf");
    });
  }, 3000); // delay of 1 second (1000 milliseconds)
}

