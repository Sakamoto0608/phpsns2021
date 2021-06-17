<?php session_start(); 
    if(!isset($_SESSION['login'])){
        print 'お手数をおかけしますがもう一度投稿しなおしてください。<br/>';
        print '<a href="index.php">戻る</a>';
        exit();
    }
    try
    {
        //画像関連が未完成
        $posttext = $_POST['posttext'];
        //$imagepass = $_POST['imagepass'];
        if(mb_strlen($posttext) == 0 || mb_strlen($posttext) >= 255){
            print'文字数が255を超えているか0です。<br/>';
            print 'お手数をおかけしますが、もう一度投稿しなおしてください。<br/>';
            print '<a href="index.php">戻る</a>';
            exit();
        }
        $dsn = 'mysql:dbname=phpsns2021;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn,$user,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //この1行は静的プリペアードステートメントに関するものです。教科書通りではありません。
        //$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $sql = 'INSERT INTO post(userID,text,image) VALUES (?,?,?)';
        $stmt = $dbh->prepare($sql);
        $data[] = $_SESSION['userID'];
        $data[] = $posttext;
        $data[] = "";
        $stmt->execute($data);
        $dbh = null;

        header('Location:index.php');

    }
    catch(Exception $e)
    {
        print 'ただいま障害によりご迷惑をおかけしています。';
        exit('接続エラー :' . $e->getMessage());

    }
?>