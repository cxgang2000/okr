<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>我的目标 操作历史</title>
  <!--                       CSS                       -->

  

 </HEAD>
</head>
<body id="my_mb">

<table width="971" border="1">
  <tr>
    <td width="310">时间</td>
    <td width="109">任务</td>
    <td width="227">修改前</td>
    <td width="297">修改后</td>
  </tr>
  @foreach ($arr_log as $l)
  <tr>
    <td>{{ $l['created_at']  }}&nbsp;</td>
    <td>
    
    @if ($l['type'] === 0)
        新增
    @elseif ($l['type'] === 1)
        删除
    @else
        更新
    @endif
    
    
    &nbsp;
    
    </td>
    <td>{{ $l['descbefore']  }}&nbsp;</td>
    <td>{{ $l['descafter']  }}&nbsp;</td>
  </tr>
  @endforeach
</table>



<script type="text/javascript" src="/okr/js/main.js"></script>
</body>
<!-- Download From www.exet.tk-->
</html>