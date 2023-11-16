<?php
echo "<pre>Session: "; print_r($_SESSION); echo "</pre>";
echo "isLoggedIn: " . (isLoggedIn() ? "true" : "false") . "<br>";
echo "isAdmin: " . (isAdmin() ? "true" : "false") . "<br>";
?>

<html>
<body>
    <h1>Dashboard user</h1>
</body>
</html>