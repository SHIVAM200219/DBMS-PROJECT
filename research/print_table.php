<?php
    function print_table($arr)
    {
        echo "<table>";
        // Print table headers
        echo "<tr>";
        for ($i = 0; $i < count($arr[0]); $i++) {
            if ($i == 1 || $i == 3) {
                continue;
            } else {
                echo "<th class=\"text-center\">", $arr[0][$i], "</th>";
            }
        }
        echo "</tr>";
        // Print table rows
        for ($i = 1; $i < count($arr); $i++) {
            echo "<tr>";
            for ($j = 0; $j < count($arr[$i]); $j++) {
                if ($j == 1 || $j == 3) {
                    continue;
                } else if ($j == 4 || $j == 7) {
                    echo "<td class=\"text-center\">", $arr[$i][$j], "</td>";
                } else if ($j == 0 || $j == 2) {
                    echo "<td><a class=\"text-light\" href='", $arr[$i][$j + 1], "'>", $arr[$i][$j], "</a></td>";
                } else {
                    echo "<td>", $arr[$i][$j], "</td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    }

?>