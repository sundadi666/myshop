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
            <h4 class="panel-title">角色修改</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="/admin/roles/{{$role->id}}" method="post">
            	{{ csrf_field() }}
                 {{ method_field('PUT') }}
                <div class="form-group">
                    <label class="col-md-3 control-label">角色名称</label>
                    <div class="col-md-9">
                        <input type="text" name="rname" value="{{$role->rname}}" class="form-control" placeholder="角色名称">
                    </div>
                </div>
               
              
              
                <div class="form-group">
                    <label class="col-md-3 control-label">权限名称</label>
                    <div class="col-md-9">                 	
                        <div class="checkbox">
                        @foreach($nodes_data as $k=>$v)	                   
                        <br>
                        	<h4>{{$conall[$k]}}&nbsp;&nbsp;<small>{{$k}}</small></h4>
                        	
                        	    @foreach($v as $kk=>$vv)

                            <label>
                               <!-- 判断当前的权限id是否在nid数组中 存在就默认选择 -->
                               @if(in_array($vv['id'],$nid))

                                <input type="checkbox" checked name="nids[]" value="{{$vv['id']}}">
                                {{$vv['desc']}}

                                @else
                                  <input type="checkbox" name="nids[]" value="{{$vv['id']}}">
                                {{$vv['desc']}}

                               @endif
                            </label>
                                 
                            	@endforeach
                              @endforeach 
                        </div>                                    
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