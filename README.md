chatwork-api-tools
==================

チャットワークのAPIを使ったツール系

## put_task.php

タスクを登録します。
まだ途中ですがうごきます。

### 利用方法

```php put_task.php token==自分のAPIトークン room_id==ルームID to_ids==ID_1,ID_2,... limit=Y-m-d body==本文```

引数でもろもろ渡してタスクを登録できます。
to_ids に設定したら、[To:ID]で通知させるような形になってます。

cron などに登録して定期的に発生するタスクを登録するなどのイメージです。
