# 如何建構：

1. 將 .env.example 文件更名為 .env：
```
mv .env.example .env
```

2. 設置所需的環境變數：
```
# 專案名稱
PROJECT_NAME=
APP_VERSION=

# MYSQL 設定
MYSQL_USER=
MYSQL_PASSWORD=
MYSQL_DATABASE=

# LARAVEL
LOG_CHANNEL=
APP_URL=
APP_NAME=
APP_ENV=
APP_KEY=
APP_DEBUG=
```
3. 命令建構 Docker 映像並運行容器：
```
docker-compose up -d --build
```
- -d 選項告訴 Docker Compose 在後台運行容器。
- --build 選項告訴 Docker Compose 構建映像。
> 如果您使用的是 Docker Compose v2，可以將 --build 替換為 - --renew-anon-volumes --build，以防止由於緩存而使用過時的容器。
---
**完成以上步驟後，Docker 將使用您在 .env 文件中指定的環境變量來構建和運行容器。您可以使用 docker ps 命令來檢查容器是否正常運行。如果一切正常，您應該可以看到正在運行的容器列表。如果出現任何問題，您可以使用 docker logs 命令來檢查容器的日誌文件，以尋找問題的原因。**