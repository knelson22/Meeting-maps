<html>
  <head>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
	  table{
	  height:100%;
	  width:100%;
	  
	  }
      /* Optional: Makes the sample page fill the window. */
      html, body {
 height: 100%;
 margin: 0;
 padding: 0;
		overflow:hidden
      }
      #map {
 height:100vh;
		
		
		width:100%;
      }
	  
	  .mapcell{
	  
		width:77%;
		vertical-align:top;

	  }
	.textcell{
		  
		vertical-align:top;
		height:100vh;
			overflow:hidden
		  
	  }

	  .namecell{		  
		  text-align:center;
		  cursor:pointer;
	  }
	  
	  
	  
	  
	  div.scrollable {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    overflow: auto;
}
	  
	  #head{
		  
		  background-color:green;
		  color:white
		  
	  }
	  
	  
    </style>
  </head>
  <body>
  <table>
  <tr>
  <td  class=mapcell>
    <div id="map"></div>  
  
  </td>
  <td class=textcell>
  <center>
<div id=head>
Showing meetings for <span id=day></span><br>between<br><span id=time></span>


</div> 
</center>
  <form   onsubmit='return 0'>
  <fieldset>      
<script>
function c(){
if(typeof d=="undefined")d=1;
 if(d){
	 
	 
	 $(':checkbox').prop('checked', 1); 
 d=0;
 
 
 
 }else{
	 $(':checkbox').prop('checked', 0);
	 d=1; 
	 
 }

}
</script>
 <legend>Search</legend><a href='javascript:c() 
 '>check/uncheck all</a>
 
 <input type="checkbox" value="Sunday">Sunday
 <input type="checkbox" value="Monday">Monday      
 <input type="checkbox" value="Tuesday">Tuesday      
 <input type="checkbox" value="Wednesday">Wednesday      
 <input type="checkbox" value="Thursday">Thursday      
 <input type="checkbox" value="Friday">Friday      
 <input type="checkbox" value="Saturday">Saturday  
 <input id=dh type="hidden" name="day" value="">

     <br><center>
	start <select name=start >
	<option value='00:00' >12:00am</option>
	<option value='01:00' >1:00am</option>
	<option value='02:00' >2:00am</option>
	<option value='03:00' >3:00am</option>
	<option value='04:00' >4:00am</option>
	<option value='05:00' >5:00am</option>
	<option value='06:00' >6:00am</option>
	<option value='07:00' >7:00am</option>
	<option value='08:00' >8:00am</option>
	<option value='09:00' >9:00am</option>
	<option value='10:00' >10:00am</option>
	<option value='11:00' >11:00am</option>
	<option value='12:00' >12:00pm</option>
	<option value='13:00' >1:00pm</option>
	<option value='14:00' >2:00pm</option>
	<option value='15:00' >3:00pm</option>
	<option value='16:00' >4:00pm</option>
	<option value='17:00' >5:00pm</option>
	<option value='18:00' >6:00pm</option>
	<option value='19:00' >7:00pm</option>
	<option value='20:00' >8:00pm</option>
	<option value='21:00' >9:00pm</option>
	<option value='22:00' >10:00pm</option>
	<option value='23:00' >11:00pm</option>
		</select>
		end <select name=end>
	
	<option value='01:00' >1:00am</option>
	<option value='02:00' >2:00am</option>
	<option value='03:00' >3:00am</option>
	<option value='04:00' >4:00am</option>
	<option value='05:00' >5:00am</option>
	<option value='06:00' >6:00am</option>
	<option value='07:00' >7:00am</option>
	<option value='08:00' >8:00am</option>
	<option value='09:00' >9:00am</option>
	<option value='10:00' >10:00am</option>
	<option value='11:00' >11:00am</option>
	<option value='12:00' >12:00pm</option>
	<option value='13:00' >1:00pm</option>
	<option value='14:00' >2:00pm</option>
	<option value='15:00' >3:00pm</option>
	<option value='16:00' >4:00pm</option>
	<option value='17:00' >5:00pm</option>
	<option value='18:00' >6:00pm</option>
	<option value='19:00' >7:00pm</option>
	<option value='20:00' >8:00pm</option>
	<option value='21:00' >9:00pm</option>
	<option value='22:00' >10:00pm</option>
	<option value='23:00' >11:00pm</option>
	<option 
	value='23:00'
	
	selected='1' >11:59pm</option>
		</select>
	
	<button  type='button' onclick='get()'>  Submit  </button>
  <!-- <input type="submit" value=" now" /> -->
  </center></fieldset> 
  
  
  
  </form>
  
  
<div class=scrollable>
     
  <div class='namecell' open=0 style='display:none'>
  <div class='name' >
  name
  </div>
  <span  class=day>
  day
  </span>
  <span   class=time >time</span>
  <div class='address'>
  address
  </div>
  <span class=city  ></span>, 
  <span class=state ></span> 
  <span class=zip   ></span>
  
  
  <br/>
  <br/>
  
  </div>
	
	
	
</div>
 
  
  </td>
  
  </tr>
  
  
  </table>

	
	
    <script>
var map;
function initMap() {
		  
	map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: 40.1, lng: -88.25},
		zoom: 13
	});
	run=1
	copy = document.querySelector('.namecell').cloneNode(1);
	document.querySelector('.namecell').remove()
	get()
}
function populateHead(day,time){
	document.querySelector('#day').innerHTML = day;
	document.querySelector('#time').innerHTML = time;
	
	
	
}
function get(){

	document.querySelector('.scrollable').innerHTML='';
	// map.panBy(0,0)
	
	var day ='';
	document.querySelector('#dh').value = ''
	if(run){
		days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
		
		
		daynum = new Date().getDay()
		day = days[daynum]
		
		document.querySelectorAll('[type="checkbox"]')[daynum].checked = true
		document.querySelector('#dh').value = day;
		
		run=0
	}
	
	else
	{
		
		markerCluster.clearMarkers();
		for(let i=0;i<$(':checkbox').length;i++){
			
			if($(':checkbox')[i].checked ==true)
			{
				document.querySelector('#dh').value += $(':checkbox')[i].value +',' 
				
			}
			
			
		}
		document.querySelector('#dh').value= document.querySelector('#dh').value.slice(0,document.querySelector('#dh').value.length-1)
		
		
		
	}
	
	


$.get('webservice.php?' + $('form').serialize(), function(data){
	
			re = eval(data);
 
 
 for(let i=0;i<re.length;i++){

	
	 for(let z=i-1;z>-1;z--){

		if(JSON.stringify(re[i]).includes(JSON.stringify(re[z].lat)) &&
			JSON.stringify(re[i]).includes(JSON.stringify(re[z].lng)))
			{
				
			re[i].lat=  Number(re[i].lat)+.00002*i
				
				
			}
	
	 }
	
 }

content = new Array(re.length);


for(let i=0;i<re.length;i++)
{
	content[i] = copy.cloneNode(1);
	content[i].style='display:block'
	
}
// document.querySelector('.namecell').remove();


bounds  = new google.maps.LatLngBounds();
marker= new Array();
infowindow = new Array();


for(let i=0;i<re.length;i++){
	content[i].querySelector('.name').innerHTML = i+1 +'<br>'+ re[i].name
	content[i].querySelector('.day').innerHTML = re[i].day
	content[i].querySelector('.time').innerHTML = re[i].start
	content[i].querySelector('.address').innerHTML = re[i].address
	content[i].querySelector('.city').innerHTML = re[i].city
	content[i].querySelector('.state').innerHTML = re[i].state
	content[i].querySelector('.zip').innerHTML = re[i].zip
	
	
	
	
	var contentString = re[i].name

 infowindow[i] = new google.maps.InfoWindow({
   content: content[i].innerHTML
 });
 
 

	m = {lat: eval(re[i].lat)  , lng: eval(re[i].lng)}
	marker[i] = new google.maps.Marker({position: m, 
	name: 'a', 
	label: (i+1).toString(),
	map: map});
   
	marker[i].addListener('click', function() {
	  infowindow[i].open(map, marker[i]);
	});	
	
	content[i].addEventListener('click',()=>{
		
		if(content[i].open==1){
			infowindow[i].close(map,marker[i])
			content[i].open= 0;
			
			content[i].style='background:white;color:black'

			
			
		}else
		 {
			infowindow[i].open(map,marker[i])
			content[i].open=1 
			content[i].style='background:blue;color:white'
			
			
		}
		
	})
		document.querySelector('.scrollable').appendChild(content[i]);

	loc = new google.maps.LatLng(marker[i].position.lat(), marker[i].position.lng());
	bounds.extend(loc);
	
	

	
	
	
	}
		
	map.fitBounds(bounds);
	map.panToBounds(bounds); 

	
	  markerCluster = new MarkerClusterer(map, marker,     {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
	  
	  
	  })


let searchParams = new URLSearchParams($('form').serialize())
let d = searchParams.get('day')
let end = searchParams.get('end')
let start = searchParams.get('start')




populateHead(d, start+' and ' + end);


}

    </script>
	
	    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap&key=&"
    async defer></script>
	  
	
	

  </body>
</html>