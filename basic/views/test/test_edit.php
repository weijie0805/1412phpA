<center>
	<h3>留言</h3>
<form action="?r=test/update" method="post">
<input type="hidden" name="id" value="<?=$id;?>">
	<table>
		<tr>
			<td>标题</td>
			<td>
				<input type="text" name="title" value="<?=$data['title']?>">
			</td>
		</tr>
		<tr>
			<td>内容</td>
			<td>
				<textarea name="content" id="content" cols="30" rows="10"><?=$data['content']?></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" value="提交" id="add">
			</td>
		</tr>
	</table>
</form>
</center>	