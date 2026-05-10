<?php

namespace app\service;

use XS;
use XSDocument;

class SearchService
{
    protected $xs;

    public function __construct()
    {
        $this->xs = new XS('vod');
    }

    public function addVideo($video)
    {
        $doc = new XSDocument();
        $doc->setFields([
            'id' => $video['vod_id'],
            'title' => $video['vod_name'],
            'content' => $video['vod_content'],
            'category_id' => $video['type_id'],
        ]);

        $index = $this->xs->index;
        $index->add($doc);
    }

    public function updateVideo($video)
    {
        $this->addVideo($video);
    }

    public function deleteVideo($id)
    {
        $index = $this->xs->index;
        $index->del($id);
    }

    public function search($keyword, $page = 1, $limit = 20)
    {
        $search = $this->xs->search;
        $search->setQuery($keyword);
        $search->setLimit($limit, ($page - 1) * $limit);

        $docs = $search->search();
        $count = $search->count();

        $results = [];
        foreach ($docs as $doc) {
            $results[] = $doc->toArray();
        }

        return [
            'data' => $results,
            'total' => $count,
            'page' => $page,
            'limit' => $limit
        ];
    }
}
