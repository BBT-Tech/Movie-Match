# Movie-Match-of-BBT-in-November-2018
1. 配置laravel运行环境：
    - 配置服务器。以`movie-match`为页面根目录为例，Nginx的设置如下：
    ```
    location /movie-match/api {
        if ($fastcgi_script_name ~ /movie-match/api(/.*)$) {
            set $request_uri_changed $1;
        }
        include fastcgi_params;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_param SCRIPT_FILENAME $document_root/movie-match/api/public/index.php;
        fastcgi_param REQUEST_URI $request_uri_changed;
    }
    ```
    - 添加`.env`文件，完成相应的配置。
    - 建立数据库和相应的用户，运行`create.sql`，建立数据表。
    - 添加两次匹配定时任务到`crontab`，详见[官方文档](https://laravel.com/docs/5.5/scheduling)。若该操作麻烦可以考虑`api/route/web.php`中被注释的`match1`和`match2`这两个路由，直接通过随机字符串地址下的web页面进行（骚）操作。
2. 构建前端页面。或直接从项目的`frontend/dist`中取出。
3. 删除不必要的文件。