<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHPSNS</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    <body>
    <?php

    try
    {

        $user_name = $_POST['name'];
        $user_mail = $_POST['mail'];
        $user_pass = $_POST['pass'];

        $user_name = htmlspecialchars($user_name,ENT_QUOTES,'UTF-8');
        $user_mail = htmlspecialchars($user_mail,ENT_QUOTES,'UTF-8');
        $user_pass = htmlspecialchars($user_pass,ENT_QUOTES,'UTF-8');

        $dsn = 'mysql:dbname=phpsns2021;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn,$user,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //この1行は静的プリペアードステートメントに関するものです。教科書通りではありません。
        //$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $sql = 'INSERT INTO mst_user(name,mailaddress,password) VALUES (?,?,?)';
        $stmt = $dbh->prepare($sql);
        $data[] = $user_name;
        $data[] = $user_mail;
        $data[] = $user_pass;
        $stmt->execute($data);
        $dbh = null;

        print $user_name;
        print 'さんを追加しました。<br />';

    }
    catch(Exception $e)
    {
        print 'ただいま障害によりご迷惑をおかけしています。';
        exit('接続エラー :' . $e->getMessage());

    }

    ?>

    <a href="index.php">戻る</a>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>