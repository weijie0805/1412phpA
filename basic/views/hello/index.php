<?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
?>
<center>
<h3>留言</h3>
<form action="" method="post">
	<table>
		<tr>
			<td>标题</td>
			<td>
				<input type="text" name="title">
			</td>
		</tr>
		<tr>
			<td>内容</td>
			<td>
				<textarea name="content" id="content" cols="30" rows="10"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" value="提交" id="add">
			</td>
		</tr>
	</table>
</form>
<div id="show">
	<h3>留言板</h3>
	<table  cellspacing="0" cellpadding="0" width="40%">
	<tr>
		<td>标题</td>
		<td>内容</td>
		<td>操作</td>
	</tr>
	<?php foreach($data as $k=>$v){;?>
	<tr>
		<td><?=$v['title'];?></td>
		<td><?=$v['content'];?></td>
		<td>
			<a href="?r=test/del&id=<?=$v['id'];?>">删除</a>
			<a href="?r=test/edit&id=<?=$v['id'];?>">修改</a>
		</td>
	</tr>
	<?php };?>
	</table>
</div>
<?php
	echo LinkPager::widget([
	'pagination' => $pages,
	]);
?>
</center>
<script src="css/jq.js"></script>
<script>
	$(function(){
		//ajax添加数据到数据库
		$("#add").click(function(){
			//接值
			
			var title = $("input[name='title']").val();
			var content = $("#content").val();

			$.ajax({
				type:'POST',
				url: "<?=Url::to(['test/AddMessage'])?>",
				data:{title:title,content:content},
				success:function(result){
					// alert(result);return;
					if(result=="no"){
						alert('sorry,留言失败');
					}else{
						var msg=eval("("+result+")");

						var str="<h3>留言板</h3><table><tr><td>标题</td><td>内容</td><td>操作</td></tr>";	
						$.each(msg,function(key,val){
							str+="<tr><td>"+val.title+"</td><td>"+val.content+"</td><td><a href='?r=test/del&id="+val.id+"'>删除</a><a href='?r=test/edit&id="+val.id+"'>修改</a> </td></tr>";
						})
						str+="</table>";
						$("#show").html(str);
						$("input[name='title']").val(null);
						$("#content").val(null);
					}

				}
			})
		})
	})
</script>