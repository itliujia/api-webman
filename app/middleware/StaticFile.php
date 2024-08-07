<?php

namespace app\middleware;

use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

/**
 * 静态文件类
 * @author LiuJia
 * @package app\middleware
 * @createTime 2024-04-16 15:09:14
 */
class StaticFile implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        if (str_contains($request->path(), '/.')) {
            return response('<h1>403 forbidden</h1>', 403);
        }

        $response = $handler($request);

        // Add cross domain HTTP header
        /*$response->withHeaders([
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Credentials' => 'true',
        ]);*/
        return $response;
    }
}
