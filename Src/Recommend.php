<?php
function get_recommendations_by_content($title, $num = 5) {
    $command = escapeshellcmd("py Engine/Recommend.py content " . escapeshellarg($title) . " $num");
    $output = shell_exec($command);

    return json_decode($output, true);
}

function get_recommendations_by_user($user_id, $num = 5) {
    $command = escapeshellcmd("py Engine/Recommend.py user $user_id $num");
    $output = shell_exec($command);
    return json_decode($output, true);
}
?>
