@extends('admin.layout.index')
@section('content')
	
	<div class="col-md-6 ui-sortable">
    <!-- begin panel -->
    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title="" data-init="true"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title="" data-init="true"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">秒杀活动添加</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" action="/admin/seckill" method="post">
            	{{ csrf_field() }}
         		
                 <div class="form-group">
                    <label class="col-md-3 control-label">秒杀终止时间</label>
                    <div class="col-md-9">
                        <input type="datetime-local" name="time" class="form-control" placeholder="公司名称">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">提交</label>
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