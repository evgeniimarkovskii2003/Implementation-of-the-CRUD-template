<table id="c<?php echo $i?>" hidden border = 0>
	<tr>
		<td width = 10 rowspan = 40> </td>
		<td width = 45 rowspan = 40> </td>

		<form  action = "new_comment.php" method = "post">
			<td bgcolor = "EEAFEE" width = 393>
				<input type = "text" name = "text" placeholder = "Напишите комментарий"> </input>
				<input type = "hidden" name = "post_id" value = "<?php echo $post_id?>"> </input>
				<input type = "hidden" name = "forum_page"  value = "<?php echo $page?>"> </input>
			</td>
			<td>
				<button type = "submit"> Ответить </button>
			</td>
		</form>
	</tr>

	<?php
		for ($comm = 1; $comm <= $comm_count; $comm++) {
			echo "<tr><td>";
			include ("comment.php");
			echo "<hr></tr></td>";

			[$sub_comments, $sub_comm_count] = parse_sub_comments($c_id[$comm], $sub_comments_db);

			for ($sub_comm = 1; $sub_comm <= $sub_comm_count; $sub_comm++) {
				echo "<tr>";
				echo "<td  width = 380> &nbsp;······ ".$sub_comments[$sub_comm]."<hr></td>";
				echo "</tr>";

			}
		}
	?>

</table>
