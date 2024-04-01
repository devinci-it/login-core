// Typing animation function
function typeWriter(text, delay) {
    return new Promise((resolve) => {
        let index = 0;
        const output = document.getElementById("terminal");
        const interval = setInterval(() => {
            if (index < text.length) {
                output.innerHTML += text.charAt(index);
                index++;
            } else {
                clearInterval(interval);
                resolve();
            }
        }, delay);
    });
}

// Simulate command execution
async function simulateCommand(command, output, delay) {
    const outputDiv = document.getElementById("terminal");
    outputDiv.innerHTML += '<br>'; // Add empty line before output
    await typeWriter(command, 50); // Typing animation for command
    outputDiv.innerHTML += '<div class="cursor"></div>'; // Add cursor after command
    window.addEventListener('scroll', async function onScroll() {
        window.removeEventListener('scroll', onScroll); // Remove listener after first scroll
        for (const line of output) {
            outputDiv.innerHTML += '<div class="output"></div>'; // Add empty div for output line
            outputDiv.lastChild.textContent = line; // Set text content of last child (output line)
            await new Promise(resolve => setTimeout(resolve, delay)); // Delay before showing the output
        }
        outputDiv.removeChild(outputDiv.lastChild); // Remove cursor after output
    });
}

// Simulate commands from a string
async function simulateTerminal(commands, delay) {
    for (const command of commands) {
        await simulateCommand(command.command, command.output, delay);
    }
}

// Start command animation on load
const commands = [
    {
        command: "$ composer require --dev devinci-it/login-core ",
        output: [
            "Loading composer repositories with package information",
            "Updating dependencies",
            "Lock file operations: 0 installs, 9 updates, 0 removals",
            "- Upgrading laravel/pint (v1.14.0 => v1.15.0)",
            "- Upgrading laravel/prompts (v0.1.16 => v0.1.17)",
            "- Upgrading league/flysystem (3.25.1 => 3.26.0)",
            "- Upgrading phpunit/phpunit (10.5.15 => 10.5.16)",
            "- Upgrading spatie/ignition (1.12.0 => 1.13.0)",
            "- Upgrading symfony/css-selector (v6.4.3 => v7.0.3)",
            "- Upgrading symfony/event-dispatcher (v6.4.3 => v7.0.3)",
            "- Upgrading symfony/string (v6.4.4 => v7.0.4)",
            "- Upgrading symfony/yaml (v6.4.3 => v7.0.3)",
            "Writing lock file",
            "Installing dependencies from lock file (including require-dev)",
            "- Downloading phpunit/phpunit (10.5.16)",
            "- Downloading spatie/ignition (1.13.0)",
            "- Upgrading symfony/css-selector (v6.4.3 => v7.0.3): Extracting archive",
            "- Upgrading symfony/event-dispatcher (v6.4.3 => v7.0.3): Extracting archive",
            "- Upgrading symfony/string (v6.4.4 => v7.0.4): Extracting archive",
            "- Upgrading league/flysystem (3.25.1 => 3.26.0): Extracting archive",
            "- Upgrading laravel/prompts (v0.1.16 => v0.1.17): Extracting archive",
            "- Upgrading laravel/pint (v1.14.0 => v1.15.0): Extracting archive",
            "- Upgrading symfony/yaml (v6.4.3 => v7.0.3): Extracting archive",
            "- Upgrading phpunit/phpunit (10.5.15 => 10.5.16): Extracting archive",
            "- Upgrading spatie/ignition (1.12.0 => 1.13.0): Extracting archive",
            "Generating optimized autoload files",
            "> Illuminate\Foundation\ComposerScripts::postAutoloadDump",
            "> @php artisan package:discover --ansi",
            "INFO  Discovering packages.",
            "devinci-it/login-core ....................................................................................................................... DONE"
        ]
    }
];
simulateTerminal(commands, 50); // Start command animation on load
