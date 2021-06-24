<?php
session_start();
if(isset($_SESSION['login'])) print 'ログインされています';
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
            <a href="tweet.php">投稿する</a><br />
        </header>
        <main>
            <div class="container-fluid">
                <div class="row">
                    <!--投稿などを表示するメイン画面-->
                    <div class="col-10">
                        <p>みんなの投稿</p>
                        <?php
                        try{
                            $dsn = 'mysql:dbname=phpsns2021;host=localhost;charset=utf8';
                            $user = 'root';
                            $password = '';
                            $dbh = new PDO($dsn,$user,$password);
                            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                            $sql='SELECT * FROM post JOIN mst_user ON post.userID = mst_user.userID';
                            $stmt = $dbh->prepare($sql);
                            $stmt->execute();
                            $dbh = null;
                            foreach ($stmt as $rec){
                                print'<div class="card">';
                                print'<h4 class="card-title"><a href="profile.php?userID='.$rec['userID'].'">'.$rec['nickname'].'</a></h4>';
                                print'<p class="card-text">'.$rec['text'].'</p>';
                                print'</div>';
                            }
                        }catch(Exception $e){
                            print 'ただいま障害によりご迷惑をおかけしています。';
                            exit('接続エラー :' . $e->getMessage());
                        }
                        ?>
                    </div>
                    <!--サイドバー-->
                    <div class="col-2">
                        <?php
                        if(isset($_SESSION['login'])){
                            print'<a href="profile.php?userID='.$_SESSION['userID'].'">自分のプロフィール</a><br />';
                        }else{
                            print'<a href="user_add.php">サインアップ</a><br />
                            <a href="user_login.php">サインイン</a>';
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