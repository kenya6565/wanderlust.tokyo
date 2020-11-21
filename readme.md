
## Wanderlust

https://wanderlust1234.herokuapp.com

https://wanderlust.tokyo
(普段はAWSのコストが発生してしまう為、停止)

Wanderlustは世界の名所を投稿してシェアできるSNSサイトです
<p>Wanderlustとは英語で旅をしたい、世界を知りたいという強い気持ち、欲望、衝動のことをあらわす言葉です。</p>
<p>このアプリを機に少しでも多くの方が海外に興味を持っていただければと思います。</p>
<p align="center">
 <img width="1316" alt="スクリーンショット 2020-08-18 1 41 01" src="https://user-images.githubusercontent.com/61537178/90506002-8b7c3480-e18e-11ea-8098-45297f59f31f.png">
</p>


## 概要

合計約2年間オーストラリアとインドで海外留学、海外インターンを経験しました。
そこで偶然巡り合った人との出会い、文化、繋がりを自分だけの記憶ではなく記録として残るように世界中の仲間、コミュニティと共感、シェアできるようなサービスを作りたいと思ったからです。


## 機能一覧

- ユーザー登録、ログイン
- 簡単ログイン
- CRUD機能
- 画像複数投稿機能(intervention/image)
- 言語変更機能（日・英）
- ページネーション機能
- 検索機能
- いいね機能(Ajax)
- いいね数を動的に表示する機能(Ajax)
- 投稿した名所をGoogleMapで表示する機能
- レスポンシブデザイン
- コメント機能
- マイアイコン設定機能
- 鍵アカウント機能
- フォローリクエスト,承認,拒否機能
- フォロー/フォロー解除機能
- パンくずリスト(laravel-breadcrumbs)
- トップ画面で10種類の世界の名所がランダムで表示される
- ソート機能(昇順,降順)
- お問い合わせ
- 単体テスト


## 使用技術

- PHP 7.2.31
- Laravel  5.8.38
- Docker,Docker-compose
- CircleCi
- mysql 5.7.30(開発環境)
- JavaScript (jQuery)
- Bootstrap
- AWS (cloud9,VPC,EC2,S3,RDS,Route53,ELB,ACM,IAM)
- Git, GitHub
- nginx
- Heroku
- mailtrap
- sorcetree
- VScode

## インフラ構成図

<img width="1355" alt="スクリーンショット 2020-10-19 2 13 28" src="https://user-images.githubusercontent.com/61537178/96374925-b8f65600-11b0-11eb-98b3-c5fc9913c95c.png">

## ER図

<img width="821" alt="スクリーンショット 2020-08-18 21 48 35" src="https://user-images.githubusercontent.com/61537178/90514786-9c33a700-e19c-11ea-9e3e-bab6f2076371.png">


## 開発において意識した事

- 使用方法がわかりやすいシンプルなUIデザインになるように心がけました。
- 全体的に統一感のある印象を持つようなビューになるようにしました。
- ポートフォリオの内容は誰かの悩みを解決できるサービスにしようと心がけました。(気軽に世界の名所を投稿、共有、閲覧できる内容です。)
- GitHubによるisuue管理を繰り返すことでチーム開発を見据えて開発を行ってきました。
- 他者との差別化、モダンな技術の採用のためにdocker,CiecleCI,AWSをそれぞれ採用しました


