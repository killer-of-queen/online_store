<?php
    class News
    {
        public static function getNewsItemById($id)
        {
            $db = Db::getConnection();

            $result = $db->query('SELECT id, title, date, short_content FROM news WHERE id='.$id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $newsItem = $result->fetch();
            return $newsItem;
        }

        public static function getNewsList()
        {
            $db = Db::getConnection();

            $newsList = array();
            $result = $db->query('SELECT id, title, date, short_content FROM news');
            $i = 0;
            while($row = $result->fetch()) {
                $newsList[$i]['id'] = $row['id'];
                $newsList[$i]['title'] = $row['title'];
                $newsList[$i]['date'] = $row['date'];
                $newsList[$i]['short_content'] = $row['short_content'];
                $i++;
            }

            return $newsList;
        }
    }