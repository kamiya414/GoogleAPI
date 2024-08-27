<body>
<tr>
  <td>検索場所：</td><td><input type="text" id="addressInput" value="近江町市場" style="width: 200px"></td>
</tr>
<tr>
  <td>KeyWord：</td><td><input type="text" id="keywordInput" value="寿司" style="width: 200px"></td>
</tr>
<tr>
  <td colspan="2" style="padding: 10px">
    <input type="button" value="お店情報取得" onclick="getPlaces();">
  </td>
</tr>

<div id="sample"></div> 
<style>
    #sample {
 width: 700px;
   height: 400px;
}
</style>
</body>

★結果★<br />
<div id="results" style="width: 100%; height: 200px; border: 1px dotted; padding: 10px; overflow-y: scroll; background: white;"></div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBnJDoMPl2eOu210vjG49G-7MUHW2l8do&libraries=places"></script>

<script type="text/javascript">

var placesList;

/*
 お店情報取得
*/
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

/*
 位置情報を使って周辺検索
  latLng : 位置座標（google.maps.LatLng）
*/
function startNearbySearch(latLng){
  
  //読み込み中表示
  document.getElementById("results").innerHTML = "Now Loading...";
  
  //Mapインスタンス生成
  var map = new google.maps.Map(
    document.createElement("div")
  );
  
  //PlacesServiceインスタンス生成
  var service = new google.maps.places.PlacesService(map);
  
  //入力したKeywordを取得
  var keywordInput = document.getElementById("keywordInput").value;
  
  //周辺検索
  service.nearbySearch(
    {
      location: latLng,
      radius: 800,
      type: ['restaurant'],
      keyword: keywordInput,
      language: 'ja'
    },
    displayResults
  );
}

/*
 周辺検索の結果表示
 ※nearbySearchのコールバック関数
  results : 検索結果
  status ： 実行結果ステータス
  pagination : ページネーション
*/
function displayResults(results, status, pagination) {
    
  if(status == google.maps.places.PlacesServiceStatus.OK) {
  
    //検索結果をplacesList配列に連結
    placesList = placesList.concat(results);
    const names = placesList.map(item => item.name);
    console.log(names);
    //pagination.hasNextPage==trueの場合、
    //続きの検索結果あり
    if (pagination.hasNextPage) {
      
      //pagination.nextPageで次の検索結果を表示する
      //※連続実行すると取得に失敗するので、
      //1秒くらい間隔をおく
      setTimeout(pagination.nextPage(), 1000);
    
    //pagination.hasNextPage==falseになったら
    //全ての情報が取得できているので、
    //結果を表示する
    } else {
      
      //placesList配列をループして、
      //結果表示のHTMLタグを組み立てる
      var resultHTML = "<ol>";
      
      for (var i = 0; i < placesList.length; i++) {
        place = placesList[i];
        
        //ratingがないのものは「---」に表示変更
        var rating = place.rating;
        if(rating == undefined) rating = "---";
        
        //表示内容（評価＋名称）
        var content = "【" + rating + "】 " + place.name;
        
        resultHTML += "<li>";
        resultHTML += content;
        resultHTML += "</li>";
      }
      
      resultHTML += "</ol>";
      
      //結果表示
      document.getElementById("results").innerHTML = resultHTML;
    }
  
  } else {
    //エラー表示
    var results = document.getElementById("results");
    if(status == google.maps.places.PlacesServiceStatus.ZERO_RESULTS) {
      results.innerHTML = "検索結果が0件です。";
    } else if(status == google.maps.places.PlacesServiceStatus.ERROR) {
      results.innerHTML = "サーバ接続に失敗しました。";
    } else if(status == google.maps.places.PlacesServiceStatus.INVALID_REQUEST) {
      results.innerHTML = "リクエストが無効でした。";
    } else if(status == google.maps.places.PlacesServiceStatus.OVER_QUERY_LIMIT) {
      results.innerHTML = "リクエストの利用制限回数を超えました。";
    } else if(status == google.maps.places.PlacesServiceStatus.REQUEST_DENIED) {
      results.innerHTML = "サービスが使えない状態でした。";
    } else if(status == google.maps.places.PlacesServiceStatus.UNKNOWN_ERROR) {
      results.innerHTML = "原因不明のエラーが発生しました。";
    }

  }
}
;

 var map;
var marker = [];
var infoWindow = [];
var markerData = [ // マーカーを立てる場所名・緯度・経度
  {
       name: 'TAM 東京',
       lat: 35.6954806,
        lng: 139.76325010000005,
        icon: 'tam.png' // TAM 東京のマーカーだけイメージを変更する
 }, {
        name: '小川町駅',
     lat: 35.6951212,
        lng: 139.76610649999998
 }, {
        name: '淡路町駅',
     lat: 35.69496,
      lng: 139.76746000000003
 }, {
        name: '御茶ノ水駅',
        lat: 35.6993529,
        lng: 139.76526949999993
 }, {
        name: '神保町駅',
     lat: 35.695932,
     lng: 139.75762699999996
 }, {
        name: '新御茶ノ水駅',
       lat: 35.696932,
     lng: 139.76543200000003
 }
];

console.log(markerData);
window.onload = function(){
 // 地図の作成
    var mapLatLng = new google.maps.LatLng({lat: markerData[0]['lat'], lng: markerData[0]['lng']}); // 緯度経度のデータ作成
   map = new google.maps.Map(document.getElementById('sample'), { // #sampleに地図を埋め込む
     center: mapLatLng, // 地図の中心を指定
      zoom: 15 // 地図のズームを指定
   });
 
 // マーカー毎の処理
 for (var i = 0; i < markerData.length; i++) {
        markerLatLng = new google.maps.LatLng({lat: markerData[i]['lat'], lng: markerData[i]['lng']}); // 緯度経度のデータ作成
        marker[i] = new google.maps.Marker({ // マーカーの追加
         position: markerLatLng, // マーカーを立てる位置を指定
            map: map // マーカーを立てる地図を指定
       });
 
     infoWindow[i] = new google.maps.InfoWindow({ // 吹き出しの追加
         content: '<div class="sample">' + markerData[i]['name'] + '</div>' // 吹き出しに表示する内容
       });
 
     markerEvent(i); // マーカーにクリックイベントを追加
 }
 
   marker[0].setOptions({// TAM 東京のマーカーのオプション設定
        icon: {
         url: markerData[0]['icon']// マーカーの画像を変更
       }
   });
}
 
// マーカーにクリックイベントを追加
function markerEvent(i) {
    marker[i].addListener('click', function() { // マーカーをクリックしたとき
      infoWindow[i].open(map, marker[i]); // 吹き出しの表示
  });
}

</script>
