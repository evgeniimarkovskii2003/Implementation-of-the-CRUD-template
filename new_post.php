<?php

$GLOBALS["symb_base"] = "0987654321zxcvbnmasdfghjklqwertyuiopPOIUYTREWQLKJHGFDSAMNBVCXZ";


function gen_str($count) {
	$string = "";
	for ($i = 0; $i < $count; $i++) {
		$num = rand(0,strlen($GLOBALS["symb_base"]) - 1);
		$rand_symb = $GLOBALS["symb_base"][$num];
		$string = $string.$rand_symb;
	}
	return $string;
}


if (isset($_POST["text"])) {
	$text = $_POST["text"];
	$text = trim($text);
	$time = time();

	if (strlen($text) > 900) {
		header("Location: http://localhost/forum.php?message=Слишком длинный текст");
		exit;
	}
	if (strlen($text) < 4) {
		header("Location: http://localhost/forum.php?message=Слишком короткий текст");
		exit;
	}


		$sql = "INSERT INTO `posts` (`id`, `text`, `like_count`) VALUES (NULL, '".$text."', '0');";

		$link = mysqli_connect("localhost", "admin", "admin", "crud");
		mysqli_set_charset($link, "utf8");
		$res = mysqli_query($link, $sql);

		header("Location: http://localhost/forum.php");
	}

?>
