# Happy Partner Blog

## 開發環境建置

### Prerequisite

1. 需先下載 [Docker Desktop](https://docs.docker.com/desktop/) 或 [OrbStack](https://orbstack.dev/)
2. 需先確認本地 80 port 沒有被佔走

### 安裝與啟動步驟

1. 複製環境設定檔
```
cp .env.example .env
```

2. 進入 .env 設定 PostgreSQL 的帳號密碼

```dotenv
DB_DATABASE=happy_partner_blog
DB_USERNAME=laravel
# 務必設定密碼
DB_PASSWORD=password
```

3. 如果是 Linux User，需先執行：
```bash
# 建立 docker 群組（大多數發行版安裝時已自動建立）
sudo groupadd docker 2>/dev/null || true

# 讓 <你的 User> 也屬於 docker 群組
sudo usermod -aG docker <你的 User>
```

4. 安裝 composer 套件
```
composer install
```
若本機未安裝 composer，請執行第二段程式碼
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

6. 執行資料表 migration 並執行 seeder
```
./vendor/bin/sail artisan migrate --seed
```

7. File Storage
```bash
./vendor/bin/sail artisan storage:link
```

8. 執行 Vite 前端開發環境
```
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

9. 進入 http://localhost 確認已成功建置開發環境

### Login credentials for testing

Admin(`/admin`)
```
email => test@example.com
password => password'
```
