<?php

    function get_most_popular_talks($talks_count = 20){
        $csvFile = fopen('../Data/Talks_Dataset/Talks_Dataset.csv', 'r');

        $headers = fgetcsv($csvFile);
        $talks = [];

        $maxTalks = 20;
        $count = 0;

        while (($row = fgetcsv($csvFile)) !== false && $count < $maxTalks) {
            $talks[] = $row;
            $count++;
        }

        fclose($csvFile);

        return $talks;
    }

?>