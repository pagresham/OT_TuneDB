$(function(){
	 // alert('jsWorks');
	
	 var urlArray = [];

	// Set up listener for create user Form
	
	$('#loc_btn').on('click', function(e){
		
		console.log('pressed submit');
		e.preventDefault();
		var town = $('#citySelect').val();
		var state = $('#stateSelect').val();
		var lat = "";
		var lng = "";
		if (town !== "" && state !== ""){
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({address: town+", "+state}, function(result, status){
				if(status == 'OK') {
					lat = result[0].geometry.location.lat();
					lng = result[0].geometry.location.lng();
					$('#hidden_lat').val(lat);
					$('#hidden_lng').val(lng);
					console.log($('#hidden_lat').val());
					console.log($('#hidden_lng').val());
				}
			});
		}
		
	});

	// Activate Bootstrap Tooltips

	$('[data-toggle="tooltip"]').tooltip(); 


	$('#music-btn').click(function(e){
		e.preventDefault();
		var w = window.open("play_tunes.php", 'media', 'height=300,width=350', false);
		return !w;
	});

	// Set initail state of add_link form to hidden
	//$('#links_hidden_div').hide();	
	$('#open-link').click(function() {
		$('#links_hidden_div').toggle(400);		
	});

	//$('#delete_hidden_div').hide();	
	$('#open-delete').click(function() {
		$('#delete_hidden_div').toggle(400);		
	});

	$('#open-skill').click(function() {
		$('#skill_hidden_div').toggle(400);
	})

	// $('#link-list-drp').hide();
	
	// Get urls off of link list, and save for later use.
	
	
	load_random_vid();

	$('.tune-links2').each(function(){
		
		$(this).click(function(){
			var i = $(this).attr('id');
			// alert(this.value);
			
			$('#vid-frame').hide(400, function(){
				$('#vid-frame').attr('src', i);	
			}).show(500);
				
			$('#vid-desc').html(this.innerHTML);
		})
	})

	$('.tune-links').each(function(){
		
		$(this).click(function(){
			var i = $(this).attr('id');
			// alert(this.value);
			
			$('#vid-frame').hide(400, function(){
				$('#vid-frame').attr('src', i);	
			}).show(500);
				
			$('#vid-desc').html(this.innerHTML);
		})
	})
	/**
	 * Takes urls rom links, and adds them to an array.
	 * Selects a random numbered link to display on page load
	 */
	function load_random_vid(){

		$('.tune-links').each(function(){
			urlArray.push(this.id);
		});

		// Populate a random video into the player at page load
		var rndLinkNum = Math.floor(Math.random()*urlArray.length);
		$('#vid-frame').attr('src', urlArray[rndLinkNum]);
	}

	// initialize all tooltips //
	$('[data-toggle="tooltip"]').tooltip();

	// state and city autocomplete text
	

/**
 * populates the autocomplete fields for the #stateSelect element in trails.html
 */
function stateSelect() {
		var stateAbbr = ['AL','AK','AZ','AR','CA','CO','CT','DE','FL','GA','HI','ID','IL','IN','IA','KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','OH','OK','OR','PA','RI','SC','SD','TN','TX','UT','VT','VA','WA','WV','WI','WY'];
		var stateNames = ["California,", "Alabama,", "Arkansas,", "Arizona,", "Alaska,", "Colorado,", "Connecticut,", "Delaware,", "Florida,", "Georgia,", "Hawaii,", "Idaho,", "Illinois,", "Indiana,", "Iowa,", "Kansas,", "Kentucky,", "Louisiana,", "Maine,", "Maryland,", "Massachusetts,", "Michigan,", "Minnesota,", "Mississippi,", "Missouri,", "Montana,", "Nebraska,", "Nevada,", "New Hampshire,", "New Jersey,", "New Mexico,", "New York,", "North Carolina,", "North Dakota,", "Ohio,", "Oklahoma,", "Oregon,", "Pennsylvania,", "Rhode Island,", "South Carolina,", "South Dakota,", "Tennessee,", "Texas,", "Utah,", "Vermont,", "Virginia,", "Washington,", "West Virginia,", "Wisconsin,", "Wyoming"];

		for (var i in stateNames){
			stateNames[i] = stateNames[i].replace(',','');
		}
		// var stateSelectBox = $('#stateSelect');
		$('#stateSelect').autocomplete({
      		source: stateNames
    	});
	}
	
/**
 * populates the autocomplete fields for the #citySelect element in trails.html
 */
function citySelect() {
		var cityArray = [ "Aberdeen", "Abilene", "Akron", "Albany", "Albuquerque", "Alexandria", "Allentown", "Amarillo", "Anaheim", "Anchorage", "Ann Arbor", "Antioch", "Apple Valley", "Appleton", "Arlington", "Arvada", "Asheville", "Athens", "Atlanta", "Atlantic City", "Augusta", "Aurora", "Austin", "Bakersfield", "Baltimore", "Barnstable", "Baton Rouge", "Beaumont", "Bel Air", "Bellevue", "Berkeley", "Bethlehem", "Billings", "Birmingham", "Bloomington", "Boise", "Boise City", "Bonita Springs", "Boston", "Boulder", "Bradenton", "Bremerton", "Bridgeport", "Brighton", "Brownsville", "Bryan", "Buffalo", "Burbank", "Burlington", "Cambridge", "Canton", "Cape Coral", "Carrollton", "Cary", "Cathedral City", "Cedar Rapids", "Champaign", "Chandler", "Charleston", "Charlotte", "Chattanooga", "Chesapeake", "Chicago", "Chula Vista", "Cincinnati", "Clarke County", "Clarksville", "Clearwater", "Cleveland", "College Station", "Colorado Springs", "Columbia", "Columbus", "Concord", "Coral Springs", "Corona", "Corpus Christi", "Costa Mesa", "Dallas", "Daly City", "Danbury", "Davenport", "Davidson County", "Dayton", "Daytona Beach", "Deltona", "Denton", "Denver", "Des Moines", "Detroit", "Downey", "Duluth", "Durham", "El Monte", "El Paso", "Elizabeth", "Elk Grove", "Elkhart", "Erie", "Escondido", "Eugene", "Evansville", "Fairfield", "Fargo", "Fayetteville", "Fitchburg", "Flint", "Fontana", "Fort Collins", "Fort Lauderdale", "Fort Smith", "Fort Walton Beach", "Fort Wayne", "Fort Worth", "Frederick", "Fremont", "Fresno", "Fullerton", "Gainesville", "Garden Grove", "Garland", "Gastonia", "Gilbert", "Glendale", "Grand Prairie", "Grand Rapids", "Grayslake", "Green Bay", "GreenBay", "Greensboro", "Greenville", "Gulfport-Biloxi", "Hagerstown", "Hampton", "Harlingen", "Harrisburg", "Hartford", "Havre de Grace", "Hayward", "Hemet", "Henderson", "Hesperia", "Hialeah", "Hickory", "High Point", "Hollywood", "Honolulu", "Houma", "Houston", "Howell", "Huntington", "Huntington Beach", "Huntsville", "Independence", "Indianapolis", "Inglewood", "Irvine", "Irving", "Jackson", "Jacksonville", "Jefferson", "Jersey City", "Johnson City", "Joliet", "Kailua", "Kalamazoo", "Kaneohe", "Kansas City", "Kennewick", "Kenosha", "Killeen", "Kissimmee", "Knoxville", "Lacey", "Lafayette", "Lake Charles", "Lakeland", "Lakewood", "Lancaster", "Lansing", "Laredo", "Las Cruces", "Las Vegas", "Layton", "Leominster", "Lewisville", "Lexington", "Lincoln", "Little Rock", "Long Beach", "Lorain", "Los Angeles", "Louisville", "Lowell", "Lubbock", "Macon", "Madison", "Manchester", "Marina", "Marysville", "McAllen", "McHenry", "Medford", "Melbourne", "Memphis", "Merced", "Mesa", "Mesquite", "Miami", "Milwaukee", "Minneapolis", "Miramar", "Mission Viejo", "Mobile", "Modesto", "Monroe", "Monterey", "Montgomery", "Moreno Valley", "Murfreesboro", "Murrieta", "Muskegon", "Myrtle Beach", "Naperville", "Naples", "Nashua", "Nashville", "New Bedford", "New Haven", "New London", "New Orleans", "New York", "New York City", "Newark", "Newburgh", "Newport News", "Norfolk", "Normal", "Norman", "North Charleston", "North Las Vegas", "North Port", "Norwalk", "Norwich", "Oakland", "Ocala", "Oceanside", "Odessa", "Ogden", "Oklahoma City", "Olathe", "Olympia", "Omaha", "Ontario", "Orange", "Orem", "Orlando", "Overland Park", "Oxnard", "Palm Bay", "Palm Springs", "Palmdale", "Panama City", "Pasadena", "Paterson", "Pembroke Pines", "Pensacola", "Peoria", "Philadelphia", "Phoenix", "Pittsburgh", "Plano", "Pomona", "Pompano Beach", "Port Arthur", "Port Orange", "Port Saint Lucie", "Port St. Lucie", "Portland", "Portsmouth", "Poughkeepsie", "Providence", "Provo", "Pueblo", "Punta Gorda", "Racine", "Raleigh", "Rancho Cucamonga", "Reading", "Redding", "Reno", "Richland", "Richmond", "Richmond County", "Riverside", "Roanoke", "Rochester", "Rockford", "Roseville", "Round Lake Beach", "Sacramento", "Saginaw", "Saint Louis", "Saint Paul", "Saint Petersburg", "Salem", "Salinas", "Salt Lake City", "San Antonio", "San Bernardino", "San Buenaventura", "San Diego", "San Francisco", "San Jose", "Santa Ana", "Santa Barbara", "Santa Clara", "Santa Clarita", "Santa Cruz", "Santa Maria", "Santa Rosa", "Sarasota", "Savannah", "Scottsdale", "Scranton", "Seaside", "Seattle", "Sebastian", "Shreveport", "Simi Valley", "Sioux City", "Sioux Falls", "South Bend", "South Lyon", "Spartanburg", "Spokane", "Springdale", "Springfield", "St. Louis", "St. Paul", "St. Petersburg", "Stamford", "Sterling Heights", "Stockton", "Sunnyvale", "Syracuse", "Tacoma", "Tallahassee", "Tampa", "Temecula", "Tempe", "Thornton", "Thousand Oaks", "Toledo", "Topeka", "Torrance", "Trenton", "Tucson", "Tulsa", "Tuscaloosa", "Tyler", "Utica", "Vallejo", "Vancouver", "Vero Beach", "Victorville", "Virginia Beach", "Visalia", "Waco", "Warren", "Washington", "Waterbury", "Waterloo", "West Covina", "West Valley City", "Westminster", "Wichita", "Wilmington", "Winston", "Winter Haven", "Worcester", "Yakima", "Yonkers", "York", "Youngstown", 'ALBANY','ALBURG','ARLINGTON','BARRE','BARTON','BELLOWS FALLS','BENNINGTON','BRADFORD','BRANDON','BRATTLEBORO','BURLINGTON','CABOT','CAMBRIDGE','CHESTER-CHESTER DEPOT','DERBY CENTER','DERBY LINE','ENOSBURG FALLS','ESSEX JUNCTION','FAIR HAVEN','GRANITEVILLE-EAST BARRE','HYDE PARK','ISLAND POND','JACKSONVILLE','JEFFERSONVILLE','JERICHO','JOHNSON','LUDLOW','LYNDONVILLE','MANCHESTER','MANCHESTER CENTER','MARSHFIELD','MIDDLEBURY','MILTON','MONTPELIER','MORRISVILLE','NEWBURY','NEWFANE','NEWPORT','NORTH BENNINGTON','NORTHFIELD','NORTH TROY','NORTH WESTMINSTER','OLD BENNINGTON','ORLEANS','PERKINSVILLE','POULTNEY','RUTLAND','ST. ALBANS','ST. JOHNSBURY','SAXTONS RIVER','SOUTH BARRE','SOUTH BURLINGTON','SOUTH SHAFTSBURY','SPRINGFIELD', "Stowe", 'SWANTON','VERGENNES','WALLINGFORD','WATERBURY','WELLS RIVER','WEST BRATTLEBORO','WEST BURKE','WESTMINSTER','WEST RUTLAND','WHITE RIVER JUNCTION',"Williston", "Waitsfield", 'WILDER','WINOOSKI','WOODSTOCK' ];
		for (var i in cityArray){
			cityArray[i] = cityArray[i].toLowerCase();
		}
		var citySelectBox = $('#citySelect');
		$('#citySelect').autocomplete({
      		source: cityArray
    	});
	}

	// ui-autocomplete-input
	citySelect();
	stateSelect();

	



});