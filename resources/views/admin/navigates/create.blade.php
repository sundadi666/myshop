@extends('admin.layout.index')
@section('content')

	@if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
	<div class="panel panel-inverse" data-sortable-id="form-stuff-3">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">导航栏</h4>
        </div>
        <div class="panel-body">
            <form action="/admin/navicates" method="POST">
            	{{ csrf_field() }}
                <fieldset>
                    <legend>添加导航栏</legend>
                    <div class="form-group">
                        <label for="title">导航栏名称</label>
                        <input type="title" name="title" class="form-control" id="title" placeholder="友情链接名称">
                    </div>
                    <div class="form-group">
                        <label for="url">导航栏地址</label>
                        <input type="text" name="url" class="form-control" id="url" placeholder="友情链接地址">
                    </div>
                    
                    <button type="submit" class="btn btn-sm btn-primary m-r-5">提交</button>
                </fieldset>
            </form>
        </div>
    </div>

@endsection