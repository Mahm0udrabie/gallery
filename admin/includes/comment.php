<?php 
// User extends Db_object {
class Comment  extends Db_object {
    protected static $db_table = "comments";
    protected static $db_table_fields= array('photo_id','author','body','email','date');
    public $id;
    public $photo_id;
    public $author;
    public $body;
    public $email;
    public $date;

    public static function create_comment($photo_id,$author,$body,$email,$date) {
        if(!empty($photo_id) && !empty($author) && !empty($body) && !empty($email) && !empty($date)) {
            $comment = new Comment();
            $comment->photo_id = (int)$photo_id;
            $comment->author   = $author;
            $comment->body     = $body;
            $comment->email    = $email;
            $comment->date     = $date;
            return $comment;
        } else {
            return false;
        }
        
    }

    public static function find_the_comments($photo_id=0) {
        global $database;
        $sql  = "SELECT * FROM ". self::$db_table;
        $sql .= " WHERE photo_id = " . $database->escape_string($photo_id);
        $sql .= " ORDER BY photo_id ASC";
        return self::find_by_query($sql);
    }


    
} // End comment Class

?>