@extends('admin.layout.index')

@section('content')
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Default Style</h4>
            </div>
            <div class="panel-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/admin/news" method="POST">
                	{{ csrf_field() }}
                    <fieldset>
                        <legend>公告管理</legend>
                        <div class="form-group">
                            <label for="exampleInputEmail1">公告标题</label>
                            <input name="title" type="text" class="form-control" id="exampleInputEmail1" placeholder="标题" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">内容</label>
                            <textarea name="content" class="form-control" placeholder="在此输入内容..." rows="5">{{ old('content') }}</textarea>
                        </div>
                        <input type="submit" class="btn btn-sm btn-primary m-r-5" value="提交"></input>
                    </fieldset>
                </form>
            </div>
        </div>
        <!-- end panel -->
@endsection