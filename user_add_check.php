<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHPSNS</title>
    </head>
    <body>
        
        <?php

        $user_name=$_POST['name'];
        $user_mail=$_POST['mail'];
        $user_pass=$_POST['pass'];
        $user_pass2=$_POST['pass2'];

        $user_name= htmlspecialchars($user_name,ENT_QUOTES,'UTF-8');
        $user_mail= htmlspecialchars($user_mail,ENT_QUOTES,'UTF-8');
        $user_pass= htmlspecialchars($user_pass,ENT_QUOTES,'UTF-8');
        $user_pass2= htmlspecialchars($user_pass2,ENT_QUOTES,'UTF-8');

        $check = false;
        if($user_name==''){
            print'ユーザー名が入力されていません。<br/>';
            $check = true;
        }else{
            print'ユーザー名：';
            print $user_name;
            print'<br/>';
        }
        if($user_mail==''){
            print'メールアドレスが入力されていません<br/>';
            $check = true;
        }else{
            print'メールアドレス：';
            print $user_mail;
            print'<br/>';
        }
        if($user_pass==''){
            print'パスワードが入力されていません。<br/>';
            $check = true;
        }
        if($user_pass!=$user_pass2){
            print'パスワードが一致しません。<br/>';
            $check = true;
        }
        if($check){
            print'<form>';
            print'<input type="button" onclick="history.back()" value="戻る">';
            print'<form>';
        }else{
            print'入力した内容に間違いはございませんか？';
            $user_pass=md5($user_pass);
            print'<form method="post" action="user_add_done.php">';
            print'<input type="hidden" name="name" value="'.$user_name.'">';
            print'<input type="hidden" name="mail" value="'.$user_mail.'">';
            print'<input type="hidden" name="pass" value="'.$user_pass.'">';
            print'<br/>';
            print'<input type="button" onclick="history.back()" value="戻る">';
            print'<input type="submit" value="OK">';
            print'</form>';
        }

?>
    </body>
</html>