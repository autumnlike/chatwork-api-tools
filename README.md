chatwork-api-tools
==================

チャットワークのAPIを使ったツール系

## push.php

タスク、メッセージを登録します。

### 利用方法

```php push.php token==自分のAPIトークン type=={messages, tasks} room_id==ルームID to_ids==ID_1,ID_2,... limit==Y-m-d body==本文```

引数でもろもろ渡してタスクを登録できます。
to_ids に設定したら、[To:ID]で通知させるような形になってます。

※ message の場合はto_idsはオプションです。

cron などに登録して定期的に発生するタスクを登録するなどのイメージです。
