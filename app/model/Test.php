<?php

namespace app\model;

use think\Model;

class Test extends Model
{
    protected $connection = 'data';
    protected $pk = 'id';
    protected $table = 'table';
}