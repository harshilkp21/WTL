<?php
// Start session to temporarily store form data
session_start();

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $playerid = isset($_POST['playerid']) ? $_POST['playerid'] : '';
    $playername = isset($_POST['playername']) ? $_POST['playername'] : '';
    $gamegenre = isset($_POST['gamegenre']) ? $_POST['gamegenre'] : '';
    $score = isset($_POST['score']) ? (int)$_POST['score'] : 0;

    // Initialize session array if not already done
    if (!isset($_SESSION['players'])) {
        $_SESSION['players'] = [];
    }

    // Add player data to session array
    $_SESSION['players'][] = [
        'playerid' => $playerid,
        'playername' => $playername,
        'gamegenre' => $gamegenre,
        'score' => $score
    ];
}

// Find the player with the highest score
$highestScorer = null;
if (!empty($_SESSION['players'])) {
    foreach ($_SESSION['players'] as $player) {
        if ($highestScorer === null || $player['score'] > $highestScorer['score']) {
            $highestScorer = $player;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Details</title>
</head>
<body>
    <h2>Player with the Highest Score</h2>
    <?php if ($highestScorer && isset($highestScorer['playerid'], $highestScorer['playername'], $highestScorer['gamegenre'], $highestScorer['score'])): ?>
        <p><strong>Player ID:</strong> <?php echo htmlspecialchars($highestScorer['playerid']); ?></p>
        <p><strong>Player Name:</strong> <?php echo htmlspecialchars($highestScorer['playername']); ?></p>
        <p><strong>Game Genre:</strong> <?php echo htmlspecialchars($highestScorer['gamegenre']); ?></p>
        <p><strong>Score:</strong> <?php echo htmlspecialchars($highestScorer['score']); ?></p>
    <?php else: ?>
        <p>No players registered yet.</p>
    <?php endif; ?>

    <a href="index1.html">Register Another Player</a>
</body>
</html>
