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
            <h4 class="panel-title">分类</h4>
        </div>
        <div class="panel-body">
            <form action="/admin/cates" method="POST">
            	{{ csrf_field() }}
                <fieldset>
                    <legend>分类添加</legend>
                    <div class="form-group">
                        <label for="cname">分类名称</label>
                        <input type="title" name="cname" class="form-control" id="cname" placeholder="分类名称">
                    </div>
                    <div class="form-group">
                        <label>所属分类</label>
                       <select name="pid" class="form-control">
	                        <option value="0">--请选择--</option>

	                        @foreach($cates as $k=>$v)
								<option value="{{$v->id}}" {{ $v->id == $id ? 'selected' : '' }} >{{$v->cname}}</option>
	                        @endforeach

                    	</select>
                    </div>
                    
                    <button type="submit" class="btn btn-sm btn-primary m-r-5">提交</button>
                </fieldset>
            </form>
        </div>
	
@endsection()