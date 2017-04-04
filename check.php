<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_REQUEST['captcha'])) {
        if($_REQUEST['captcha'] == $_SESSION['captcha'])
            echo '<font color="green">*hacker voice* im in!</font>';
        else
            echo '<font color="red">lol nice try. nope</font>';
    } else {
        echo '<font color="red">dude, do the captcha</font>';
    }
}
?>

<form action="check.php" method="POST">
<img id="capt" src="image.php"><br>
<input type="text" name="captcha"><br>
<input type="submit">
</form>

<script>
document.getElementById("capt").addEventListener('click', function(e) {
    document.getElementById("capt").src = "image.php?" + new Date().getTime();
}, false);
</script>
