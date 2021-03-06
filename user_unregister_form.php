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
            <?php require "function.php";headerGenerate(); ?>
        </header>
        <main>
            <?php
            if(!isset($_SESSION['login'])){
                print'ログインされていません。';
                print'<br/><a href="user_login.php">ログインページへ</a>';
                exit();
            }
            ?>
            重要な操作のため、パスワードの入力をお願いします。<br>
            良ければ退会理由もお聞かせください<br>
            <form method="post" action="user_unregister_check.php">
                パスワード<br>
                <input type="text" name="pass"><br>
                退会理由<br>
                <textarea name="reason" rows="4" cols="40"></textarea><br/>
                <input type="submit" value="OK">
                <input type="button" onclick="history.back()" value="戻る">
            </form>
        </main>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>