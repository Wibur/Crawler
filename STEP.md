# Crawler - Scrape WebSite

## 環境
使用laradock
> cd laradock

- 此專案只要開啟以下三個 如有其他需求可以自行開啟
> docker-compose up -d nginx mysql phpmyadmin

- 關閉所有容器
> docker stop $(docker ps -aq)

## 開啟後 進入workerspace 容器
> docker exec -it xxxxx /bin/bash

## 執行指令
- npm install
- composer install
- php artisan migrate

## phpmyadmin default
- server => mysql
- username => default
- password => secret

## 參考文獻
- [Laradock](https://laradock.io/).
- [ScreenShot](https://github.com/spatie/browsershot).
- [Goutte](https://github.com/FriendsOfPHP/Goutte).
