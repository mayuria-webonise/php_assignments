<?php 
session_start();
class hangman
{
	var $word;
	
	function __construct($word)
	{
		$this->word=$word;
	}
	/*displays word with updated inputs*/
	function display_word()
	{
		$_SESSION['puzzle']=$this->word;
		foreach ($_SESSION['blank_spaces'] as $key => $value) 
		{
			$_SESSION['puzzle']=substr_replace($_SESSION['puzzle'],'_',$_SESSION['blank_spaces'][$key],1);
		}
		echo $_SESSION['puzzle']."<br/>";
		return;
	}
	/*checks the user input is right or not*/
	function guess()
	{
		
		$guess=$_POST['letter'];
		echo "chances ".$_SESSION['chances']."<br/>";
		$_SESSION['chances']=$_SESSION['chances']-1;
		if(empty($_SESSION['blank_spaces']))
		{
			echo "you won<br/>";
			return 0;
		}
		foreach ($_SESSION['blank_spaces'] as $key => $value) {

			if($this->word[$_SESSION['blank_spaces'][$key]]==$guess)
			{
				echo "right guess<br/>";
				unset($_SESSION['blank_spaces'][$key]);
				$_SESSION['chances']=$_SESSION['chances']+1;
			}
			
		}
		$this->display_word();
		return 0;
	}

}

$game=new hangman("hello");

if(!isset($_SESSION['blank_spaces']))
{
	$_SESSION['blank_spaces']= array(1,3,4);
}
if(!isset($_SESSION['chances']))
{
	$_SESSION['chances']=5;
}
if(!isset($_SESSION['puzzle']))
{
	$game->display_word();
}
if(isset($_POST['letter']))
{
	if($_SESSION['chances']<=0)
	{
		echo "no trials";
		session_unset(); 
		session_destroy(); 
	}
	else
		$game->guess();
}
if(isset($_POST['restart']))
{
	session_unset();
	session_destroy();
}
		
?>
<html>
	<body>
		<form action="index.php" method="post">
	Guess the letter: <input type="text" name="letter"><br/><br/>
		<input type="submit" value="submit" name="submit">
		<input type="submit" value="restart_game" name="restart">
		</form>
	</body>
</html>