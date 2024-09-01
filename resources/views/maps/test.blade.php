<body>

<form>
    <select id = "category">
      <option value="神社">神社</option>
      <option value="寺院">寺院</option>
    </select>
    <input lavel="検索場所：" type="text" id="addressInput" value="京都" style="width: 200px">
    <input type="button" value="検索" onclick="getPlaces();">
</form>

 <div id="mapArea" style="width:700px; height:400px;"></div> 
 


★結果★<br />
<div id="results" style="width: 100%; height: 200px; border: 1px dotted; padding: 10px; overflow-y: scroll; background: white;"></div>
</body>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBnJDoMPl2eOu210vjG49G-7MUHW2l8do&libraries=places&callback=initMap" async defer></script>
<script type="text/javascript">

var map;
var placesList;

/*
 地図の初期表示
*/


function initMap() {
  map = new google.maps.Map(document.getElementById("mapArea"), {
    zoom: 5,
    center: new google.maps.LatLng(36,138),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
}

 //検索場所を調べる


function getPlaces(){
  
  //結果表示クリア
  document.getElementById("results").innerHTML = "";
  //placesList配列を初期化
  placesList = new Array();
  
  //入力した検索場所を取得
  var addressInput = document.getElementById("addressInput").value;

  if (addressInput == "") {
    return;
  }
  
  //検索場所の位置情報を取得
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode(

  {

      address: addressInput
    },
    function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        //取得した緯度・経度を使って周辺検索
        startNearbySearch(results[0].geometry.location);
      }
      else {
        alert(addressInput + "：位置情報が取得できませんでした。");
      }
    });


}

//地図情報の変更及び検索情報から周囲の寺院の情報を検索
function startNearbySearch(latLng){
  //読み込み中表示
  document.getElementById("results").innerHTML = "Now Loading...";
  
  //地図情報の変更
  map.setCenter(latLng);
  map.setZoom(13);

  
  //PlacesServiceインスタンス生成
  var service = new google.maps.places.PlacesService(map);
 
  let category = document.getElementById("category").value;

  //周辺検索
  service.nearbySearch(
    {
      location: latLng,

      radius: 3000,
      keyword: category,

      language: 'ja'
    },
    displayResults
  );

  
}

//周辺情報表示及びマーカーのセット
//results : 周辺情報検索結果
//status ： 実行結果ステータス
function displayResults(results, status) {
    


    
  if(status == google.maps.places.PlacesServiceStatus.OK) {
  
    //検索結果をplacesList配列に連結

    placesList = results;
    
    
      //ratingの降順でソート（連想配列ソート）
      placesList.sort(function(a,b){
        if(a.user_ratings_total > b.user_ratings_total) return -1;
        if(a.user_ratings_total < b.user_ratings_total) return 1;
        return 0;
      });

      
      //placesList配列をループして、
      //結果表示のHTMLタグを組み立てる
      var resultHTML = "<ol>";

    
      
      for (var i = 0; i < 10; i++) {
        place = placesList[i];
        
        //ここで各place事にマーカーの処理をする
        var infoWindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            position: place.geometry.location
        });
        
        (function(marker, place) {
        google.maps.event.addListener(marker, 'click', function() {
          var markerContent = "<strong>" + place.name + "</strong><br>" +
                        "評価: " + place.rating + "<br>" +
                        "レビュー数: " + place.user_ratings_total 

          infoWindow.setContent(markerContent);
          infoWindow.open(map, marker);
        });
      })(marker, place);
        
        
        
        //評価を投稿したユーザー数を表示
        var user_ratings = place.user_ratings_total;
        
        //ratingがないのものは「---」に表示変更
        var rating = place.rating;
        if(rating == -1) rating = "---";
        
        //表示内容（評価＋名称）
        var content = "【" + rating + "】 " + place.name + "【" + user_ratings + "】 " ;
        var name = place.name;
        
        resultHTML += "<li>";
        resultHTML += "<a href=/maps/detail?lat="+ place.geometry.location.lat() +"&lng="+ place.geometry.location.lng() + "&id="+ place.place_id + "&name=" + name +">";
        resultHTML += content;
        resultHTML += "</a>";
        resultHTML += "</li>";
        
        

      }
      
      resultHTML += "</ol>";
      
      //結果表示
      document.getElementById("results").innerHTML = resultHTML;
      showMap(latitude,longitude);
  } 
}


</script>
