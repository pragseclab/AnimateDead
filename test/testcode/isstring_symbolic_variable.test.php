<?php

if (isset($_POST['identifier']) && is_string($_POST['identifier'])) {
    $identifier = $_POST['identifier'];
} else if (isset($_SESSION['identifier']) && is_string($_SESSION['identifier'])) {
    $identifier = $_SESSION['identifier'];
} else {
    $identifier = null;
}