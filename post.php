<table border = 0 bordercolor = "grey" width = 650  align = "center" bgcolor = "EEAFEE">
			<tr height = 55>
				<td width = 10> </td>

				<td width = 45 align = "center"> <h2> <?php echo $i?> </h2> </td>

				<td style = "table-layout:fixed; width:420px;"  rowspan = 1 height = 50 bgcolor = "F5F5F5" width = 420> <?php print ($text);?>  </td>

				<td width = 45 align = "center" >
					<form action = "reaction.php?" method = "get">
						<input type = "hidden" name = "reaction" value = "like"> </input>
						<input type = "hidden" name = "id" value = "<?php echo $post_id?>"> </input>
						<input type = "hidden" name = "page" value = "<?php echo $page?>"> </input>
						<input type = "hidden" name = "count" value = "<?php echo $like?>"> </input>
						<button type = "submit"> 👍 &nbsp;<?php echo $like?> </button>
					</form>
				</td>


				<td width = 10> </td>
		</tr>
		<tr>
			<td width = 10> </td>
			<td> </td>
			<td colspan = 3>
				<button id="b<?php echo $i?>" onclick="show_comments('<?php echo $i?>')"> Показать комментарии </button>
			</td>

			<td width = 10> </td>
		</tr>


		</table>
