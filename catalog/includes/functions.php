<?php
  // Returns true if user already has a logged-in session
	function isGranted()
	{
		if(isset($_SESSION['granted'])) return true;
		return false;
	}

  // Returns a hashed word, given a word and a username
	function hashIt($word, $user)
	{
		$s1 = "abcdefg";
		$s2 = "1234567";

		$u = hash('sha512', $s1.$user.$s2);

		return hash('sha512', $u.$word.$u);
	}
?>