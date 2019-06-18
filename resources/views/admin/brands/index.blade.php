@extends('admin.layout.index')
@section('content')
	
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<h1 class="page-header">品牌<small></small></h1>
	
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
                    <h4 class="panel-title">品牌管理</h4>
                </div>
                <div class="panel-body">
                    <div id="data-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    	<div class="row">
                    		
	                    	<div class="col-sm-6" style="margin-left:60%;">
	                    		<div id="data-table_filter" class="dataTables_filter">
	                    			<label>
	                    				<form action="/admin/brands" method="get">
		                    				品牌名: <input type="search" name="search_bname" class="form-control input-sm" placeholder="" aria-controls="data-table" value="{{ $params['search_bname'] or '' }}">
	                    					<input type="submit" class="btn btn-info" value="查询" name="">
	                    				</form>
	                    			</label>
	                    		</div>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-sm-12">
	                    		<table id="data-table" class="table table-striped table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                        <thead>
                           	<tr role="row">
						    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 327px;">id</th>
						    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 297px;">品牌名称</th>
						    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 218px;">品牌图片</th>
						    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 218px;">品牌介绍</th>
						    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 164px;">操作</th></tr>
                        </thead>
                        <tbody>
                        	@foreach($brands_data as $k=>$v)
                            <tr class="gradeA odd" role="row">
                                <td class="sorting_1" tabindex="0">{{ $v->id }}</td>
                                <td>{{ $v->bname }}</td>
                                <td>
                                	
									<img src="/uploads/{{ $v->bimg }}" style="width:100px">
                                </td>
                                <td>{{ $v->intro }}</td>
                                <td>
									<a href="javascript:;" class="btn btn-info" onclick="edit({{ $v->id }})">修改</a>
									<a href="javascript:;" class="btn btn-success" onclick="destroy({{ $v->id }},this)">删除</a>
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
								    	{{ $brands_data->appends($params)->links() }}
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


	<script type="text/javascript">
		

		// 执行修改
		function edit(id){
			$.get('/admin/brands/'+id+'/edit',function(res){

				var resimg = '/uploads/' + res.bimg;
				$('#exampleModal').find('#bname').val(res.bname);
				$('#exampleModal').find('#intro').val(res.intro);
				$('#exampleModal').find('#oldbimg').attr('src',resimg);
				$('#exampleModal').find('form').attr('action','/admin/brands/'+id);
				$('#exampleModal').modal('show')
			},'json');
			
		}

		// 执行 删除
		function destroy(id,esg){
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			$.ajax({
				type:'DELETE',
				url:'/admin/brands/' + id,
				success: function(msg){
				     if(msg == "success"){
				     	$(esg).parent().parent().remove();
				     }
				}
			})
		}
		
		
	</script>

    <!-- 修改品牌链接 的模态框 开始 -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">品牌修改</h4>
	      </div>
	      <div class="modal-body">
	        <form action="/admin/brands" method="post" enctype="multipart/form-data">
	        	{{ csrf_field() }}
	        	{{ method_field('PUT') }}
	          <div class="form-group">
	            <label for="bname" class="control-label">品牌名称:</label>
	            <input type="text" name="bname" class="form-control" id="bname">
	          </div>
	          <div class="form-group">
	            <label for="bimg" class="control-label">品牌图片:</label>
				<img src="1.jpg" id="oldbimg" style="width:100px;" ="oldbimg">
				<input type="file" name="bimg">
	          </div>
	          <div class="form-group">
	            <label for="intro" class="control-label">品牌描述:</label>
	           	<textarea name="intro" id="intro" class="form-control" placeholder="在此输入内容..." rows="5"></textarea>
			  </div>
			  <div class="modal-footer">
		        <input type="submit" class="btn btn-primary" value="修改">
		      </div>
	        </form>
	      </div>
		</div>
	  </div>
	</div>
    <!-- 修改品牌链接 的模态框 结束 -->

@endsection