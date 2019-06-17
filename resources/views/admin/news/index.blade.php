@extends('admin.layout.index')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}"> 
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
                    <h4 class="panel-title">公告管理</h4>
                </div>
                <div class="panel-body">
                    <div id="data-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            
                            <div class="col-sm-6" style="margin-left:60%;">
                                <div id="data-table_filter" class="dataTables_filter">
                                    <label>
                                        <form action="/admin/news" method="get">
                                            标题: <input type="search" name="keywords" class="form-control input-sm" placeholder="" aria-controls="data-table" value="{{ $params['keywords'] or '' }}">
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
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 297px;">标题</th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 164px;">操作</th></tr>
                        </thead>
                        <tbody>
                            @foreach($news_data as $k=>$v)
                            <tr class="gradeA odd" role="row">
                                <td class="sorting_1" tabindex="0">{{ $v->id }}</td>
                                <td>{{ $v->title }}</td>
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
                                      {{ $news_data->appends($params)->links() }}
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
<!-- 显示 模态框 开始 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">查看公告</h4>
      </div>
      <div class="modal-body">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<!-- 模态框 结束 -->

<!-- 修改 模态框 开始 -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">公告管理修改</h4>
      </div>
      <div class="modal-body">
        <form id="form1" action="/admin/news" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
          <div class="form-group">
            <label for="exampleInputEmail1">公告标题</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="公告标题">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">公告内容</label>
            <textarea class="form-control" rows="3" name="content" id="content1"></textarea>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-success"  value="确认修改">
          </div>
        </form>¬
      </div>
    </div>
  </div>
</div>
<!-- 修改 模态框 结束 -->
<script type="text/javascript">
	function showContent(id)
	{
		$('#myModal').modal('show');
		$.get('/admin/news/'+id,function(res){
			if(res.msg == 'ok') {
				$('.modal-body').html(res.info.content);
			} 
		},'json')
	}

    function edit(id)
    {
        $('#myModal1').modal('show');
        $.get('/admin/news/'+id+'/edit',function(res){
            let newurl = '/admin/news/'+id;
            $('#title').val(res.title);
            $('#content1').val(res.content);
            $('#form1').attr('action',newurl);
        },'json')
    }

    function del(id,obj)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if(!confirm('确定要删除吗')){
           return false;
        }

        $.ajax(
            {
                url: "/admin/news/" + id,
                type : "DELETE",
                success: function(data){
                    $(obj).parent().parent().parent().remove();
                },
            });
    }
</script>
@endsection