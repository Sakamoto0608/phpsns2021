<?php
try{
    $nickname = $_POST['nickname'];
    $profile = $_POST['profile'];
    $userID = $_POST['userID'];

    $dsn = 'mysql:dbname=phpsns2021;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='UPDATE mst_user SET nickname=?,profile=? WHERE userID=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $nickname;
    $data[] = $profile;
    $data[] = $userID;

    $stmt->execute($data);
    $dbh = null;
    header('Location:index.php');
}catch(Exception $e){
    print 'ただいま障害によりご迷惑をおかけしています。';
    exit('接続エラー :' . $e->getMessage());
}
?>