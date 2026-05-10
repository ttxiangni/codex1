<?php
namespace app\model;

use think\Model;

class Message extends Model
{
    protected $table = 'ff_message';
    protected $pk = 'message_id';

    protected $schema = [
        'message_id' => 'int',
        'message_sender_id' => 'int',
        'message_receiver_id' => 'int',
        'message_title' => 'string',
        'message_content' => 'string',
        'message_type' => 'string',
        'message_is_read' => 'int',
        'message_create_time' => 'datetime',
        'message_update_time' => 'datetime',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'message_sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'message_receiver_id');
    }
}
