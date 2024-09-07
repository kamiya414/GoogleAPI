<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Navitime API</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        pre {
            white-space: pre-wrap;
            word-wrap: break-word;
            background: #f4f4f4;
            padding: 10px;
            border-radius: 4px;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="button"] {
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
        }
        #result {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Navitime API</h1>
    <form>
        <lavel for = "start">start:</lavel>
        <input id = "start" type = "text" value = "35.6809591,139.7673068">
         <lavel for = "goal">goal:</lavel>
        <input id = "goal" type = "text" value = "34.7022887,135.4953509">
        <input type="button" value="検索" onclick="search();">
    </form>
    <div id="result"></div>
    <script>
        const apiUrl = 'https://navitime-route-totalnavi.p.rapidapi.com/route_transit?';
        const options = {
                method: 'GET',
                headers: {
                    'x-rapidapi-key': '4f42ad5d2emsh06889621cfeb954p11a364jsnf851bc036940',
                    'x-rapidapi-host': 'navitime-route-totalnavi.p.rapidapi.com'
                }
            };
        
        function search() {
            const start = document.getElementById("start").value; // 出発地（緯度, 経度）
            const goal = document.getElementById("goal").value;;  // 目的地（緯度, 経度）
            const requestUrl = `${apiUrl}start=${start}&goal=${goal}&start_time=2022-01-19T10:00:00`;
            //リセット
            document.getElementById('result').innerHTML = "";
            
            fetch(requestUrl, options)
                .then(response => response.json())
                .then(data => {
                    const item = data.items[0];
                    if (item) {
                        const totalTime = item.summary.move.time; // 合計でかかる時間（秒）
                        const fare = item.summary.move.fare.unit_0; // 一回分の運賃
                        const moveType = item.summary.move.move_type.join(", "); // ルート情報

                        // 結果をHTMLに表示
                        document.getElementById('result').innerHTML = `
                            <p><strong>合計時間:</strong> ${totalTime}分</p>
                            <p><strong>ルート情報:</strong> ${moveType}</p>
                            <p><strong>運賃:</strong> ${fare} 円</p>`;
                    } else {
                        document.getElementById('result').innerHTML = 'データが取得できませんでした。';
                    }
                })
                .catch(error => {
                    document.getElementById('result').innerHTML = 'ルート取得失敗';
                });
        }
    </script>
</body>
</html>





    