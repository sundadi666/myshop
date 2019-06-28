@extends('admin.layout.index')
@section('content')
	
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<h1 class="page-header">权限管理<small></small></h1>
	
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
						    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 150px;">角色名称</th>						    
						    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 164px;">操作</th></tr>
                        </thead>
                        <tbody>
                        	@foreach($roles_data as $k=>$v)
                        	<tr class="gradeA odd" role="row">
                        		<td class="sorting_1" tabindex="0">{{$v->id}}</td>
                        		<td>{{$v->rname}}</td>                                             	
                        		<td>
                        			<a href="/admin/roles/{{$v->id}}/edit" class="btn btn-danger btn-xs">修改角色权限</a>
                        			
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
 
 
@endsection