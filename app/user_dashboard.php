<?php
echo "<pre>Session: "; print_r($_SESSION); echo "</pre>";
echo "isLoggedIn: " . (isLoggedIn() ? "true" : "false") . "<br>";
echo "isAdmin: " . (isAdmin() ? "true" : "false") . "<br>";
?>

<html>
<body>
    <h1>Dashboard user</h1>
    <a href="path_to_logout.php" class="btn my-custom-logout">Déconnexion</a>
</body>
</html>