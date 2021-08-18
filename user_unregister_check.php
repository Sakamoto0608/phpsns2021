<?php
session_start();
if(!isset($_SESSION['login'])){
    print'ログインされていません。';
    print'<br/><a href="user_login.php">ログインページへ</a>';
    exit();
}
try{
    $pass = md5($_POST['pass']);
    $userID = $_SESSION['userID'];

    $dsn = 'mysql:dbname=phpsns2021;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='SELECT password FROM mst_user WHERE userID=?';
    
    $stmt = $dbh->prepare($sql);
    $data[] = $userID;
    $stmt->execute($data);
    $data = null;

    print"success";
    var_dump($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec['password'] == $pass){
        $sql='UPDATE mst_user SET flag=true WHERE userID=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $userID;
        $stmt->execute($data);
        $dbh = null;
        exit();
    }else{
        print 'パスワードが間違っています。';
        print '<a href="user_unregister_form.php">戻る</a>';
    }
}catch(Exception $e){
    print 'ただいま障害によりご迷惑をおかけしています。';
    exit('接続エラー :' . $e->getMessage());
}
?>