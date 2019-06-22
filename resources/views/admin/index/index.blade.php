@extends('admin.layout.index')

@section('content')

<table class="table table-striped">

	
	<h3 class="text-center">网站配置信息</h3>
	<tr>
	
	<th>本地服务器---{{($_SERVER['REMOTE_ADDR'])}}</th>
	<th>服务器端口---{{($_SERVER['SERVER_PORT'])}}</th>	

  </tr>
  <tr>
  	<th>框架名称---{{($_SERVER['APP_NAME'])}}</th>
	<th>网站名称---{{($_SERVER['SERVER_NAME'])}}</th>	
  </tr>
  <tr>
  	<th>网站根目录---{{($_SERVER['DOCUMENT_ROOT'])}}</th>
  </tr>
</table>
@endsection