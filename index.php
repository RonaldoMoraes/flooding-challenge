<html>
<body>
<?php
include_once __DIR__ . '/utils.php';
require_once __DIR__ . '/vendor/autoload.php';

if (isPost()) {
    include_once __DIR__ . '/get.php';
    include_once __DIR__ . '/execute.php';
} else {
    include_once __DIR__ . '/get.php';
}

?>
</body>
</html>