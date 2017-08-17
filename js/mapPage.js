$(function() {
	//  ========== JS for the Map Page ============== //
	
	// Array to hold member info, to populate map info
	var memberInfo = [];
	var umap;
	var location;

	
	


	write_style_cards();

	// Get info from Dom, coming from PHP DB call //
	// Create new Member obj, and pass in values  //
	$('.member-line').each(function(index, value) {
		// Get all of the tds from the trs
		var name,
		 	town,
		 	state,
		 	lat,
		 	lng;
		$(this).find('.memberName').each(function(i, val) {
		  name = val.innerHTML;
		  // console.log(name)
		});
		$(this).find('.memberTown').each(function(i, val) {
		  town = val.innerHTML;
		  // console.log(town)
		});
		$(this).find('.memberState').each(function(i, val) {
		  state = val.innerHTML;
		  // console.log(state)
		}); 
		$(this).find('.memberLat').each(function(i, val) {
		  lat = val.innerHTML;
		  // console.log(lat)
		});
		$(this).find('.memberLng').each(function(i, val) {
		  lng = val.innerHTML;
		  // console.log(lng)
		});   
		// Create new member obj, and push to members array
		var member = new MemberData(name, town, state, lat, lng);
		memberInfo.push(member);
		// console.log(memberInfo);
	});
	

	// ======= Run function ======= //

	


	// Commented out, when adding lat, lng to object

	// Run Geocoder on each location to get LatLng //
	// for(var i in memberInfo) {
	// 	// memberInfo[i].location.lat = memberInfo[i].lat;
	// 	get_location(memberInfo[i].town, memberInfo[i].state, memberInfo[i]);
	// }


	// console.log(memberInfo);
	// 
	
	// Run the wait here, to let the geolocation data to come in.
	setTimeout(function(){
		var bounds = new google.maps.LatLngBounds();
		member_init(memberInfo, bounds);
	},1000)
	


// =========  Begin function definitions ============ //

	/**
	 * Finds LatLng of given place name
	 */
	function get_location(town, state, obj) {
		var location = {};
		var addString = town+", "+state;


		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({address: addString }, function(result, status){
			if(status == 'OK'){
				// Problem here is that function is returning before locations are complete
				location.lat = result[0].geometry.location.lat() 
				location.lng = result[0].geometry.location.lng()
				obj.location = location;
				// console.log(location)	
			}
		});
	}

	/**
	 * Constructor for member object to hold info on members
	 * @param {String} name     First and Last
	 * @param {String} town     Hometown
	 * @param {String} state   
	 * @param {Object} location contains .lat and .lng 
	 */
	function MemberData(name, town, state, lat, lng, location){
		this.name = name;
		this.town = town;
		this.state = state;
		this.lat = lat;
		this.lng = lng;
	}

	/**
	 * Creates a marker for each of the member objects passed
	 * Needs to have a member.location lat/lng passed in.
	 * @param  {obj} member Object containing basic member info
	 */
	function mapMembers(member) {
		// When I map members Remember that if geocoder has not found a loction 
		// for member, they simply wont have a .location property on their obj.
		// So check to see if it is true when you Put markers up for each member
		// console.log(member)
		if(member.location) {
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(member.location.lat, member.location.lng),
				map: umap,
				scrollwheel: false
			})
		}
	}


	/**
	 * A default map init that works with geolocation
	 * It also CAN map the members. 
	 */
	function map_init(map){
		var location;
		if (navigator.geolocation) {
        	navigator.geolocation.getCurrentPosition(function(position){
        		// console.log(position);	
        		location = position;
	    		
	    		umap = new google.maps.Map(document.getElementById('umap'), {
          			center: {lat: location.coords.latitude, lng: location.coords.longitude},
          			zoom: 8,
          			mapTypeId: "hybrid",
          			scrollwheel: false
        		});
        	});	
	    } else {
	        console.log("Geolocation is not supported by this browser.");
	        location = {lat: 38, lng: -71};
	        console.log(location);
	    }
	}

	/**
	 * Init and set listeners for member area map
	 */
	function member_init(arr, bounds) {
		// var center = bounds.getCenter();
		var infowindow = new google.maps.InfoWindow();
		
		var markerArray = [];
		
		for(var i in arr) {
			// console.log(arr[i].location);
			if (arr[i].lat && arr[i].lng) {

				// console.log(typeof(arr[i].lat))
				var marker = new google.maps.Marker({
					// need the parseFloat to convert from the Sql string
					position: {lat: parseFloat(arr[i].lat), lng: parseFloat(arr[i].lng)},
					content: "<div style='color: #333'><h4>"+arr[i].name+"</h4>\
			   			<p>"+arr[i].town+"  "+arr[i].state+"</p></div>"
				})
				bounds.extend(marker.position);
				// console.log(marker.position)
				
				// Listeners for events on markers
				google.maps.event.addListener(marker, 'click', function () {
					// if(infowindow){
					// 	infowindow.close();
					// }
		            infowindow.setContent(this.content);
		            infowindow.open(this.getMap(), this);
		        });
		        google.maps.event.addListener(marker, 'mouseover', function () {
		            infowindow.setContent(this.content);
		            infowindow.open(this.getMap(), this);
		        });

		        // This is good stuff, closes the infowindow on mouse out
		        google.maps.event.addListener(marker, 'mouseout', function () {
		            infowindow.close();
		        });
		        
				markerArray.push(marker);
			}
		} // end for each loop

		var center = bounds.getCenter();
		var map = new google.maps.Map(document.getElementById('umap'), {
			center: center, 
			zoom: 8,
			scrollwheel: false 
		})
		map.fitBounds(bounds)

		google.maps.event.addListener(map, 'click', function() {
	       infowindow.close();
	    });
	    var cent;
	    google.maps.event.addListener(map, 'idle', function(){
	    	cent = map.getCenter();
	    })
	    google.maps.event.addDomListener(window, 'resize', function() {
			map.setCenter(cent);
		});

		for(var i in markerArray) {
			markerArray[i].setMap(map);
		}
	}

	/**
	 * Create regional style cards
	 * Init Map for regional styles
	 * @return {[type]} [description]
	 */
	function write_style_cards(){
		var locArr;
		var output = $('#style-output');
		var currentCard = 0;
		var markerArr = [];
		var bounds = new google.maps.LatLngBounds();
		var infowindow = new google.maps.InfoWindow();
		var map;

		$.getJSON("helper_files/regionalNotes.js", function(response) {
			locArr = response.regions.location;
			// console.log(locArr);	
			for(var i in locArr) {
				// console.log(locArr[i]);
				var div = document.createElement('div');
				div.setAttribute('id', 'card'+i)
				div.setAttribute('class', 'style-card');
				var h4 = document.createElement('h4');
				h4.setAttribute('class', 'legend-like2');
				h4.innerHTML = locArr[i].name;
				div.appendChild(h4);

				var p1 = document.createElement('p');
				p1.setAttribute('class', 'legend-like2');
				p1.innerHTML = "Description:";
				var p2 = document.createElement('p');
				p2.innerHTML = locArr[i].description;
				var p3 = document.createElement('p');
				p3.innerHTML = "Artists:";
				p3.setAttribute('class', 'legend-like2');
				var p4 = document.createElement('p');
				p4.innerHTML = locArr[i].artists;
				div.append(p1, p2, p3, p4)
				
				output.append(div);
			}


			$('#card'+currentCard).show();
			// =====   Listeners for Prev and Next buttons on style cards  ==== //
			$('#next').click(function() {
				$('#card'+currentCard).hide('fade', function() {
					currentCard = (currentCard + 1) % locArr.length ;
					$('#card'+currentCard).show('fade');
				});
			});

			$('#prev').click(function() {
				$('#card'+currentCard).hide('fade', function() {
					console.log(currentCard)
					currentCard = (currentCard > 0) ? currentCard -1 : (currentCard -1) + locArr.length; 
					$('#card'+currentCard).show('fade');
					console.log(currentCard)
				});
			});

			// ===== Start markers ====== //
			
			for(var i in locArr) {
				var marker = new google.maps.Marker({
					title: locArr[i].name,
					position: {
						lat: parseFloat(locArr[i].lat), 
						lng: parseFloat(locArr[i].lng)
					},
					content: "<div style='color: #333'><h4>"+locArr[i].name+"</h4></div>"
				})

				google.maps.event.addListener(marker, 'click', function () {
					if(infowindow){
						infowindow.close();
					}
		            infowindow.setContent(this.content);
		            infowindow.open(this.getMap(), this);
		        });
		        google.maps.event.addListener(marker, 'mouseover', function () {
		            infowindow.setContent(this.content);
		            infowindow.open(this.getMap(), this);
		        });

		        // This is good stuff, closes the infowindow on mouse out
		        google.maps.event.addListener(marker, 'mouseout', function () {
		            infowindow.close();
		        });

		        // Extend location of all markes to map bounds //
				bounds.extend(marker.position);
				markerArr.push(marker);
			}

			var center = bounds.getCenter();

			map = new google.maps.Map($('#regional-map').get(0), {
				center: {lat: 40, lng: -50},
				mapTyleId: 'hybrid',
				scrollwheel: false
			})
			map.fitBounds(bounds)

			for(var i in markerArr) {
				markerArr[i].setMap(map);
			}
		});
	}
	

})

