
## Wanderlust

https://wanderlust1234.herokuapp.com

https://wanderlust.tokyo
(普段はAWSのコストが発生してしまう為、停止)

Wanderlustは世界の名所を投稿してシェアできるサービスです
<p>Wanderlustとは英語で旅をしたい、世界を知りたいという強い気持ち、欲望、衝動のことをあらわす言葉です。</p>
<p>このサービスが旅行を単なる思い出づくりで終わらせるのではなく、人生の中での大切な記録として残すお手伝いができる事を願っています。</p>

<p align="center">
 <img width="1316" alt="スクリーンショット 2020-08-18 1 41 01" src="https://user-images.githubusercontent.com/61537178/90506002-8b7c3480-e18e-11ea-8098-45297f59f31f.png">
</p>


## 概要

私は約2年間オーストラリアとインドで海外留学、海外インターンを経験しました。

その中で様々な観光名所を仲間と巡る機会があったのですが、実際に旅に特化して訪れた観光地をインターネット上に投稿して、共感、シェアできるようなサービスが見つかりませんでした。
そこで私自身がそのようなwebアプリケーションを作ることで、同様の問題を抱えてた人に対して、何か価値提供ができると思いWanderlustというサービスを作りました

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

<img width="1042" alt="スクリーンショット 2020-11-22 20 11 55" src="https://user-images.githubusercontent.com/61537178/99902445-3c035280-2d01-11eb-8da9-a35f89b36dce.png">


## 開発において意識した事

- 使用方法がわかりやすいシンプルなUIデザインになるように心がけました。
- 全体的に統一感のある印象を持つようなビューになるようにしました。
- ポートフォリオの内容は誰かの悩みを解決できるサービスにしようと心がけました。(気軽に世界の名所を投稿、共有、閲覧できる内容です。)
- GitHubによるisuue管理を繰り返すことでチーム開発を見据えて開発を行ってきました。
- 他者との差別化、モダンな技術の採用のためにdocker,CiecleCI,AWSをそれぞれ採用しました


