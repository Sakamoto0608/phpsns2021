<?php
function headerGenerate(){
$header = <<<EOD
<div class="container-fluid bg-dark">
<nav class="navbar navbar-expand-lg navbar-dark">
<a class="navbar-brand" href="index.php">ブランド名の予定</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#切り替え表示されるコンテンツ名" aria-controls="切り替え表示されるコンテンツ名" aria-expanded="false" aria-label="ナビゲーション切替">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="切り替え表示されるコンテンツ名">
<ul class="navbar-nav mr-auto">
<li class="nav-item active">
<a class="nav-link" href="tweet.php">投稿する</a>
</li>
<li class="nav-item active">
<a class="nav-link" href="#">何かのリンク</a>
</li>
<li class="nav-item active">
<a class="nav-link" href="#">何かのリンク</a>
</li>
</ul>
<form class="form-inline my-2 my-lg-0">
<input class="form-control mr-sm-2" type="search" placeholder="投稿検索" aria-label="検索">
<button class="btn btn-light my-2 my-sm-0" type="submit">検索</button>
</form>
</div>
</nav>
</div>
EOD;
print $header;
}
function pageGenerate($path,$page){
$prev = $page - 1;
$prevlink = '<li class="page-item"><a class="page-link" href="'.$path.'?page='.$prev.'">'.$prev.'</a></li>';
//1ページ目の場合1番目の数字と2番目の数字がともに１となってしまうので片方を削除する
if($prev <= 0){
  $prev = 1;
  $prevlink = "";
}
$next = $page + 1;
$pagination = <<<EOD
<nav aria-label="ページネーション">
<ul class="pagination justify-content-center">
<li class="page-item"><a class="page-link" href="$path?page=$prev">前</a></li>
$prevlink
<li class="page-item"><a class="page-link">$page</a></li>
<li class="page-item"><a class="page-link" href="$path?page=$next">$next</a></li>
<li class="page-item"><a class="page-link" href="$path?page=$next">次</a></li>
</ul>
</nav>
EOD;
print $pagination;
}
?>