<?php

$review=0;
$jugyou=0;
$not=0;


// データまとめ用の空文字変数
$str = '';

// ファイルを開く（読み取り専用）
$file = fopen('data/data.csv', 'r');
// ファイルをロック
flock($file, LOCK_EX);

// fgets()で1行ずつ取得→$lineに格納
if ($file) {
  while ($line = fgets($file)) {
    // 取得したデータを`$str`に追加する
    //$str .="<tr><td>{$line}</td></tr>";
    if($line=="レビュー会から参加"){$review=$review+1;}
    else if($line=="授業から参加") {$jugyou=$jugyou+1;}
    else if($line=="不参加"){$not=$not+1;}
    //echo $line;
}
};


// ロックを解除する
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);

// `$str`に全てのデータ（タグに入った状態）がまとまるので，HTML内の任意の場所に表示する．


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>textファイル書き込み型todoリスト（入力画面）</title>
</head>

<body>
  <form action="todo_txt_create.php"method="POST">
    <fieldset>
      <legend>授業アンケート</legend>
      <a href="todo_txt_read.php">一覧画面</a>
      <div>
        <p><input type="radio" name="join"value="レビュー会から参加">レビュー会から参加</p>
        <p><input type="radio" name="join" value="授業から参加">授業から参加</p>
        <p><input type="radio" name="join"  value="不参加">不参加</p>
    
      </div>
    
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form

  <fieldset>
    <legend>textファイル書き込み型todoリスト（一覧画面）</legend>
    <a href="todo_txt_input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th>todo</th>
        </tr>
      </thead>
      <tbody>
      <?= $str ?>
      </tbody>
    </table>
  </fieldset>

  <canvas id="myBarChart"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

  <script>
  var ctx = document.getElementById("myBarChart");
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['8月1日'],
      datasets: [
        {
          label: 'レビュー会から参加',
          data: [62],
          backgroundColor: "rgba(219,39,91,0.5)"
        },{
          label: '授業から参加',
          data: [55],
          backgroundColor: "rgba(130,201,169,0.5)"
        },{
          label: '不参加',
          data: [33],
          backgroundColor: "rgba(255,183,76,0.5)"
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: '参加者'
      },
      scales: {
        yAxes: [{
          ticks: {
            suggestedMax: 100,
            suggestedMin: 0,
            stepSize: 10,
            callback: function(value, index, values){
              return  value +  '人'
            }
          }
        }]
      },
    }
  });
  </script>

</body>

</html> 