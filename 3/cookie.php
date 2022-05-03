// установление cookie
setcookie('location', 'USA', time() + 60 * 60 * 24 * 7, "/");

// Доступ к cookie
if(isset($_COOKIE['location'])) $location = $_COOKIE['location']; 

// Удаление cookie
setcookie('location', 'USA', time() - 2592000, "/");