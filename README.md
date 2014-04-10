chatwork-api-tools
==================

チャットワークのAPIを使ったツール系

## put_task.php

タスクを登録します。
まだ途中です。ソースも汚いです。

### 利用方法

```php put_task.php token==TOKEN room_id==ROOM_ID to_ids==ID_1,ID_2,ID_3 limit=Y-m-d body==本文```

引数でもろもろ渡してタスクを登録できます。
to_ids に設定したら、[To:ID]で通知させるような形になってます。
