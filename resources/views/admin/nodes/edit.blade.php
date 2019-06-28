@extends('admin.layout.index')

@section('content')
 
<div class="col-md-6 ui-sortable">
    <!-- begin panel -->
    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">角色添加</h4>
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
            <form class="form-horizontal" action="/admin/nodes/{{$node->id}}" method="post">
            	{{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label class="col-md-3 control-label">权限名称</label>
                    <div class="col-md-9">
                        <input type="text" name="desc" value="{{$node->desc}}" class="form-control" placeholder="权限名称">
                    </div>
                </div>
               
                <div class="form-group">
                    <label class="col-md-3 control-label">控制器名称</label>
                    <div class="col-md-9">
                        <input type="text" name="cname" value="{{$node->cname}}" class="form-control" placeholder="控制器名称">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">方法名称</label>
                    <div class="col-md-9">
                        <input type="text" name="aname" value="{{$node->aname}}" class="form-control" placeholder="方法名称">
                    </div>
                </div>      
                <div class="form-group">
                    <label class="col-md-3 control-label">确定添加</label>
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