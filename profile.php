<?php
session_start();
require "function.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHPSNS</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    <body>
        <header>
        <?php headerGenerate(); ?>
        </header>
        <?php
        //ユーザー情報
        try{
            $dsn = 'mysql:dbname=phpsns2021;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql='SELECT * FROM mst_user WHERE userID =? AND flag = false';
            $stmt = $dbh->prepare($sql);
            $userID = $_GET['userID'];
            $data[] = $userID;
            $stmt->execute($data);
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if(empty($rec)){
                print'そのユーザーは存在しないか退会した可能性があります。<br/><a href="index.php">戻る</a>';
                return;
            }
        }catch(Exception $e){
            print 'ただいま障害によりご迷惑をおかけしています。';
            exit('接続エラー :' . $e->getMessage());
        }
        print'ユーザー名：'.$rec['name'].'<br/>';
        print'ニックネーム：'.$rec['nickname'].'<br/>';
        print'自己紹介文：'.$rec['profile'].'<br/>';
        $isLogin = false;
        $isMyself = false;
        if(isset($_SESSION['userID'])){
            $isLogin = true;
            if($_SESSION['userID'] == $userID){
                print'<a href="profile_edit.php?userID='.$userID.'">編集する</a><br/><br/>';
                $isMyself = true;
            }
        }
        $rec = null;
        $data = null;
        //フォローボタン表示
        if($isLogin&&(!$isMyself)){
            try{
                $sql='SELECT COUNT(*) FROM follow WHERE userID =? AND followuserID =? AND isdelete IS NULL';
                $stmt = $dbh->prepare($sql);
                $followuserID = $userID;
                $data[] = $_SESSION['userID'];
                $data[] = $followuserID;
                $stmt->execute($data);
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if(!($rec['COUNT(*)'] == 1)){
                    print'<a href="follow.php?followuserID='.$followuserID.'">フォローする</a>';
                }else{
                    print'このユーザーはフォロー済みです。';
                }
            }catch(Exception $e){
                print 'ただいま障害によりご迷惑をおかけしています。';
                exit('接続エラー :' . $e->getMessage());
            }
        }
        $rec = null;
        $data = null;
        //投稿表示
        $page = 1;
        if(isset($_GET['page'])) $page = $_GET['page'];
        $min = ($page - 1)*10;
        $max = $page * 10;
        print'<p class="h2">このユーザーの投稿</p>';
        try{
            $sql='SELECT * FROM post 
            JOIN mst_user ON post.userID = mst_user.userID 
            LEFT JOIN image ON post.imageID = image.imageID
            WHERE mst_user.userID = ? AND mst_user.flag = false AND post.deleteDay IS NULL ORDER BY postID desc LIMIT '.$min.','.$max;
            $stmt = $dbh->prepare($sql);
            $data[] = $userID;
            $stmt->execute($data);
            $dbh = null;
        }catch(Exception $e){
            print 'ただいま障害によりご迷惑をおかけしています。';
            exit('接続エラー :' . $e->getMessage());
        }
        foreach ($stmt as $rec){
            print'<div class="card">';
            //画像の処理
            if(isset($rec['path'])){
                print'<img class="card-img-top" src="'.$rec['path'].'">';
            }
            print'<div class="card-body">';
            print'<h4 class="card-title">'.$rec['nickname'].'</h4>';
            print'<p class="card-text">'.$rec['text'].'</p>';
            print'<p class="card-text">投稿日時'.$rec['date'].'</p>';
            print'</div>';
            print'</div>';
        }
        if(empty($rec)){
            print'投稿がありません。';
        }
        pageGenerate("profile.php",$page,"userID=".$userID);
        ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>