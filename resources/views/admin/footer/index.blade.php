@extends('admin.layout.index')

@section('content')


<style type="text/css">
	.hiddens{
		width:2px;
		overflow: hidden;
		text-overflow:ellipsis;
		white-space: nowrap;
	}
</style>
<div class="panel panel-inverse" data-sortable-id="table-basic-1" style="width:750px">
	        <div class="panel-heading">
	            <div class="panel-heading-btn">
	                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
	                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
	                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
	                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
	            </div>
	            <h4 class="panel-title">网站底部列表</h4>
	        </div>
	        <div class="panel-body">
	            <table class="table">
	                <thead>
	                    <tr>
	                        <th>ID</th>
	                        <th>版权</th>
	                        <th>备案号</th>
	                        <th>公司名称</th>
	                        <th>创建时间</th>
	                        <th>操作</th>
	                    </tr>
	                </thead>
	                <tbody>
	               	@foreach($footer_data as $k=>$v)
	                    <tr>
	                        <td>{{$v->id}}</td>
	                        <td class="hiddens" title="{{$v->copy}}"><div style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;width:60px; ">{{$v->copy}}</div></td>
	                        <td class="hiddens" title="{{$v->filing}}"><div style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;width:60px; ">{{$v->filing}}</div></td>
	                        <td class="hiddens" title="{{$v->company}}"><div style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;width:60px; ">{{$v->company}}</div></td>
	                        <td class="hiddens" title="{{$v->created_at}}">{{$v->created_at}}</td>
	                        <td>
	                        	
	                        <form action="/admin/footer/{{ $v->id }}" method="post" style="display: inline-block;">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<input type="submit" value="删除" class="btn btn-danger">
						</form>
	                        	<a href="/admin/footer/{{$v->id}}/edit" class="btn btn-info">修改</a>
	                        </td>
	                    </tr>
	                @endforeach 
	                </tbody>
	            </table>
	            {{ $footer_data->links() }}
	        </div>
	    </div>

@endsection