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
            <h4 class="panel-title">用户添加</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="/admin/adminuser/{{$admin_user->id}}" method="post" enctype="multipart/form-data">

            	{{ csrf_field() }}
                 {{ method_field('PUT') }}
                <div class="form-group">
                    <label class="col-md-3 control-label">用户名</label>
                    <div class="col-md-9">
                        <input type="text" name="uname" class="form-control" placeholder="用户名" value="{{ $admin_user->uname }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 control-label">手机号码</label>
                    <div class="col-md-9">
                        <input type="text" name="phone" class="form-control" placeholder="手机号码" value="{{ $admin_user->phone }}">
                    </div>
                </div>
                 
                 <div class="form-group">
                    <label class="col-md-3 control-label">头像</label>
                    <div class="col-md-9">
                          <img style="width:60px;" src="/uploads/{{$admin_user->profile}}">
                        <input type="file" name="profile" class="form-control" placeholder="头像">
                         <input type="hidden" name="profile_path" value="{{$admin_user->profile}}">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-md-3 control-label">性别</label>
                    <div class="col-md-9">
                       <input type="radio" name="sex" value="m" {{ $admin_user->sex=='m' ? 'checked' : '' }}>女
                       <input type="radio" name="sex" value="w" {{ $admin_user->sex=='w' ? 'checked' : '' }}>男
                       <input type="radio" name="sex" value="x" {{ $admin_user->sex=='x' ? 'checked' : '' }}>保密
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-md-3 control-label">角色</label>
                    <div class="col-md-9">
                    	<!-- 遍历角色 判断角色名 相同 就默认选中 -->
                       @foreach($roles_data as $k=>$v)
                         <input type="radio" name="rid" value="{{$v->id}}" {{$v->rname == '普通管理员' ? 'checked' : ''}} >{{$v->rname}}
                       @endforeach
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