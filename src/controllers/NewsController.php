<?php

class NewsController
{
    public function actionIndex()
    {
        $newsList = array();
        $newsList = News::getNewsList();
        require_once (ROOT.'/views/news/index.php');
        return true;
    }

    public function actionView($id)
    {
        $newsItem = News::getNewsItemById($id);
        print_r($newsItem);
        return true;
    }
}