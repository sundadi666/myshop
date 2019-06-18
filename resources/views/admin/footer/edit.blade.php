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


<div class="col-md-6 ui-sortable">
    <!-- begin panel -->
    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title="" data-init="true"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title="" data-init="true"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">网站底部添加</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="/admin/footer/{{$data->id}}" method="post" style="display: inline-block;">
            	{{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label class="col-md-3 control-label">版权</label>
                    <div class="col-md-9">
                        <input type="text" name="copy" class="form-control" value="{{$data->copy}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">备案号</label>
                    <div class="col-md-9">
                        <input type="text" name="filing" class="form-control" value="{{$data->filing}}">
                    </div>
                </div>
         		
                 <div class="form-group">
                    <label class="col-md-3 control-label">公司名称</label>
                    <div class="col-md-9">
                        <input type="text" name="company" class="form-control" value="{{$data->company}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">提交</label>
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-sm btn-success">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end panel -->
</div>
@endsection