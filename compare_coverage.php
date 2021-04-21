<?php

$base_coverage_file = './pma470_login_coverage.php';
$path_prefix = '/home/ubuntu/debloating_templates/debloating_phpMyAdmin/web/phpMyAdmin-4.7.0-all-languages/';

// defines $covered_files
include $base_coverage_file;

function parse_coverage_logs($filename) {
    global $path_prefix;
    $code_coverage = [];
    // $file = file($filename);
    $handle = fopen($filename, 'r');
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            // process the line read.
            if (strpos($line, $path_prefix) !== 0 || strpos($line, 'FuncCall') !== false) {
                continue;
            }
            else {
                $log_entry = str_replace($path_prefix, '', $line);
                list($filename, $linerange) = explode(': ', $log_entry);
                list($start_line, $end_line) = explode('-', $linerange);
                for ($i = $start_line; $i <= $end_line; $i++) {
                    if (!array_key_exists($filename, $code_coverage) || !in_array($i, $code_coverage[$filename])) {
                        $code_coverage[$filename][] = $i;
                    }
                }
            }
        }
        fclose($handle);
    } else {
        // error opening the file.
    }
    return $code_coverage;
}

/**
 * @param array $coverage_1 Baseline coverage
 * @param array $coverage_2 Compared with this
 */
function print_coverage_diff(array $coverage_1, array $coverage_2) {
    foreach ($coverage_1 as $filename => $lines) {
        $matching_lines = 0;
        $total_lines_1 = count($coverage_1[$filename]);
        $total_lines_2 = 0;
        $extra_1 = 0;
        $extra_2 = 0;
        if (array_key_exists($filename, $coverage_2)) {
            $total_lines_2 = count($coverage_2[$filename]);
            foreach ($lines as $line) {
                if (in_array($line, $coverage_2[$filename])) {
                    $matching_lines++;
                }
                else {
                    $extra_1++;
                }
            }
            if ($total_lines_2 > $matching_lines) {
                $extra_2 = $total_lines_2 - $matching_lines;
            }
        }
        if ($matching_lines > 0) {
            echo sprintf('[M] (%s) Total lines: %d/%d - Matching: %d - Extra: %d/%d', $filename, $total_lines_1, $total_lines_2, $matching_lines, $extra_1, $extra_2).PHP_EOL;
        }
        else {
            echo sprintf('[U] (%s) Total lines: %d/%d - Matching: %d - Extra: %d/%d', $filename, $total_lines_1, $total_lines_2, $matching_lines, $extra_1, $extra_2).PHP_EOL;
        }
    }
    foreach ($coverage_2 as $filename => $lines) {
        if (!array_key_exists($filename, $coverage_1)) {
            echo sprintf('[E] (%s) Total lines: 0/%d - Matching: 0 - Extra: 0/%d', $filename, count($lines), count($lines)).PHP_EOL;
        }
    }
}

// Remove duplicates
$baseline_coverage = [];
foreach ($covered_files as $entry) {
    $filename = $entry['file_name'];
    if (strpos($filename, 'start_xdebug') !== false) {
        continue;
    }
    $linenumber = $entry['line_number'];
    if (!in_array($filename, $baseline_coverage) || !in_array($linenumber, $baseline_coverage[$filename])) {
        if ($linenumber === 0) {
            continue;
        }
        $baseline_coverage[$filename][] = $linenumber;
    }
}
$compared_coverage = parse_coverage_logs($argv[1]);
print_coverage_diff($baseline_coverage, $compared_coverage);