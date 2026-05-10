<?php
namespace app\model;

use think\Model;

class User extends Model
{
    protected $table = 'ff_user';
    protected $pk = 'user_id';

    protected $schema = [
        'user_id' => 'int',
        'user_username' => 'string',
        'user_password' => 'string',
        'user_email' => 'string',
        'user_avatar' => 'string',
        'user_nickname' => 'string',
        'user_gender' => 'string',
        'user_birthday' => 'date',
        'user_signature' => 'string',
        'user_level' => 'int',
        'user_points' => 'int',
        'user_status' => 'int',
        'user_last_login_time' => 'datetime',
        'user_last_login_ip' => 'string',
        'user_create_time' => 'datetime',
        'user_update_time' => 'datetime',
    ];
}
