<?php

if (isset($_POST['zoom_submit'])
    && $_POST['criteriaColumnNames'][0] != 'pma_null'
    && $_POST['criteriaColumnNames'][1] != 'pma_null'
    && $_POST['criteriaColumnNames'][0] != $_POST['criteriaColumnNames'][1]
) {
    echo 'If is true'.PHP_EOL;
}
else {
    echo 'If is not true'.PHP_EOL;
}