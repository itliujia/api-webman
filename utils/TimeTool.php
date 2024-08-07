<?php

namespace utils;

use DateTimeImmutable;

/** 默认时间格式化模板 */
const DEFAULT_TIME_FORMAT = [
    'day' => 'Y-m-d',
    'time' => 'Y-m-d H:i:s'
];


/**
 * 时间工具类
 *
 * @author LiuJia
 * @createTime 2024-04-23 16:20:33
 */
class TimeTool
{
    /**
     * 获取标准时间戳
     *
     * @param int|string $timestamp 时间戳
     * @author LiuJia
     * @createTime 2024-08-01 15:05:30
     */
    private static function getTimestamp(int|string $timestamp): int
    {
        return strlen((string)$timestamp) == 13 ? (int)($timestamp / 1000) : (int)$timestamp;
    }

    /**
     * 时间戳格式化为时间字符串
     *
     * @param int $timestamp 时间戳
     * @param string $format 格式方法
     * @author LiuJia
     * @createTime 2024-07-25 12:02:04
     */
    public static function timestampToString(int $timestamp = 0, string $format = "Y-m-d H:i:s"): string
    {
        if ($timestamp === 0) {
            $timestamp = time();
        }

        $timestamp = self::getTimestamp($timestamp);
        return date($format, $timestamp);
    }

    /**
     * 获取当前时间
     *
     * @param string $format 格式化方法，可用`day`、`time`、`ms`
     * @author LiuJia
     * @createTime 2024-04-23 15:04:24
     */
    public static function currentTime(string $format = 'time'): string
    {
        $dateTime = new DateTimeImmutable();

        if ($format === 'ms') {
            $microseconds = $dateTime->format('Y-m-d H:i:s.u');
            return substr($microseconds, 0, -6) . substr($microseconds, -3, 3);
        }

        $formatStr = DEFAULT_TIME_FORMAT[$format] ?? $format;
        return $dateTime->format($formatStr);
    }
}
