# Happy Partner Blog

## 開發環境建置

本專案透過 [Laravel Sail](https://laravel.com/docs/sail) 建立容器化開發環境。

### 安裝與啟動步驟

1. 複製環境設定檔
```
cp .env.example .env
```
2. 進入 .env 設定 PostgreSQL 的帳號密碼
3. 安裝 composer 套件，若本機未安裝 composer，請執行第二段程式碼
```
composer install
```
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```
4. 啟動容器
```
./vendor/bin/sail up -d

```
5. 產生應用金鑰
```
./vendor/bin/sail artisan key:generate
```
6. 執行資料表 migration
```
./vendor/bin/sail artisan migrate
```
7. 執行 seeder 建立 admin 帳號
```
./vendor/bin/sail artisan db:seed
```
8. 執行 Vite 前端開發環境
```
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```