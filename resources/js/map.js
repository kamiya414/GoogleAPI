window.initAutocomplete = function() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 10, lng: 140 },
    zoom: 13,
    mapTypeId: "roadmap",
  });
  
  const input = document.getElementById("pac-input");




  

  let markers = [];
  searchBox.addListener("places_changed", () => {

    const places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
   
   //

   
  });   
    
  
