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
?>