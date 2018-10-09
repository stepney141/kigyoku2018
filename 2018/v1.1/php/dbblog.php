<?php

include_once "Gyokudown.php";
include_once 'dbmap.php';

class BlogMapper extends DataMapper
{
    public function __construct($dbconn)
    {
        parent::__construct($dbconn);
    }

    public function acquirePostsAll($limit = null, $count = null)
    {
        if ($limit === null)
        {
            $sth = $this->dbconn->query("SELECT * FROM blog ORDER BY time DESC");
        }
        else
        {
            if (!(is_int($limit) && $limit > 0)) {
                throw new RuntimeException();
            }
        
            if ($count !== null) {
                if (!(is_int($count) && $count > 0)) {
                    throw new RuntimeException();
                }
            
                $lim = "$limit, $count";
            } else {
                $lim = $limit;
            }

            $sth = $this->dbconn->query("SELECT * FROM blog ORDER BY time DESC LIMIT $lim;");
        }
        
        while (($row = $sth->fetch()) !== false)
        {
            $row["time"] = new DateTime($row["time"]);
            yield $row;
        }
    }

    public function submitPost($post)
    {
        if (!is_array($post)) throw new RuntimeException();

        $time = new DateTime();
        $caption = $post["caption"];
        $markdown = $post["markdown"];
        $author = $post["author"];

        if (!(is_string($caption)
           && is_string($markdown)
           && is_string($author)))
        {
            throw new RuntimeException();
        }

        $html = (new Gyokudown())->setSafeMode(true)->text($markdown);

        $sth = $this->dbconn->prepare("
            INSERT INTO blog (time, caption, markdown, html, author)
                        VALUES (:time, :caption, :markdown, :html, :author)
                        ");
        
        $sth->execute([
           ':time' => $time->format("Y-m-d H:i:s"),
           ':caption' => $caption,
           ':markdown' => $markdown,
           ':html' => $html,
           ':author' => $author
        ]);
    }

    public function acquirePostById($id)
    {
        $sth = $this->dbconn->prepare("SELECT * FROM blog WHERE id = :id");
        $sth->execute([ ':id' => $id ]);
        return $sth->fetch();
    }
}