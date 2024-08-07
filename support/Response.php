<?php

namespace support;

use Exception;
use utils\TimeTool;


/**
 * 响应类
 * @author LiuJia
 * @package support
 * @createTime 2024-04-16 14:23:54
 */
class Response extends \Webman\Http\Response
{
    /**
     * @param mixed $data 返回数据
     * @param string $msg 提示信息
     * @param int $code 返回码
     * @author LiuJia
     * @createTime 2024-04-16 14:56:14
     */
    public static function data(
        mixed  $data = [],
        string $msg = 'OK',
        array  $extend = [],
        int    $code = 0
    ): Response
    {
        $responseData = ['code' => $code, 'data' => $data, 'msg' => $msg];
        $responseData = array_merge($responseData, $extend);
        return self::result($responseData);
    }

    /**
     * 返回结果
     * @param object|array $data 返回数据
     * @param int $status 响应状态码
     * @param int $options 响应配置
     * @author LiuJia
     * @createTime 2024-04-16 14:53:47
     */
    public static function result(
        object|array $data = [],
        int          $status = 200,
        int          $options = JSON_UNESCAPED_UNICODE
    ): Response
    {
        $response = response();
        $response->withStatus($status);
        $response->header('Content-Type', 'application/json');
        $data['server_time'] = TimeTool::currentTime('ms');
        $response->withBody(json_encode($data, $options));
        return $response;
    }

    /**
     * 返回数据列表
     * @param array $list 返回数据
     * @param int $total 数据总数
     * @param string $msg 提示信息
     * @param int $code 返回码
     * @author LiuJia
     * @createTime 2024-04-16 14:57:38
     */
    public static function lists(
        array  $list = [],
        int    $total = 0,
        array  $extend = [],
        string $msg = 'OK',
        int    $code = 0
    ): Response
    {
        $total = $total == 0 ? count($list) : $total;
        $responseData = ['code' => $code, 'total' => $total, 'data' => $list, 'msg' => $msg];
        $responseData = array_merge($responseData, $extend);
        return self::result($responseData);
    }

    /**
     * 返回提示信息
     * @param string $msg 提示消息
     * @param int $code 返回码
     * @param int $status 响应状态码
     * @author LiuJia
     * @createTime 2024-04-16 15:00:50
     */
    public static function msg(string $msg = 'OK', int $code = 0, int $status = 200): Response
    {
        $responseData = ['code' => $code, 'msg' => $msg];
        return self::result($responseData, $status);
    }

    /**
     * 返回错误结果
     * @param Exception $exception 异常
     * @param int $status 响应状态码
     * @author LiuJia
     * @createTime 2024-04-16 15:02:17
     */
    public static function error(Exception $exception, int $status): Response
    {
        $error = [
            'msg' => $exception->getMessage(),
            'error' => [
                'code' => $exception->getCode(),
                'trace' => $exception->getTrace(),
                'file' => $exception->getFile(),
            ],
            'code' => 502
        ];
        return self::result($error, $status);
    }
}
