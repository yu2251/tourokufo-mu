<?php
$dbn ='mysql:dbname=gs_d13_26_test;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

$sql = "SELECT bank FROM bank_data1";

$statement = $pdo->query($sql);
if ($statement === false) {
    echo "クエリ実行エラー: " . $pdo->errorInfo()[2];
    exit();
}

$bankNames = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $bankNames[] = $row["bank"];
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>基本情報入力</title>
</head>

<body>
  <form  action="todo_create.php" method="POST">
    <fieldset>
      <legend>基本情報入力（入力画面）</legend>
      <a href="todo_read.php">入力履歴確認画面</a>
      <div>
        名前: <input type="text" name="name">
      </div>
      <div>
        TEL: <input type="number" maxlength="7" name="tel">
      </div>
      <div>
        性別: <select name="sex">
                <option value="man">男性</option>
                <option value="woman">女性</option>
              </select>
      </div>
      <div>
        年齢: <input type="number" maxlength="3" name="age" size="3">
      </div>
      <div>
        郵便番号: <input id="input" class="zipcode" type="number" maxlength="10" name="postn">
        <button id="search" type="button">住所検索</button><td id="error"></td>
      </div>
      <div>
        住所: <input id='address1' type="text" name="address" size="30">
      </div>
      <div>
        銀行名: <input type="text" name="bank" autocomplete="new-password" list="bankList">
        <datalist id="bankList" size="5">
        <?php foreach ($bankNames as $bankName) { ?>
          <option value="<?php echo $bankName; ?>">
        <?php } ?>
        </datalist>銀行
      </div>
      <div>
        銀行コード: <input type="number" maxlength="4" name="bankcode">
      </div>
      <div>
        登録日: <input type="date" name="deadline">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
   let api = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=';

// 郵便番号から住所自動入力
   $('#search').on('click', function () {
        var input = $('#input');
        var param = input.val().replace("-", ""); //入力された郵便番号から「-」を削除
        let requestUrl = api + param;
        axios
            .get(requestUrl)
            .then(function (response) {
                // リクエスト成功時の処理（responseに結果が入っている）
                // 郵便APIからデータ取得
                console.log(response.data.results);
                const address = response.data.results[0].address1 + response.data.results[0].address2 + response.data.results[0].address3
                // 住所を表示
                $('#address1').val(address);
            })
            .catch(function (error) {
                // リクエスト失敗時の処理（errorにエラー内容が入っている）
                console.log(error);
            })
            .finally(function () {
            });
    });
</script>
</body>

</html>