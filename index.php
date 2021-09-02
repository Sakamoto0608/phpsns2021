<?php
session_start();
require "function.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHPSNS</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    <body>
        <header>
            <?php headerGenerate(); ?>
        </header>
        <main>
            <div class="container-fluid">
                <div class="row">
                    <!--投稿などを表示するメイン画面-->
                    <div class="col-10">
                        <p>みんなの投稿</p>
                        <?php
                        $page = 1;
                        if(isset($_GET['page'])) $page = $_GET['page'];
                        $min = ($page - 1)*10;
                        $max = $page * 10;
                        try{
                            $dsn = 'mysql:dbname=phpsns2021;host=localhost;charset=utf8';
                            $user = 'root';
                            $password = '';
                            $dbh = new PDO($dsn,$user,$password);
                            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                            $sql='SELECT * FROM post 
                            JOIN mst_user ON post.userID = mst_user.userID
                            LEFT JOIN image ON post.imageID = image.imageID
                            ORDER BY postID desc LIMIT '.$min.','.$max;
                            $stmt = $dbh->prepare($sql);
                            $stmt->execute();
                            $dbh = null;
                            foreach ($stmt as $rec){
                                print'<div class="card">';
                                //画像の処理
                                if(isset($rec['path'])){
                                    print'<img class="card-img-top" src="'.$rec['path'].'">';
                                }
                                print'<div class="card-body">';
                                print'<h4 class="card-title"><a href="profile.php?userID='.$rec['userID'].'">'.$rec['nickname'].'</a></h4>';
                                print'<p class="card-text">'.$rec['text'].'</p>';
                                print'<p class="card-text">投稿日時'.$rec['date'].'</p>';
                                print'</div>';
                                print'</div>';
                            }
                            if(empty($rec)){
                                print'投稿がありません。';
                            }
                        }catch(Exception $e){
                            print 'ただいま障害によりご迷惑をおかけしています。';
                            exit('接続エラー :' . $e->getMessage());
                        }
                        pageGenerate("index.php",$page,"");
                        ?>
                    </div>
                    <!--サイドバー-->
                    <div class="col-2">
                        <p class="h4">アカウント管理</p>
                        <?php
                        if(isset($_SESSION['login'])){
                            print'<div class="list-group">
                            <a href="profile.php?userID='.$_SESSION['userID'].'" class="list-group-item list-group-item-action">自分のプロフィール</a>
                            <a href="user_signout_check.php" class="list-group-item list-group-item-action">サインアウト</a>';
                        }else{
                            print'<div class="list-group">
                            <a href="user_add.php" class="list-group-item list-group-item-action">サインアップ</a>
                            <a href="user_login.php" class="list-group-item list-group-item-action">サインイン</a>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" 
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" 
        crossorigin="anonymous"></script>
    </body>
</html>