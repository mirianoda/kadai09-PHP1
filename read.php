<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>うちの子成長日記</title>
    <link rel="stylesheet" href="css/style2.css">
    <script src="js/jquery-2.1.3.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Tint&family=Cinzel+Decorative:wght@400;700;900&family=Cinzel:wght@400..900&family=Dongle:wght@300;400;700&family=Galada&family=Hachi+Maru+Pop&family=Montserrat+Alternates:wght@100;200;300;400&family=Poiret+One&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Zen+Kaku+Gothic+New:wght@300;400;500;700&family=Zen+Maru+Gothic&display=swap" rel="stylesheet">
</head>
<body>
<div class="top">
    <h1>うちの子成長日記</h1>
    <img src="img/dog.png" alt="" class="dog1">
    <!-- <img src="img/dog2.png" alt="" class="dog2"> -->
</div>
<div class="main">
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dataFile = "./data/data.txt";
$dataList = [];

if(file_exists($dataFile)){
    $lines = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach($lines as $line){
        $dataList[] = json_decode($line,true);
        // var_dump($dataList);
    }
}else{
    echo"<h3>データが存在しません</h3>";
    exit;
}

$jsonData = json_encode($dataList, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); // PHP配列をJSONに変換
?>

<div class="posts" id="posts">
</div>
</div>

<div class="btn">
<a href="post.php">新しく日記を書く</a>
</div>

<div class="chart">
    <h3>体重の変化</h3>
    <canvas id="chart_area"></canvas>
    <!-- Chart.jsをインポート -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
  

</div>

<script>
    const data = <?=$jsonData?>;
    console.log(data);

    //表示場所を取得
    const posts = document.getElementById("posts");

    //データをループして画面に表示
    data.forEach(item =>{

        //データを取得して要素を作成
        const itemDiv = document.createElement("div");
        itemDiv.className = "post";

        const pin = document.createElement("img");
        pin.src = "img/pin.png";
        pin.className = "pin";
        const date = document.createElement("p");
        date.textContent = item.date;
        date.className = "date";
        const title = document.createElement("h2");
        title.textContent = item.title;
        const image = document.createElement("img");
        image.src = item.image;
        image.alt = item.title;
        image.className = "image";
        const comment = document.createElement("p");
        comment.textContent = item.comment;
        comment.className = "comment";

        //要素を組み立て
        itemDiv.appendChild(pin);
        itemDiv.appendChild(date);
        itemDiv.appendChild(title);
        itemDiv.appendChild(image);
        itemDiv.appendChild(comment);

        //表示場所に追加
        posts.appendChild(itemDiv);
    });

    //体重グラフを作成
    const chart_area = document.getElementById("chart_area");

    const labels = data.map(item => item.date);
    const weights = data.map(item => item.weight);

    const myLineChart = new Chart(chart_area,{
        type: "line",
        data:{
            labels: labels,
            datasets: [{
                label:"体重",
                data:weights,
                borderColor:"rgb(255, 165, 0)",
                backgroundColor:"rgba(255, 165, 0, 0.2)",
                borderWidth:2,
                fill:true
            }]
        },
        option:{
            title:{
                display:true,
                text:"体重の変化"
            },
            scales:{
                yAxes:[{
                    ticks:{
                        suggestedMax:10,
                        suggestedMin:0,
                        stepSize: 0.1,
                        callback: function(value,index,values){
                            return value + "kg";
                        }
                    }
                }]
            }
        }
    });  
</script>
</body>
</html>