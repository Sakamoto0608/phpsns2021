<?php
try{
    $mail = $_POST['mail'];
    $pass = md5($_POST['pass']);

    $dsn = 'mysql:dbname=phpsns2021;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='SELECT * FROM mst_user WHERE mailaddress=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $mail;
    $stmt->execute($data);

    $dbh = null;
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec['password'] == $pass){
        session_start();
        $_SESSION['login'] = 1;
        $_SESSION['userID'] = $rec['userID'];
        $_SESSION['nickname'] = $rec['nickname'];
        $_SESSION['name'] = $rec['name'];
        header('Location:index.php');
        exit();
    }else{
        print 'メールアドレス、もしくはパスワードが間違っています。';
        print '<a href="index.php">戻る</a>';
    }
}catch(Exception $e){
        print 'ただいま障害によりご迷惑をおかけしています。';
        exit('接続エラー :' . $e->getMessage());
}
?>