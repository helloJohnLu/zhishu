@extends('layouts.main')

@section('content')
    <div class="col-sm-8 blog-main">
        <form class="form-horizontal" action="{{ route('user.settingStore') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                    <input class="form-control" name="name" type="text" value="{{ Auth::user()->name }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">头像</label>
                <div class="col-sm-2">
                    <input class="file-loading preview_input" type="file" value=""  name="avatar" style="margin-top: 5px;">
                    <img  class="preview_img" src="{{ Auth::user()->avatar }}" alt="" class="img-rounded" style="width: 200px; height:200px;border-radius: 100%; margin-top: 20px;">
                </div>
            </div>
            @include('messages.errors')
            <button type="submit" class="btn btn-default" style="margin-left: 20px;">修改</button>
        </form>
        <br>

    </div>
@stop