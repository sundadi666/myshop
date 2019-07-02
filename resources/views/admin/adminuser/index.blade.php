@extends('admin.layout.index')
@section('content')
	
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<h1 class="page-header">管理后台管理员<small></small></h1>
	
	<div class="row">
	    <!-- begin col-12 -->
	    <div class="col-md-12 ui-sortable">
	        <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">管理员列表</h4>
                </div>
                <div class="panel-body">
                    <div id="data-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    	<div class="row">
                    		
	                    	<div class="col-sm-6" style="margin-left:60%;">
	                    		<div id="data-table_filter" class="dataTables_filter">
	                    			<label>
	                    				
	                    			</label>
	                    		</div>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-sm-12">
	                    		<table id="data-table" class="table table-striped table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                        <thead>
                           	<tr role="row">
						    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 50px;">ID</th>
						    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 150px;">管理员名称</th>
						      <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 100px;">性别</th>
						    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 150px;">手机</th>
						     <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 150px;">角色</th>
						    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 150px;">头像</th>
						    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 164px;">操作</th></tr>
                        </thead>
                        <tbody>
                        	@foreach($adminuser as $k=>$v)
                        	<tr class="gradeA odd" role="row">
                        		<td class="sorting_1" tabindex="0">{{$v->id}}</td>
                        		<td>{{$v->uname}}</td>
                        		<td>
                        			@if($v->sex == 'm')
                        			<span><kbd style="background-color: blue">男</kbd></span>
                        			@elseif($v->sex == 'w')
                        			<span><kbd style="background-color:red">女</kbd></span>
                        			@else($v->sex == 'x')
                        			<span><kbd>保密</kbd></span>
                        			@endif
                        			
                        		</td>
                        		<td>{{$v->phone}}</td>
                        		<td>{{$v->adminuserroles->rolesdata->rname}}</td>
                        		<td>
                        			<img style="width:80px;border-radius: 50%" src="/uploads/{{$v->profile}}">
                        		</td>
                        		<td>
                        			
                        			<form action="/admin/adminuser/{{ $v->id }}" method="post" style="display: inline-block;">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<input type="submit" value="删除" class="btn btn-danger">
									</form>
                        			<a href="/admin/adminuser/{{$v->id}}/edit" class="btn btn-success btn-xs">修改管理员信息</a>
                        		</td>
                        	</tr>
                        	@endforeach
                        </tbody>
                    	</table></div></div>
					<div class="row">
					   	<div class="col-sm-5">
						    <div class="dataTables_info" id="data-table_info" role="status" aria-live="polite">
						     
						    </div>
						</div>
						   <div class="col-sm-7">
						    	<div class="dataTables_paginate paging_simple_numbers" id="data-table_paginate">
								     <ul class="pagination">
								    	
								     </ul>
							    </div>
					   		</div>
				    </div> 

                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>

    {{$adminuser->links()}}
    
	

    
@endsection