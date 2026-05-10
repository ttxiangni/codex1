<?php

namespace app\controller;

use app\BaseController;
use app\model\Video;
use app\model\Category;
use app\model\Comment;
use app\model\Favorite;
use app\model\WatchHistory;
use app\model\Message;
use think\facade\Request;

class Api extends BaseController
{
    public function videos()
    {
        $category_id = Request::param('category_id');
        $page = Request::param('page', 1);
        $limit = Request::param('limit', 20);

        $query = Video::where('vod_status', 1);
        if ($category_id) {
            $query->where('type_id', $category_id);
        }

        $videos = $query->order('vod_create_time', 'desc')
            ->paginate($limit, false, ['page' => $page]);

        return json([
            'code' => 0,
            'data' => $videos->items(),
            'total' => $videos->total(),
            'page' => $videos->currentPage(),
            'limit' => $videos->listRows()
        ]);
    }

    public function video($id)
    {
        $video = Video::find($id);
        if (!$video) {
            return json(['code' => 1, 'msg' => '视频不存在']);
        }

        return json(['code' => 0, 'data' => $video]);
    }

    public function categories()
    {
        $categories = Category::where('type_status', 1)
            ->order('type_sort', 'asc')
            ->select();

        return json(['code' => 0, 'data' => $categories]);
    }

    public function comment()
    {
        if (!Request::isPost()) {
            return json(['code' => 1, 'msg' => '请求方式错误']);
        }

        $data = Request::post();
        $vodId = $data['vod_id'] ?? $data['video_id'] ?? null;
        $comment = new Comment();
        $comment->save([
            'comment_user_id' => $data['user_id'] ?? null,
            'comment_vod_id' => $vodId,
            'comment_article_id' => $data['article_id'] ?? null,
            'comment_content' => $data['content'] ?? '',
            'comment_parent_id' => $data['parent_id'] ?? 0,
            'comment_status' => 1,
        ]);

        return json(['code' => 0, 'msg' => '评论成功']);
    }

    public function search()
    {
        $keyword = Request::param('keyword');
        if (!$keyword) {
            return json(['code' => 1, 'msg' => '关键词不能为空']);
        }

        $searchService = new \app\service\SearchService();
        $result = $searchService->search($keyword);

        return json(['code' => 0, 'data' => $result['data'], 'total' => $result['total']]);
    }

    public function addComment()
    {
        if (!Request::isPost()) {
            return json(['code' => 1, 'msg' => '请求方式错误']);
        }

        $data = Request::post();
        $vodId = $data['vod_id'] ?? $data['video_id'] ?? null;
        $comment = new Comment();
        $comment->save([
            'comment_user_id' => $data['user_id'] ?? null,
            'comment_vod_id' => $vodId,
            'comment_article_id' => $data['article_id'] ?? null,
            'comment_content' => $data['content'] ?? '',
            'comment_parent_id' => $data['parent_id'] ?? 0,
            'comment_status' => 1,
        ]);

        if (isset($data['parent_id']) && $data['parent_id'] > 0) {
            $parentComment = Comment::find($data['parent_id']);
            if ($parentComment && $parentComment->comment_user_id != ($data['user_id'] ?? null)) {
                $message = new Message();
                $message->save([
                    'message_sender_id' => $data['user_id'] ?? 0,
                    'message_receiver_id' => $parentComment->comment_user_id,
                    'message_title' => '您的评论收到了回复',
                    'message_content' => '有人回复了您的评论："' . $parentComment->comment_content . '"',
                    'message_type' => 'comment',
                    'message_is_read' => 0,
                ]);
            }
        }

        return json(['code' => 0, 'msg' => '评论成功']);
    }

    public function getComments($videoId)
    {
        $page = Request::param('page', 1);
        $limit = Request::param('limit', 10);

        $comments = Comment::where('comment_vod_id', $videoId)
            ->where('comment_parent_id', 0)
            ->where('comment_status', 1)
            ->with(['user', 'replies.user'])
            ->order('comment_create_time', 'desc')
            ->paginate($limit, false, ['page' => $page]);

        return json([
            'code' => 0,
            'data' => $comments->items(),
            'total' => $comments->total(),
            'page' => $comments->currentPage(),
            'limit' => $comments->listRows()
        ]);
    }

    public function toggleFavorite()
    {
        if (!Request::isPost()) {
            return json(['code' => 1, 'msg' => '请求方式错误']);
        }

        $userId = Request::post('user_id');
        $videoId = Request::post('vod_id') ?? Request::post('video_id');

        if (!$userId || !$videoId) {
            return json(['code' => 1, 'msg' => '参数错误']);
        }

        $favorite = Favorite::where('favorite_user_id', $userId)
            ->where('favorite_vod_id', $videoId)
            ->find();

        if ($favorite) {
            $favorite->delete();
            return json(['code' => 0, 'msg' => '已取消收藏', 'action' => 'unfavorite']);
        } else {
            $favorite = new Favorite();
            $favorite->save([
                'favorite_user_id' => $userId,
                'favorite_vod_id' => $videoId,
            ]);
            return json(['code' => 0, 'msg' => '收藏成功', 'action' => 'favorite']);
        }
    }

    public function checkFavorite()
    {
        $userId = Request::param('user_id');
        $videoId = Request::param('vod_id') ?? Request::param('video_id');

        if (!$userId || !$videoId) {
            return json(['code' => 0, 'data' => false]);
        }

        $favorite = Favorite::where('favorite_user_id', $userId)
            ->where('favorite_vod_id', $videoId)
            ->find();

        return json(['code' => 0, 'data' => $favorite ? true : false]);
    }

    public function getFavorites($userId)
    {
        $page = Request::param('page', 1);
        $limit = Request::param('limit', 12);

        $favorites = Favorite::where('favorite_user_id', $userId)
            ->with(['video.category'])
            ->order('favorite_create_time', 'desc')
            ->paginate($limit, false, ['page' => $page]);

        return json([
            'code' => 0,
            'data' => $favorites->items(),
            'total' => $favorites->total(),
            'page' => $favorites->currentPage(),
            'limit' => $favorites->listRows()
        ]);
    }

    public function addWatchHistory()
    {
        if (!Request::isPost()) {
            return json(['code' => 1, 'msg' => '请求方式错误']);
        }

        $userId = Request::post('user_id');
        $videoId = Request::post('vod_id') ?? Request::post('video_id');

        if (!$userId || !$videoId) {
            return json(['code' => 1, 'msg' => '参数错误']);
        }

        $history = WatchHistory::where('watch_history_user_id', $userId)
            ->where('watch_history_vod_id', $videoId)
            ->find();

        if ($history) {
            $history->save(['watch_history_update_time' => date('Y-m-d H:i:s')]);
        } else {
            $history = new WatchHistory();
            $history->save([
                'watch_history_user_id' => $userId,
                'watch_history_vod_id' => $videoId,
                'watch_history_update_time' => date('Y-m-d H:i:s'),
            ]);
        }

        return json(['code' => 0, 'msg' => '观看记录已更新']);
    }

    public function getWatchHistory($userId)
    {
        $page = Request::param('page', 1);
        $limit = Request::param('limit', 12);

        $history = WatchHistory::where('watch_history_user_id', $userId)
            ->with(['video.category'])
            ->order('watch_history_update_time', 'desc')
            ->paginate($limit, false, ['page' => $page]);

        return json([
            'code' => 0,
            'data' => $history->items(),
            'total' => $history->total(),
            'page' => $history->currentPage(),
            'limit' => $history->listRows()
        ]);
    }

    public function getMessages($userId)
    {
        $page = Request::param('page', 1);
        $limit = Request::param('limit', 20);

        $messages = Message::where('message_receiver_id', $userId)
            ->with(['sender'])
            ->order('message_create_time', 'desc')
            ->paginate($limit, false, ['page' => $page]);

        return json([
            'code' => 0,
            'data' => $messages->items(),
            'total' => $messages->total(),
            'page' => $messages->currentPage(),
            'limit' => $messages->listRows()
        ]);
    }

    public function markMessageRead($messageId)
    {
        $message = Message::find($messageId);
        if (!$message) {
            return json(['code' => 1, 'msg' => '消息不存在']);
        }

        $message->save(['message_is_read' => 1]);
        return json(['code' => 0, 'msg' => '已标记为已读']);
    }

    public function getUnreadMessageCount($userId)
    {
        $count = Message::where('message_receiver_id', $userId)
            ->where('message_is_read', 0)
            ->count();

        return json(['code' => 0, 'data' => $count]);
    }

    public function setTheme()
    {
        if (!Request::isPost()) {
            return json(['code' => 1, 'msg' => '请求方式错误']);
        }

        $theme = Request::post('theme');
        if (!in_array($theme, ['light', 'dark'])) {
            return json(['code' => 1, 'msg' => '主题参数错误']);
        }

        \app\service\ThemeService::setTheme($theme);
        return json(['code' => 0, 'msg' => '主题已切换']);
    }
}
