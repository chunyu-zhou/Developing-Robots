<?php

/**
 * @param $url
 * @param string $method
 * @param array $data
 * @param array $headers
 * @param int $timeout
 * @return mixed
 */
function curlSend($url, $method = 'GET', $data = [], $headers = [], $timeout = 5)
{
    $ch = curl_init(); //初始化CURL句柄
    curl_setopt($ch, CURLOPT_HEADER, false);
    $headers[] = "X-HTTP-Method-Override: $method";
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); //设置请求的URL
    curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); //设置请求方式
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);//设置HTTP头信息
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//设置提交的字符串
    $document = curl_exec($ch);//执行预定义的CURL
    curl_close($ch);
    return json_decode($document, true) ? json_decode($document, true) : $document;
}

function getIp(){
    $url = 'https://api.ip.la/cn?json';
    $data = curlSend($url);
    return $data['ip'];
}
