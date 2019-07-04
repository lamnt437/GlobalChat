<?php
    // $list = [];
    // // $db = DB::getInstance();
    // // $db = new PDO("mysql:host=127.0.0.1;dbname=demo_mvc;charset=utf8", "debian-sys-maint", "CSit2Q5pa74S9Avx");
    // $user_name = 'lamnt';
    // $db = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");
    // $db->exec("SET NAMES 'utf8'");
    // // $req = $db->query("SELECT * FROM user_tb WHERE user_name = \"$user_name\"");
    // // var_dump($req);

    // /* select user */

    // $stmt = $pdo->("SELECT * FROM user_tb WHERE user_name=\'lamnt\'");
    // $stmt->execute()

    // // $result = $req->fetchAll();
    // // if(empty($result))
    // //     return false;
    // // return true;

    // $req = $db->query('SELECT * FROM user_tb');

    // foreach ($req->fetchAll() as $item) {
    // //   $list[] = new Post($item['id'], $item['title'], $item['content']);
    //     var_dump($item);
    // }

    $user_name = 'lamnt';
    $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=GlobalChatDB;user=postgres;password=123456");

    $sql = 'select * from user_tb where user_name = :user_name';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result !== false)
        echo 'true';
?>