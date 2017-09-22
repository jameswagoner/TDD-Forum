@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#"><?= $thread->creator->name ?></a> posted: <?= $thread->title ?>
                    </div>
                    <div class="panel-body"><?= $thread->body ?></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            @foreach ($thread->replies as $reply)
                @include('threads.reply')
            @endforeach
            </div>
        </div>
        @if (auth()->check())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form method="post" action="<?= $thread->path() ?>/replies">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <textarea name="body" class="form-control" placeholder="Got something to say?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
