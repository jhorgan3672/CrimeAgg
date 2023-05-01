const map = L.map('map').setView([34.05349, -118.24532], 10);

class Map{

    static addBaseMap(){
     
      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{
          maxZoom: 19,
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        })
        .addTo(map);
    };

    static addGeoJSON(divisions, divisionStyle) {
      return L.geoJSON(divisions, {
        style: divisionStyle,
        onEachFeature: function(feature, layer) {
          layer.setStyle({
            fillColor: getDivisionColor(feature.properties.APREC),
            weight: 2,
            fillOpacity: 0.4,
            color: 'gray' //outline color
          });
          layer.bindPopup(feature.properties.APREC);
        }
      }).addTo(map);
    };

    

    static addPoints(lat, lon, crime){
      
      return  L.circleMarker([lat, lon], {
              radius: 4,
              fillColor: getRandomColor(),
              color: "#000",
              weight: 1,
              opacity: 1,
              fillOpacity: 0.8
            })
            .addTo(map)
            .bindPopup(crime);

    };


}


Map.addBaseMap();


class UI{

  static toggleActive(e){

    let app = document.getElementById("app");
    let search = document.getElementById("search");
    let register = document.getElementById("register");
    let account = document.getElementById("account");
    let chart = document.getElementById("chart");
 

    switch (e) {
      case 'app':
        app.classList.toggle('active');
        search.classList.remove('active');
        register.classList.remove('active');
        chart.classList.remove('active');
        account.classList.remove('active');
      break;
      case 'search':
       app.classList.remove('active');
       search.classList.toggle('active');
       register.classList.remove('active');
       chart.classList.remove('active');
       account.classList.remove('active');
        break;
      case 'register':
        app.classList.remove('active');
        search.classList.remove('active');
        //account.classList.remove('active');
        register.classList.toggle('active');
        //chart.classList.remove('active');
        
        break;
      
    };  
}

static toggleActiveRight(e){
    switch(e){
      case account:
        chart.classList.remove('active');
        app.classList.remove('active');
        search.classList.remove('active');
        register.classList.remove('active');
        account.classList.toggle('active');
      break;

      case chart:
        app.classList.remove('active');
        account.classList.remove('active');
        search.classList.remove('active');
        register.classList.remove('active');
        chart.classList.toggle('active');
      break;

      case app:
        chart.classList.remove('active');
        account.classList.remove('active');
        search.classList.remove('active');
        register.classList.remove('active');
        app.classList.toggle('active');
      break;

      
    }
}

      static openNav(i) {
        document.getElementById("mySidebar" + i.toString()).style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
      }
      
      static closeNav(i) {
        document.getElementById("mySidebar" + i.toString()).style.width = "0";
        
        // document.getElementById("main").style.marginLeft= "0";

      
      }

      static openNavRight(i) {
        document.getElementById("mySidebar" + i.toString()).style.width = "250px";
        document.getElementById("main").style.marginRight = "250px";
      }

      static moveMain(i){
        let myWidth = document.getElementById("mySidebar" + i.toString()).style.width;
        
        if(myWidth == '250px'){
          document.getElementById("main").style.marginLeft= "250px";
        }else{
          document.getElementById("main").style.marginLeft= "0";
        }
      }

      static moveMainLeft(i){
        let myWidth = document.getElementById("mySidebar" + i.toString()).style.width;
        
        if(myWidth == '250px'){
          document.getElementById("main").style.marginRight= "250px";
        }else{
          document.getElementById("main").style.marginRight= "0";
        }
      }

      static openChartRight(i) {
        document.getElementById("mySidebar" + i.toString()).style.width = "600px";
        document.getElementById("main").style.marginRight = "600px";
      }

      static moveMainChart(i){
        let myWidth = document.getElementById("mySidebar" + i.toString()).style.width;
        
        if(myWidth == '600px'){
          document.getElementById("main").style.marginRight= "600px";
        }else{
          document.getElementById("main").style.marginRight= "0";
        }
      }
      
      static logout(){

        let account = document.getElementById('account');
        let signout = document.getElementById('signout');
        let report = document.getElementById('report');
        let ulName = document.getElementById('ulName');
        let chart = document.getElementById('charts')

      
        account.parentNode.removeChild(account);
        signout.parentNode.removeChild(signout);
        report.parentNode.removeChild(report);
        ulName.parentNode.removeChild(ulName);
        chart.parentNode.removeChild(ulName);
         // Create a new form element
        var form = document.createElement('form');
        form.setAttribute('method', 'POST');
        form.setAttribute('action', 'app.php');
            
        // Create a new hidden input element for the signout-submit variable
        var input = document.createElement('input');
        input.setAttribute('type', 'hidden');
        input.setAttribute('name', 'signout-submit');
        input.setAttribute('value', 'true');
            
        // Append the input element to the form element
        form.appendChild(input);
            
        // Append the form element to the document body
        document.body.appendChild(form);
            
        // Call the UI.logout() function
        UI.logout();
            
        // Submit the form
        form.submit();
      }


      
     
  
}



function removeElement(){
  let statusHeader=document.getElementById('statusHeader');
  
  statusHeader.style.display='none';
 
}

function removeDbaseHeader(){
  let dbaseHeader=document.getElementById('dbase');
  dbaseHeader.style.display='none';
}


const getDivisionColor = (d) => {
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



const divisionStyle = (feature) => {
  return {
  fillColor: getDivisionColor(feature.properties.APREC),
  weight: 2,
  fillOpacity: 0.4,
  color: 'gray'  //outline color
    };
};


Map.addGeoJSON(divisions,divisionStyle)


function getRandomColor() {
  const letters = '0123456789ABCDEF';
  let color = '#';
  for (let i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}






const info = L.control();

	info.onAdd = function (map) {
		this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
		this.update();
		return this._div;
	};
	
	info.update = function (props) {
    this._div.style.backgroundColor='#333';
		this._div.innerHTML = '<h4>Greater LA</h4>' +  (props ?
			'<b>' +  props.PREC + 'th' + ' Precinct' + '</b><br />' + props.APREC + ''
			: 'Hover over an Area');
	};
	
info.addTo(map);


const highlightFeature = (e) => {
    const layer = e.target;

    layer.setStyle({
        weight: 5,
        color: '#666',
        dashArray: 'solid',
		fillOpacity: 2,
		color: 'gray'  //Outline color on mouseover hightlight
    });
	 
	info.update(layer.feature.properties);
}


const zoomToFeature = (e) => {
    map.fitBounds(e.target.getBounds());
}

const resetHighlight = (e) => {
	division.resetStyle(e.target);
	info.update();
	
}

const onEachFeature = (feature, layer) => {
    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomToFeature
    });
}


const division = L.geoJSON(divisions, {style: divisionStyle, onEachFeature: onEachFeature}).addTo(map);

const legend = L.control({position: 'bottomright'});

legend.onAdd = function (map) {
	const div = L.DomUtil.create('div', 'info legend');
  div.style.backgroundColor = '#333';
    labels = ['<strong>Legend</strong>'],
    categories = [
       'SOUTHWEST', 
        'CENTRAL', 
        'N HOLLYWOOD', 
        'MISSION',
        'DEVONSHIRE',
        'NORTHEAST',
        'HARBOR',
        'VAN NUYS',
        'WEST VALLEY',
        'WEST LA',
        'WILSHRE',
        'PACIFIC',
        'RAMPART',
        '77TH STREET',
        'HOLLENBECK',
        'SOUTHEAST' ,
        'HOLLYWOOD',
        'NEWTON',
        'FOOTHILL',
        'OLYMPIC',
        'TOPANGA'
        ];

    for (let i = 0; i < categories.length; i++) {
            
            div.innerHTML += 
            labels.push(
				'<i class="square" style="background-color:' + getDivisionColor(categories[i]) + ' "></i> ' + 
				(categories[i] ? categories[i] : '+'));
	};
        div.innerHTML = labels.join('<br>');
    return div;
    };


legend.addTo(map);





// const API_URL = 'https://data.lacity.org/resource/2nrs-mtv8.json';

// const counts = {};
// const crimeCounts = {};
// let areaArray = [];
// let crimeArray = [];
// let areaSet = new Set();
// let crimeSet = new Set();
// let barLabels;
// let pielabels;





// fetch(API_URL)
//     .then(response => response.json())
//     .then(data => {
//         for (let i = 0; i < data.length; i++) {
//           areaArray.push(data[i].area_name)
//           crimeArray.push(data[i].crm_cd_desc)

//           areaSet.add(data[i].area_name);
//           crimeSet.add(data[i].crm_cd_desc);
//         }
      
//         for (const element of areaArray) {
//           counts[element] = counts[element] ? counts[element] + 1 : 1;
//         }

//         for (const element of crimeArray) {
//           crimeCounts[element] = crimeCounts[element] ? crimeCounts[element] + 1 : 1;
//         }
      

//         let pielabels = Array.from(areaSet);
//         let barLabels = Array.from(crimeSet);

//         let ctx = document.getElementById('myChart').getContext('2d');
//         let myChart = new Chart(ctx, {
//           type: 'pie',
//           data: {
//             labels: pielabels,
//             datasets: [{
//               label: 'Count of Crimes',
//               data: Object.values(counts),
//               backgroundColor: [
//                 'rgba(174, 123, 209, 0.6)',
//             'rgba(217, 87, 116, 0.2)',
//             'rgba(94, 170, 212, 0.9)',
//             'rgba(12, 128, 172, 0.5)',
//             'rgba(66, 58, 99, 0.8)',
//             'rgba(39, 120, 85, 0.3)',
//             'rgba(240, 151, 110, 0.7)',
//             'rgba(8, 78, 65, 0.4)',
//             'rgba(155, 218, 248, 0.1)',
//             'rgba(101, 173, 109, 0.6)',
//             'rgba(183, 64, 105, 0.2)',
//             'rgba(197, 67, 147, 0.9)',
//             'rgba(5, 143, 80, 0.5)',
//             'rgba(167, 104, 174, 0.8)',
//             'rgba(82, 180, 81, 0.3)',
//             'rgba(236, 93, 97, 0.7)',
//             'rgba(41, 50, 65, 0.4)',
//             'rgba(248, 204, 143, 0.1)',
//             'rgba(207, 80, 87, 0.6)',
//             'rgba(248, 232, 190, 0.2)',
//             'rgba(85, 98, 112, 0.9)'
//               ],
//               borderColor: [
//                 'rgba(174, 123, 209, 0.6)',
//             'rgba(217, 87, 116, 0.2)',
//             'rgba(94, 170, 212, 0.9)',
//             'rgba(12, 128, 172, 0.5)',
//             'rgba(66, 58, 99, 0.8)',
//             'rgba(39, 120, 85, 0.3)',
//             'rgba(240, 151, 110, 0.7)',
//             'rgba(8, 78, 65, 0.4)',
//             'rgba(155, 218, 248, 0.1)',
//             'rgba(101, 173, 109, 0.6)',
//             'rgba(183, 64, 105, 0.2)',
//             'rgba(197, 67, 147, 0.9)',
//             'rgba(5, 143, 80, 0.5)',
//             'rgba(167, 104, 174, 0.8)',
//             'rgba(82, 180, 81, 0.3)',
//             'rgba(236, 93, 97, 0.7)',
//             'rgba(41, 50, 65, 0.4)',
//             'rgba(248, 204, 143, 0.1)',
//             'rgba(207, 80, 87, 0.6)',
//             'rgba(248, 232, 190, 0.2)',
//             'rgba(85, 98, 112, 0.9)'
//               ],
//               borderWidth: 1
//             }]
//           },
//           options: {
//             scales: {
//               y: {
//                 beginAtZero: true
//               }
//             },

//             tooltips: {
//               mode: 'index',
//               intersect: false
//            },
//            hover: {
//               mode: 'index',
//               intersect: false
//            }
//           }
//         });
        

//     let ctx2 = document.getElementById('myChart2').getContext('2d');
//     let myChart2 = new Chart(ctx2, {
//       type: 'bar',
//       data: {
//         labels: barLabels,//['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//         datasets: [{
//           label: 'Count of Crimes',
//           data: Object.values(crimeCounts),//[12, 19, 3, 5, 2, 3],
//           backgroundColor: [
//             'rgba(255, 99, 132, 0.2)',
//             'rgba(54, 162, 235, 0.2)',
//             'rgba(255, 206, 86, 0.2)',
//             'rgba(75, 192, 192, 0.2)',
//             'rgba(153, 102, 255, 0.2)',
//             'rgba(255, 159, 64, 0.2)'
//           ],
//           borderColor: [
//             'rgba(255, 99, 132, 1)',
//             'rgba(54, 162, 235, 1)',
//             'rgba(255, 206, 86, 1)',
//             'rgba(75, 192, 192, 1)',
//             'rgba(153, 102, 255, 1)',
//             'rgba(255, 159, 64, 1)',
//             'rgba(255, 99, 132, 1)',
//             'rgba(54, 162, 235, 1)',
//             'rgba(255, 206, 86, 1)',
//             'rgba(75, 192, 192, 1)',
//             'rgba(153, 102, 255, 1)'
//           ],
//           borderWidth: 1
//         }]
//       },
//       options:{
//         indexAxis: 'y'
//         }
//     });



// });
   
 

 

   





