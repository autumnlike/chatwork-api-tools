<?php

/**
 * チャットワークにPOSTリクエストを送る
 *
 * @param int roomId
 * @param string $token
 * @param array $param - POSTの値に含めたい値配列
 * @param string $type - 処理の種類
 * @access public
 * @return void
 */
function post($roomId, $token, $params, $type = null) {
    __request($roomId, $token, $params, $type, 'POST');
}

/**
 * チャットワークにリクエストを送る
 *
 * $type, $method による処理内容 については、
 * http://developer.chatwork.com/ja/endpoint_rooms.html を参照ください
 *
 * @param int roomId
 * @param string $token
 * @param array $param - POSTの値に含めたい値配列
 * @param string $type - 処理の種類
 * @param string $method - GET | PUT | POST | DELETE
 * @access public
 * @return void
 */
function __request($roomId, $token, $params, $type, $method = 'POST') {
    $url = "https://api.chatwork.com/v1/rooms/{$roomId}/{$type}";

    $headers = array(
        'X-ChatWorkToken:' . $token,
        "Content-Type: application/x-www-form-urlencoded",
        "Content-Length: " . strlen(http_build_query($params))
    );
    $options = array('http' => array(
        'method' => 'POST',
        'content' => http_build_query($params),
        'header' => implode("\r\n", $headers),
    ));

    if (!$contents = file_get_contents($url, false, stream_context_create($options))) {
        echo "処理失敗しました\n";
    }
}
