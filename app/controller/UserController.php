<?php

namespace app\controller;

use app\BaseController;
use app\model\Favorite;
use app\model\WatchHistory;
use app\model\Message;
use think\facade\View;
use think\facade\Request;

class UserController extends BaseController
{
    public function index()
    {
        $userId = 1;

        $favoriteCount = Favorite::where('favorite_user_id', $userId)->count();
        $historyCount = WatchHistory::where('watch_history_user_id', $userId)->count();
        $unreadMessageCount = Message::where('message_receiver_id', $userId)
            ->where('message_is_read', 0)
            ->count();

        View::assign('favoriteCount', $favoriteCount);
        View::assign('historyCount', $historyCount);
        View::assign('unreadMessageCount', $unreadMessageCount);
        return View::fetch();
    }

    public function favorites()
    {
        $userId = 1;
        $page = Request::param('page', 1);

        $favorites = Favorite::where('favorite_user_id', $userId)
            ->with(['video.category'])
            ->order('favorite_create_time', 'desc')
            ->paginate(12, false, ['page' => $page]);

        View::assign('favorites', $favorites);
        return View::fetch();
    }

    public function history()
    {
        $userId = 1;
        $page = Request::param('page', 1);

        $history = WatchHistory::where('watch_history_user_id', $userId)
            ->with(['video.category'])
            ->order('watch_history_update_time', 'desc')
            ->paginate(12, false, ['page' => $page]);

        View::assign('history', $history);
        return View::fetch();
    }

    public function messages()
    {
        $userId = 1;
        $page = Request::param('page', 1);

        $messages = Message::where('message_receiver_id', $userId)
            ->with(['sender'])
            ->order('message_create_time', 'desc')
            ->paginate(20, false, ['page' => $page]);

        View::assign('messages', $messages);
        return View::fetch();
    }
}
