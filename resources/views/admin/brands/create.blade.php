@extends('admin.layout.index')
@section('content')

	<div class="panel panel-inverse" data-sortable-id="form-stuff-3">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">品牌</h4>
        </div>
        <div class="panel-body">
            <form action="/admin/brands" method="POST" enctype="multipart/form-data">
            	{{ csrf_field() }}
                <fieldset>
                    <legend>添加品牌</legend>
                    <div class="form-group">
                        <label for="bname">品牌名称</label>
                        <input type="text" name="bname" class="form-control" id="bname" placeholder="品牌名称">
                    </div>
                    <div class="form-group">
                        <label for="bimg">品牌图片</label>
                        <input name="bimg" type="file" id="bimg">
                    </div>
                    <div class="form-group">
                        <label for="intro">品牌地址</label>
                        <textarea name="intro" class="form-control" placeholder="在此输入内容..." rows="5"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-sm btn-primary m-r-5">提交</button>
                </fieldset>
            </form>
        </div>
    </div>

@endsection