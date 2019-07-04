<?php
class Post
{
  public $id;
  public $title;
  public $content;

  function __construct($id, $title, $content)
  {
    $this->id = $id;
    $this->title = $title;
    $this->content = $content;
  }

  static function all()
  {
    $list = [];
    $db = new PDO('pgsql:host=localhost;port=5432;dbname=demo_mvc;user=postgres;password=123456');
    $req = $db->query('SELECT * FROM posts');

    foreach ($req->fetchAll() as $item) {
      $list[] = new Post($item['id'], $item['title'], $item['content']);
    }

    return $list;
  }
}