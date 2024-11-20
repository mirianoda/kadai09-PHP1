<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>うちの子成長日記</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-2.1.3.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Tint&family=Cinzel+Decorative:wght@400;700;900&family=Cinzel:wght@400..900&family=Dongle:wght@300;400;700&family=Galada&family=Hachi+Maru+Pop&family=Montserrat+Alternates:wght@100;200;300;400&family=Poiret+One&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Zen+Kaku+Gothic+New:wght@300;400;500;700&family=Zen+Maru+Gothic&display=swap" rel="stylesheet">
</head>
<body>
<div class="top">
    <h1>うちの子成長日記</h1>
    <img src="img/dog.png" alt="" class="dog1">
    <img src="img/dog2.png" alt="" class="dog2">
</div>
<div class="main">
    <form action="write.php" method="post" enctype="multipart/form-data">
        <div><p>タイトル</p><input type="text" name="title" class="title"></div>
        <div><p>現在の体重</p><input type="text" name="weight" class="weight">&nbsp; kg</div>
        <div><p>コメント</p><textarea name="comment" class="comment"></textarea></div>
        <div><p>今日の写真</p><input type="file" name="image" class="image" accept="image/*"></div>
        <div class="preview">
            <img class="preview-img">
        </div>
        <div class="submit-wrapper">
            <p class="dog-1">&emsp;</p><p class="dog-2">&emsp;</p><p class="dog-3">&emsp;</p><p class="dog-4">&emsp;</p>
            <input type="submit" value="アップロード" class="submit">
        </div>
    </form>
</div>

<script>
    //アップロードボタンのホバーアクション
    $(".submit").hover(
        function(){
        $(this).css("background-color","rgb(255, 123, 0)");
        $(".dog-1, .dog-2, .dog-3, .dog-4").css("display","block");
        },
        function(){
        $(this).css("background-color","#686868");
        $(".dog-1, .dog-2, .dog-3, .dog-4").css("display","none");
        }
    );

    //画像を選択した際のプレビュー動作
    $(".image").on("change",function(event){
        const file = event.target.files[0]; //files配列に格納された0番目のファイルを取得
        if(file){
            const reader = new FileReader(); //FileReaderクラスをインスタンス化
            reader.readAsDataURL(file) //readerインスタンスのresultプロパティに、ファイルのURLをセット
            reader.onload = function(){
                $(".preview-img").attr("src",reader.result);
            };
        }
    });
</script>

    
</body>
</html>