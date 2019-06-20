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
                    <h4 class="panel-title">商品管理</h4>
                </div>
                <div class="panel-body">
                    <div id="data-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            
                            <div class="col-sm-6" style="margin-left:60%;">
                                <div id="data-table_filter" class="dataTables_filter">
                                    <label>
                                        <form action="/admin/goods" method="get">
                                            标题: <input type="search" name="keywords" class="form-control input-sm" placeholder="" aria-controls="data-table" value="{{ $params['keywords'] or '' }}">
                                            <input type="submit" class="btn btn-info" value="搜索">
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
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 297px;">商品名称</th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 297px;">商品描述</th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 297px;">商品状态</th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 297px;">商品品牌</th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 297px;">缩略图</th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 297px;">型号</th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 297px;">大小</th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 297px;">是否推荐</th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 164px;">操作</th></tr>
                        </thead>
                        <tbody>
                            @foreach($goods_data as $k=>$v)
                            <tr class="gradeA odd" role="row">
                                <td class="sorting_1" tabindex="0" style="width: 3%;">{{ $v->id }}</td>
                                <td>{{ $v->title }}</td>
                                <td>{{ $v->desc }}</td>
                                @if($v->goods_status == 0)
                                <td><kbd style="background: #000000;">未激活</kbd></td>
                                @else
                                <td><kbd style="background: #4cd415;">激活</kbd></td>
                                @endif
                                <td>{{ $v->brands_data->bname }}</td>
                                <td><img src="/{{ $v->img_small }}"></td>
                                <td><button type="button" class="btn btn-primary m-r-5 m-b-5" onclick="modelAdd({{ $v->id }})">添加</button></td>
                                <td><button type="button" class="btn btn-primary m-r-5 m-b-5" onclick="sizeAdd({{ $v->id }})">添加</button></td>
                                <td>
                                  @if($v->is_recommend == 0)
                                  <button type="button" class="btn btn-danger m-r-5 m-b-5" onclick="setRecommend({{ $v->id }})">设为推荐</button>
                                  @else 
                                  <button type="button" class="btn btn-warning m-r-5 m-b-5" onclick="setRecommend({{ $v->id }})">取消推荐</button>
                                  @endif
                                </td>
                                <td style="width: 15%;">
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
                                      {{ $goods_data->appends($params)->links() }}
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
        <h4 class="modal-title" id="myModalLabel">商品修改</h4>
      </div>
      <div class="modal-body">
        <form id="form1" action="admin/goods" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
          <div class="form-group">
            <label for="exampleInputEmail1">商品标题</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="商品标题">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">商品描述</label>
            <input type="text" name="desc" class="form-control" id="desc" placeholder="商品标题">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">缩略图</label>
            <div>
                <img id="old_pic" src="">
                <input type="hidden" name="img_small">
                <input name="img" type="file" id="exampleInputFile">
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">商品状态</label>
            <label class="radio-inline">
             <input type="radio" name="goods_status" id="inlineRadio1" value="1">激活
            </label>
            <label class="radio-inline">
              <input type="radio" name="goods_status" id="inlineRadio2" value="0">未激活
            </label>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">商品分类</label>
            <select name="cid" id="cid" class="form-control" style="width: 100px;">
                @foreach($cates_data as $k=>$v)
                <option value="{{$v->id}}">{{ $v->cname}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">所属品牌</label>
            <select name="bid" id="bid" class="form-control" style="width: 100px;">
              <option>请选择</option>
              @foreach($brands_data as $k=>$v)
              <option value="{{ $v->id }}">{{ $v->bname }}</option>
              @endforeach
            </select>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-success"  value="确认修改">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- 修改 模态框 结束 -->

<!-- 型号 模态框 开始 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">添加型号</h4>
      </div>
      <div class="modal-body">
        <form id="form1" action="/admin/models" method="POST">
            {{ csrf_field() }}
          <div class="form-group">
            <label for="exampleInputEmail1">商品型号</label><br>
            <input type="text" name="mname" class="form-control" id="title" placeholder="商品型号">
            <br>
            <label for="exampleInputEmail1" style="color: red;">注意：商品型号必须以英文" , "逗号隔开 , 不能含有任何特殊字符</label><br>
          </div>
          <input type="hidden" name="id" id="gid">
          <div class="modal-footer">
            <input type="submit" class="btn btn-success"  value="确认修改">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- 型号 模态框 结束 -->

<!-- 大小 模态框 开始 -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">添加大小</h4>
      </div>
      <div class="modal-body">
        <form id="form2" action="" method="POST">
            {{ csrf_field() }}
            <span>商品型号:</span>
            <select id="goods_models" name="mid" class="form-control" style="width: 100px;display: inline-block;">
              <option>请选择</option>
            </select><br><br>
            <!-- <span>商品大小：</span> -->

            <span>商品大小:</span>
            <input type="text" name="sname" class="form-control" id="title" placeholder="商品大小" style="width: 100px;display: inline-block;">
            <label for="exampleInputEmail1" style="color: red;position: relative;left:0px;">
            注意：商品大小不能含有任何特殊字符</label><br><br>

            <span>商品单价:</span>
            <input type="text" name="money" class="form-control" id="title" placeholder="商品单价" style="width: 100px;display: inline-block;"><br>
            <label for="exampleInputEmail1" style="color: red;position: relative;left:0px;"><br>
            
            <span style="color: #707478;">商品库存:</span>
            <input type="text" name="inventory" class="form-control" id="title" placeholder="商品库存" style="width: 100px;display: inline-block;"><br>
            <label for="exampleInputEmail1" style="color: red;position: relative;left:0px;">
          <!-- <input type="hidden" name="goods_id" id="goods_id"> -->
          <div class="modal-footer">
            <input type="submit" class="btn btn-success"  value="确认修改">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- 大小 模态框 结束 -->
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
        $.get('/admin/goods/'+id+'/edit',function(res){
            let newurl = '/admin/goods/'+id;
            $('#title').val(res.goods.title);
            $('#desc').val(res.goods.desc);
            $("input[name=goods_status][value="+res.goods.goods_status+"]").attr("checked",true);
            $('#old_pic').attr('src','/'+res.goods.img_small);
            $('input[name="img_small"]').val(res.goods.img_small);

            $('#form1').attr('action',newurl);

            $("#cid").find(`option[value="${res.goods.cid}"]`).attr("selected",true);
            $("#bid").find(`option[value="${res.goods.bid}"]`).attr("selected",true);

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

    function modelAdd(id)
    {
        $('#myModal2').modal('show');
        $('#gid').val(id);
    }

    function sizeAdd(id)
    {
        $('#myModal3').modal('show');
        $.get('/admin/sizes/create/'+id,{id},function(res){
            if(res.msg == 'ok') {

            var str="";
            str += "<option value=''>请选择</option>"
            $.each(res.models_data,function(index,val){
               str+="<option value='"+val.id+"'>"+val.mname+"</option>"
            })
             $("#goods_models").empty();
            $("#goods_models").append(str);

            // let newurl = '/admin/sizes/update?gid='+id+'mid='+$("#goods_models").find("option:selected").val();

            let newurl = '/admin/sizes/store';
            
            $('#form2').attr('action',newurl);

            }
        },'json')
    }

    function getMid(models_value)
    {

    }

    function destroy(id,obj)
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
                url: "/admin/goods/" + id,
                type : "DELETE",
                dataType: "json", 
                success: function(data){
                    if(data.msg == 'ok') {
                      $(obj).parent().parent().remove();
                    }
                },
            });
    }

    function setRecommend(id)
    {
      $.get('/admin/goods/setRecommend/'+id,function(res){
        if(res.msg == 'ok') {
          location.reload();
        }
      },'json')
    }
</script>
@endsection