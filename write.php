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
    <!-- <img src="img/dog.png" alt="" class="dog1">
    <img src="img/dog2.png" alt="" class="dog2"> -->
</div>
<div class="main">

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$newfilename = date("YmsHis")."-".$_FILES["image"]["name"];
$upload = "uploadimg/".$newfilename;

if(move_uploaded_file($_FILES["image"]["tmp_name"],$upload)){
    $date = date("Y年m月d日");
    $title = $_POST["title"];
    $weight = $_POST["weight"];
    $comment = $_POST["comment"];
    $a = ",";
    
    $data = [
        "date" => $date,
        "title" => $title,
        "weight" => $weight,
        "comment" => $comment,
        "image" => $upload
    ];
    
    $file = fopen("./data/data.txt","a");
    fwrite($file,json_encode($data, JSON_UNESCAPED_UNICODE) . PHP_EOL);
    fclose($file);

    // var_dump($data);
    
    echo"<h3>アップロードが完了しました！</h3><a href='read.php'>一覧を見る</a>";

}else{
    echo"<h3>アップロード失敗</h3>";
}

?>
</div>
</body>
</html>