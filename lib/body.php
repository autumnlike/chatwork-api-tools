<?php

/**
 * 本文に [To:1234] をセットする
 *
 * @param string $body
 * @param string $toIds - 1,2,3,4
 * @return string
 * @access public
 */
function set_to_message($body, $toIds) {
    // To設定
    if (!empty($toIds)) {
        $to = null;
        foreach (preg_split('/,/', $toIds) as $id) {
            $to .= "[To:{$id}]";
        }
        $body = $to . "\n\n" . $body;
    }
    return $body;
}
