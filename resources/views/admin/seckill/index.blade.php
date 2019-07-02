@extends('admin.layout.index')
@section('content')
	<meta name="csrf-token" content="{{ csrf_token() }}">
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
	            <h4 class="panel-title">秒杀查看</h4>
	        </div>
	        <div class="panel-body">
	            <table class="table">
	                <thead>
	                    <tr>
	                        <th>ID</th>
	                        <th>秒杀终止时间</th>
	                    </tr>
	                </thead>
	                <tbody>
	               	@foreach($seckill_data as $k=>$v)
	                    <tr>
	                        <td>{{$v->id}}</td>
	                        <td>{{$v->time}}</td>
	                        
	                        
	                        <td>
								<a href="javascript:;"  class="btn btn-danger" onclick="destroy({{$v->id}},this)">删除</a>
	                        </td>
	                    </tr>
	                @endforeach 
	                </tbody>
	            </table>
	            
	        </div>
	    </div>
		
		<script type="text/javascript">
				
				function destroy(id,msg){
					$.ajaxSetup({
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    }
				});

					$.ajax({
						type:'DELETE',
						url:'/admin/seckill/' +id,
						success:function(res){
							if(res == "ok"){
								$(msg).parent().parent().remove();
							}
						}
					})
				}
	

		</script>

@endsection