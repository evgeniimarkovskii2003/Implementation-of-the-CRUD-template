<?php

$link = mysqli_connect("localhost", "admin", "admin", "crud");

mysqli_set_charset($link, "utf8");

$sql = 'SELECT * FROM posts ORDER BY id DESC';

$result = mysqli_query($link, $sql);
$max_posts = mysqli_num_rows($result);
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = 'SELECT * FROM comments ORDER BY id DESC';
$comments_db = mysqli_query($link, $sql);
$comments_db = mysqli_fetch_all($comments_db, MYSQLI_ASSOC);

$sql = 'SELECT * FROM sub_comments ORDER BY id DESC';
$sub_comments_db = mysqli_query($link, $sql);
$sub_comments_db = mysqli_fetch_all($sub_comments_db, MYSQLI_ASSOC);

function parse_post($index, $result) {

	$data_string = $result[$index];

	$text = $data_string['text'];
	$like = $data_string['like_count'];

	$post_id = $data_string['id'];

			return [$text, $like, $post_id];
}


function parse_comment($post_id, $comments_db) {
	$comm_count = 0;
	$comments_a = array();
	$comments_id = array();

	foreach ($comments_db as $comment) {
		if ($comment["post_id"] == $post_id) {

			$comm_count += 1;

			$comments_a[$comm_count] = $comment["text"];
			$comments_id[$comm_count] = $comment["id"];

		}
	}

	return [$comments_a, $comm_count, $comments_id, 0];
}


function parse_sub_comments($comment_id, $sub_comments_db) {
	$sub_comm_count = 0;
	$sub_comments_a = array();

	foreach ($sub_comments_db as $sub_comment) {
		if ($sub_comment["comment_id"] == $comment_id) {

			$sub_comm_count += 1;

			$sub_comments_a[$sub_comm_count] = $sub_comment["text"];
		}
	}

	return [$sub_comments_a, $sub_comm_count];
}

?>
