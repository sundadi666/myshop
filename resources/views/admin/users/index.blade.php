@extends('admin.layout.index')

@section('content')

<div class="panel panel-inverse">
		<div class="panel-heading">
		<div class="panel-heading-btn">
		    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
		    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
		    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
		    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
		</div>
		<h4 class="panel-title">用户列表</h4>
		</div>
		<div class="panel-body">
		<div id="data-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
			<div class="row">
                <div  style="margin-left:40%;">
					<div id="data-table_filter" class="dataTables_filter">
						<label>
							<form>
								用户名: <input type="text" name="search_uname" class="form-control input-sm" placeholder="" aria-controls="data-table" value="{{ $params['search_uname'] or '' }}">
								<input type="submit" class="btn btn-info" value="查询" >
								手机号: <input type="text" name="search_phone" class="form-control input-sm" placeholder="" aria-controls="data-table" value="{{ $params['search_phone'] or '' }}">
								<input type="submit" class="btn btn-info" value="查询" name="">
							</form>
						</label>
					</div>
				</div>
			</div>
	<div class="row"><div class="col-sm-12"><table id="data-table" class="table table-striped table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
		    <thead>
		        <tr role="row">
		        	<th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 96px;">ID</th>
		        	<th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 128px;">用户名</th>
		        	<th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 120px;">手机号</th>
		        	<th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 80px;">邮箱</th>
		        	<th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 80px;">状态</th>
		        	<th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 53px;">头像</th>
		        	<th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 53px;">操作</th>
		        </tr>
		    </thead>
		    <tbody>
		    @foreach($users_data as $k=>$v)
		    <tr class="gradeA odd" role="row">
		            <td class="sorting_1" tabindex="0">{{$v->id}}</td>
		            <td>{{$v->uname}}</td>
		            <td>{{$v->phone}}</td>
		            <td>{{$v->email}}</td>
		            <td>
		            	@if($v->status == 0)	
		            	<span><kbd style="background-color:red">未激活</kbd></span>
		            	@else
		            	<span><kbd style="background-color:green">已激活</kbd></span>
		            	@endif
		            </td>
		          
		            <td>
		            	<img style="width:50px;" src="/uploads/{{$v->usersinfos->profile or ''}}"></td>
		            <td>
		           
            	<!-- 判断 如果 状态 为0 就激活 -->
					@if($v->status==0)
						<a href="Javascript:;" onclick="status({{$v->id}},0)" class="btn btn-warning">激活</a>
				<!-- 如果 状态为 1 就停止 -->
					@else  
						<a href="Javascript:;" onclick="status({{$v->id}},1)" class="btn btn-warning">停止</a>
					@endif           									            
		            </td>
		     </tr>
		     @endforeach
			</tbody>
			</table>

			<!-- 模态框 开始 -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel">用户权限状态</h4>
					      </div>
					      <div class="modal-body">
					        <form action="/admin/users/status/{{$v->id}}" method="get">
					        	<input type="hidden" name="id" value="">	

					        	<div class="form-group"> 
									
														<br>
										
									未开启:<input type="radio" name="status" value="0">
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									开启:<input type="radio" name="status" value="1">
									<input type="submit" value="提交" class="btn btn-success">
							    </div> 

					        </form>
					      </div>
					      <div class="modal-footer">
					        
					    </div>
					  </div>
					</div>
			<!-- 模态框 结束 -->


			<script type="text/javascript">

			// 修改 状态
			function status(id,sta)
			{
				if(sta == 1){
						$('#myModal form input[type=radio]').eq(1).attr('checked',true);
					}else{
						$('#myModal form input[type=radio]').eq(0).attr('checked', true)
					}
				$('#myModal form input[type=hidden]').eq(0).val(id)
				$('#myModal').modal('show')
			}
			</script>
		</div>
		{{$users_data->appends($params)->links()}}
	</div>
	</div>
	</div>
</div>
@endsection