<?php
if (!count($_GET) && !count($_POST) || isset($_GET['phpMyAdmin'])) {
    /* Show simple form */
    $content = '<form action="openid.php" method="post">
                OpenID: <input type="text" name="identifier" /><br />
                <input type="submit" name="start" />
                </form>
                </body>
                </html>';
    echo $content;
    exit;
}
echo 'count(GET) and count(POST) are 0.';