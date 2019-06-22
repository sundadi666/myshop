@extends('admin.layout.index')

@section('content')
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="width: 1095px;">
    <div class="panel-heading">
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
        <h4 class="panel-title">商品管理</h4>
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
        <form class="form-horizontal" action="/admin/goods" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-md-3 control-label">商品名称</label>
                <div class="col-md-9">
                    <input name="title" type="text" class="form-control" placeholder="商品名称" value="{{ old('title') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">商品描述</label>
                <div class="col-md-9">
                    <input name="desc" type="text" class="form-control" placeholder="商品描述" value="{{ old('desc') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">商品推荐信息(上)</label>
                <div class="col-md-9">
                    <input name="goods_info_top" type="text" class="form-control" value="{{ old('goods_info_top') }}" placeholder="不能超过10个字符">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">商品推荐信息(下)</label>
                <div class="col-md-9">
                    <input name="goods_info_bottom" type="text" class="form-control" value="{{ old('goods_info_bottom') }}" placeholder="不能超过10个字符">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">商品属性</label>
                <div class="col-md-9">
                    <input name="attr_name" type="text" class="form-control" value="{{ old('attr_name') }}" placeholder="">
                </div>
                <label style="color:red;position: relative;left: 290px;" for="exampleInputEmail1">注意：商品属性必须以英文" , "逗号隔开 , 不能含有任何特殊字符</label><br>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">商品分类</label>
                <div class="col-md-9">
                    <select name="cid" class="form-control">
                        <option>请选择</option>
                        @foreach($cates_data as $k=>$v)
                        <option value="{{ $v->id }}">{{ $v->cname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">所属品牌</label>
                <div class="col-md-9">
                    <select name="bid" class="form-control">
                        <option>请选择</option>
                        @foreach($brands_data as $k=>$v)
                        <option value="{{ $v->id }}">{{ $v->bname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                    <label class="col-md-3 control-label">图片上传</label>
                    <input name="img[]" type="file" id="exampleInputFile" multiple>
                    <p class="help-block">在此上传图片</p>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">商品状态</label>
                <div class="col-md-9">
                    <label class="radio-inline">
                        <input type="radio" name="goods_status" value="0" checked="">
                        下架
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="goods_status" value="1">
                        上架
                    </label>
                </div>
            </div>
            <div class="form-group" style="width: 880px;margin-left: 150px;">
                <!-- <label class="col-md-3 control-label">文章内容</label> -->
                <!-- 加载编辑器的容器 -->
                <script id="container" name="content" type="text/plain">
                {!! old('content') !!}
                </script>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"></label>
                <div class="col-md-9">
                    <button type="submit" class="btn btn-sm btn-success">提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- 配置文件 -->
<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
</script>
@endsection