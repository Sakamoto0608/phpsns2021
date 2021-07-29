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
        <main>
            <?php
            if(!isset($_SESSION['userID'])){
                print'ログインをしてください。<br/><a href="user_login.php">ログインページ</a>';
                return;
            }else $userID = $_SESSION['userID'];
            if(!isset($_GET['followuserID'])){
                print'不正なリクエストです。<br/><a href="javascript:history.back()">戻る</a>';
                return;
            }else $followuserID = $_GET['followuserID'];
            try{
                $dsn = 'mysql:dbname=phpsns2021;host=localhost;charset=utf8';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dsn,$user,$password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql='SELECT COUNT(*) FROM follow WHERE userID =? AND followuserID =? AND isdelete IS NULL';
                $stmt = $dbh->prepare($sql);
                $data[] = $userID;
                $data[] = $followuserID;
                $stmt->execute($data);
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if($rec['COUNT(*)'] == 1){
                    print'そのユーザーはフォロー済みです。<br/><a href="javascript:history.back()">戻る</a>';
                    return;
                }
                $sql = 'INSERT INTO follow(userID,followuserID) VALUES (?,?)';
                $stmt = $dbh->prepare($sql);
                //配列リセット
                $data = array();
                $data[] = $userID;
                $data[] = $followuserID;
                $stmt->execute($data);
                $dbh = null;
            }catch(Exception $e){
                //参照制約違反の場合の処理を書く
                
                print 'ただいま障害によりご迷惑をおかけしています。';
                exit('接続エラー :' . $e->getMessage());
            }
            ?>


        </main>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>