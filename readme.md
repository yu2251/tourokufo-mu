# プロダクトのタイトル
  個人情報登録システム

# 概要（どんなものか，どうやって使うか，など）
  各入力欄に入力すると個人情報を登録できます。
  リードページで入力されたデータを確認も可能です。
  
# 工夫した点，こだわった点
  ・郵便番号欄に入力してボタンを押すと住所欄に住所が自動入力されます。
    (郵便番号検索APIを実装)
  ・銀行名欄にサジェスト機能が実装されており、入力しようとすると
    候補の銀行名が表示されます。サジェスト機能で出てくる銀行名は
    zengin-pyのものを使用しています
 ・リードページから削除ボタンを押すと、
    phpmyadminのデータも削除できるようにしています。

# 苦戦した点，もう少し実装したかった点
  ・当初はpythonで作って、銀行名を入力したら銀行コードが自動入力、
    候補の支店名まで表示させる予定でしたが、データの取得はできたもの
    上手くhtmlで表示させられず断念しました。
  ・デザインは実習で使ったものそのままなので、
    次回はCSSも意識して作っていこうと思いました。
  ・個人的な反省としてXAMPPで全てstopも、quitもさせず、
    右上のバツ印を押して終了させたためデータが全て消えてしまいました。
    丁寧に作業をすること、バックアップもしておくことの大切さを実感しました。

# 参考URL
  ・ZenginCode
  https://github.com/zengin-code/zengin-py
 ・Pythonで国内の銀行コードと支店コードを取得する
  https://zenn.dev/shimakaze_soft/articles/c398bda757eeec
 ・【Pythonの動かし方とは】実行方法を初心者向けに1から解説
  https://www.sejuku.net/blog/105909
 ・最初の Python アプリケーションの作成
  https://learn.microsoft.com/ja-jp/training/modules/python-install-vscode/6-exercise-first-application?pivots=windows
・pipとは？Pythonのライブラリ管理方法を分かりやすく解説！
  https://and-engineer.com/articles/YUGdqRAAACIAsGy_
・データベースまたはテーブルをインポートする
  https://www.javadrive.jp/phpmyadmin/export-import/index3.html#:~:text=phpMyAdmin%20%E3%81%AB%E7%AE%A1%E7%90%86%E8%80%85%E3%83%A6%E3%83%BC%E3%82%B6%E3%83%BC,%E3%82%92%E9%81%B8%E6%8A%9E%E3%81%97%E3%81%A6%E3%81%8F%E3%81%A0%E3%81%95%E3%81%84%E3%80%82
・PHPとJavaScriptの間で変数の値をやり取りする方法
  https://brainlog.jp/programming/post-538/
・フォームで入力された値を取得($_POST, $_FILES)
  https://www.wakuwakubank.com/posts/428-php-form/
・MySQL】よく使うデータ型をまとめて紹介（テーブル設計）
  https://marunaka-blog.com/mysql-data-type/3608/


