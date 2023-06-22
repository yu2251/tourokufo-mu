<?php
// POSTデータ確認
if (
    !isset($_POST['name']) || $_POST['name'] === '' ||
    !isset($_POST['tel']) || $_POST['tel'] === ''||
    !isset($_POST['sex']) || $_POST['sex'] === '' ||
    !isset($_POST['age']) || $_POST['age'] === '' ||
    !isset($_POST['postn']) || $_POST['postn'] === '' ||
    !isset($_POST['address']) || $_POST['address'] === '' ||
    !isset($_POST['bank']) || $_POST['bank'] === '' ||
    !isset($_POST['bankcode']) || $_POST['bankcode'] === '' ||
    !isset($_POST['deadline']) || $_POST['deadline'] === ''
    ) {
    exit('ParamError');
  }

    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $postn = $_POST['postn'];
    $address = $_POST['address'];
    $bank = $_POST['bank'];
    $bankcode = $_POST['bankcode'];
    $deadline = $_POST['deadline'];
    
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
$sql = 'INSERT INTO basic_data1(id, name, tel, sex, age, postn, address, bank, bankcode, deadline) VALUES (NULL, :name, :tel, :sex, :age, :postn, :address, :bank, :bankcode, :deadline); ALTER TABLE `basic_data1` MODIFY COLUMN bankcode DECIMAL(4,0) ZEROFILL;';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
$stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
$stmt->bindValue(':age', $age, PDO::PARAM_STR);
$stmt->bindValue(':postn', $postn, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':bank', $bank, PDO::PARAM_STR);
$stmt->bindValue(':bankcode', $bankcode, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Localtion:todo_input.php');
exit();