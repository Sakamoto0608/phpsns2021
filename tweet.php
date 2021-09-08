<?php session_start(); ?>
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
            <?php
            require "function.php";headerGenerate();
            if(!isset($_SESSION['login'])){
                print'ログインされていません。';
                print'<br/><a href="user_login.php">ログインページへ</a>';
                exit();
            }
            ?>
        </header>
        <main>
            <p class="h1">投稿</p>
            <br>
            <form method="post" action="tweet_check.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="posttext">投稿内容</label>
                    <textarea name="posttext" class="form-control" rows="4" cols="40"></textarea><br>
                </div>
                <div class="form-group">
                    <label for="image">貼付画像</label>
                    <input type="file" class="form-control-file" name="image" accept="image/*"><br>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <input type="button" class="form-control" onclick="history.back()" value="戻る">
                    </div>
                    <div class="form-group col-6">
                        <input type="submit" class="form-control" value="投稿">
                    </div>
                </div>

            </form>
        </main>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>