<div class="panel panel-default">
    <div class="panel-heading">
        <a href=""><?= $reply->creator->name ?></a> said <?= $reply->created_at->diffForHumans() ?>&hellip;
    </div>
    <div class="panel-body"><?= $reply->body ?></div>
</div>