# php-img-post

## アプリの仕様
- 投稿した画像が一覧表示される。
- 画像投稿ができる。
- 投稿にコメントを記載できる。
- コメントの更新ができる。
- 投稿の削除ができる。


## サンプルデータのリストア
```
% docker container exec -i mysql mysql -uroot -ppass image_post < ./php-img-post/smaple-data.sql 

  docker container exec -i [コンテナ名] mysql -u[ユーザ] -p[パスワード] [DB] < [ダンプファイル]
```


## 動作環境
- macOS version 10.15.2
- PHP 7.2.26
- MySQL 8.0.19
- Docker version 19.03.5


## 参考資料
[【PHP・MySQL】データベースに画像ファイルを保存・表示する方法](https://codeforfun.jp/save-images-php-and-mysql/)
