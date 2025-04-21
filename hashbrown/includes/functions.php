<?php
	function isGranted()
	{
		if(isset($_SESSION['granted'])) return true;
		return false;
	}

	function hashIt($word, $user)
	{
		$s1 = "abcdefg";
		$s2 = "1234567";

		$u = hash('sha512', $s1.$user.$s2);

		return hash('sha512', $u.$word.$u);
	}
?>