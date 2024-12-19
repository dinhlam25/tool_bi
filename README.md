# Webike BI

## docker-comopse.ymlをコピー
`.docker-compose.yml.local`のコピーを作成して`docker-compose.yml`にリネームする  

## docker立ち上げ
  docker-compose up -d  

## .env設定
`.env.local`のコピーを作成して`.env`にリネームする

## 各ライブラリをインストール
  docker exec -it webike-bi-laravel_app-1 npm run build  

下記にアクセスできればOK  
http://localhost:8000

## Run batch to aggregate information about supplier orders/sales on a monthly basis
  docker exec -it  webike-bi-laravel_app-1 php artisan command:aggregate-monthly-orders