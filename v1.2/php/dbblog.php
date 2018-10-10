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
            if ($count !== null) {
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

    private function convertToHTML($markdown, $pathconv)
    {
        return (new Gyokudown($pathconv))
                    ->setSafeMode(true)
                    ->text($markdown);
    }
    
    public function submitPost($post, $imgprefix, $imgfilenames = [])
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

        $html = $this->convertToHTML($markdown, new ImagePathConverter($imgprefix, $imgfilenames));

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

    public function previewPost($markdown, $imgmap)
    {
        return $this->convertToHTML($markdown, new ImagePathConverter("", $imgmap));
    }

    public function acquirePostById($id)
    {
        $sth = $this->dbconn->prepare("SELECT * FROM blog WHERE id = :id");
        $sth->execute([ ':id' => $id ]);
        return $sth->fetch();
    }
}