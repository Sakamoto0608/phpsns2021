<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHPSNS</title>
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

    <a href="user_list.php">戻る</a>

    </body>
</html>