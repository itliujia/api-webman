<?php

namespace support;

/**
 * 请求类
 * @author LiuJia
 * @package support
 * @createTime 2024-04-16 14:23:22
 */
class Request extends \Webman\Http\Request
{
    /**
     * 发送网络请求
     * @param string $url 请求地址
     * @param array|null $data 请求数据
     * @param bool $isPost 是否为 POST 请求
     * @param array|null $header 请求头
     * @author LiuJia
     * @createTime 2024-04-19 14:36:24
     */
    public static function sendRequest(
        string $url,
        array  $data = null,
        bool   $isPost = false,
        array  $header = null
    ) {
        // 若为GET请求，则拼接请求参数
        if (!$isPost && isset($data)) {
            $url .= '?' . http_build_query($data);
        }

        $ch = curl_init($url);

        $defaultOptions = [
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_AUTOREFERER => 1,
            CURLOPT_TIMEOUT => 5000,
        ];

        // 设置请求头
        if ($isPost || $header !== null) {
            $headers = [];
            if ($isPost) {
                $headers[] = 'Content-Type: application/json';
            }
            // 用户自定义请求头

            if (is_array($header)) {
                $headers = array_merge($headers, $header);
            }

            $defaultOptions[CURLOPT_HTTPHEADER] = $headers;
        }

        curl_setopt_array($ch, $defaultOptions);

        // 处理 POST 请求
        if ($isPost && !empty($data)) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = ['error' => curl_error($ch)];
            curl_close($ch);
            return $error;
        }

        curl_close($ch);

        // 尝试解析 JSON 响应
        $decodedResult = json_decode($response, true);
        return ($decodedResult !== null) ? $decodedResult : $response;
    }
}
