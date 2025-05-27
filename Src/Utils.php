<?php

function get_most_popular_talks($talks_count = 20) {
    $csvFile = fopen('../Data/Talks_Dataset.csv', 'r');
    if (!$csvFile) {
        return [];
    }

    $headers = fgetcsv($csvFile);
    $talks = [];

    $count = 0;
    while (($row = fgetcsv($csvFile)) !== false && $count < $talks_count) {
        $talk = array_combine($headers, $row);
        if ($talk !== false) {
            $talks[] = $talk;
            $count++;
        }
    }

    fclose($csvFile);
    return $talks;
}


?>