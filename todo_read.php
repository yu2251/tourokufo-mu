<?php

// DB接続
// 各種項目設定
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

// SQL作成&実行
$sql = 'SELECT * FROM basic_data1 ORDER BY deadline DESC';
$stmt = $pdo->prepare($sql);
// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["name"]}</td>
      <td>{$record["tel"]}</td>
      <td>{$record["sex"]}</td>
      <td>{$record["age"]}</td>
      <td>{$record["postn"]}</td>
      <td>{$record["address"]}</td>
      <td>{$record["bank"]}銀行</td>
      <td>{$record["bankcode"]}</td>
      <td>{$record["deadline"]}</td>
      <td><button class='btn{$record["id"]}'data-id='{$record["id"]}'>削除</button></td>
    </tr>
  ";
}

// 削除ボタンがクリックされたときの処理
if (isset($_POST["delete_id"])) {
  $deleteId = $_POST["delete_id"];

  // 削除するSQL文の作成
  $deleteSql = "DELETE FROM basic_data1 WHERE id = :id";

  // プリペアドステートメントの作成
  $deleteStmt = $pdo->prepare($deleteSql);

  // パラメータのバインド
  $deleteStmt->bindValue(":id", $deleteId, PDO::PARAM_INT);

  // SQLの実行
  $deleteStmt->execute();

  // 削除後の処理などを記述

  // レスポンスの返却（JSON形式）
  echo json_encode(["message" => "レコードを削除しました"]);
  exit();
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型リスト（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>入力履歴確認画面</legend>
    <a href="todo_input.php">基本情報入力画面</a>
    <table>
      <thead>
        <tr>
          <th>名前</th>
          <th>TEL</th>
          <th>性別</th>
          <th>郵便番号</th>
          <th>住所</th>
          <th>銀行名</th>
          <th>銀行コード</th>
          <th>登録日</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>  
      </tbody>
    </table>
  </fieldset>
  <script>
  // ボタンクリック時の処理
  const buttons = document.querySelectorAll("[class^='btn']");
  buttons.forEach(button => {
    button.addEventListener("click", () => {
      const deleteId = button.getAttribute("data-id");

      // 削除リクエストの送信
      fetch("todo_read.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `delete_id=${deleteId}`
      })
      .then(response => response.json())
      .then(data => {
        // レスポンスの処理などを記述
        console.log(data.message);
      })
      .catch(error => {
        console.error("エラーが発生しました", error);
      });
    });
  });
</script>
</body>

</html>