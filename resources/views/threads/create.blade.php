@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a New Thread</div>

                    <div class="panel-body">
                        <form method="post" action="/threads">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" class="form-control" name="title" />
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea type="text" id="body" class="form-control" name="body"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
