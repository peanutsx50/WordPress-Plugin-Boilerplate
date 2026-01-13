<?php

/**
 * Setup file for Plugin Name
 */

class PluginSetup
{
    private $questions = array();
    private $confirm;

    public function __construct()
    {
        $this->questions = array(
            [
                'plugin_name' => 'What is the name of your plugin?',
                'response' => '',
                'default' => 'Plugin Name',
            ],
            [
                'plugin_slug' => 'What is the slug for your plugin?',
                'response' => '',
                'default' => 'plugin-name',
            ],
            [
                'plugin_namespace' => 'What is the base namespace for your plugin?',
                'response' => '',
                'default' => 'PluginName',
            ],
            [
                'author_name' => 'What is the author name?',
                'response' => '',
                'default' => 'John Doe',
            ],
            [
                'author_uri'  => 'What is the author URI?',
                'response' => '',
                'default' => 'http://example.com/',
            ],
            [
                'plugin_description' => 'Provide a short description of the plugin:',
                'response' => '',
                'default' => 'A short description of the plugin',
            ],
            [
                'plugin_version' => 'What is the initial version of the plugin?',
                'response' => '',
                'default' => '1.0.0',
            ],
            [
                'plugin_license' => 'What is the license for the plugin?',
                'response' => '',
                'default' => 'GPL-2.0+',
            ],
            [
                'plugin_license_uri' => 'What is the license URI?',
                'response' => '',
                'default' => 'http://www.gnu.org/licenses/gpl-2.0.txt',
            ],
            [
                'plugin_text_domain' => 'What is the text domain for the plugin?',
                'response' => '',
                'default' => 'plugin-name',
            ],
            [
                'plugin_domain_path' => 'What is the domain path for the plugin?',
                'response' => '',
                'default' => '/languages',
            ]
        );
    }

    // Method to run setup tasks
    public function run()
    {
        $this->printHeader();
        $this->askQuestions();
        if (strtolower($this->confirm) === 'yes') {
            $this->printSuccess();
        } else {
            echo "Setup aborted. Please run the setup again to enter correct details.\n";
        }
    }

    // display ascii art header
    private function printHeader()
    {
        echo "\n";
        echo "╔══════════════════════════════════════════════════════════╗\n";
        echo "║   WordPress Plugin Boilerplate Setup                    ║\n";
        echo "╚══════════════════════════════════════════════════════════╝\n";
        echo "\n";
    }

    // display success message
    private function printSuccess()
    {
        echo "\n";
        echo "╔══════════════════════════════════════════════════════════╗\n";
        echo "║   ✓ Plugin setup completed successfully!                ║\n";
        echo "╚══════════════════════════════════════════════════════════╝\n";
        echo "\n";
        echo "Your plugin '{$this->questions[0]['response']}' is ready!\n";
        echo "\nNext steps:\n";
        echo "  1. Review the generated files\n";
        echo "  2. Run 'composer install'\n";
        echo "  3. Start building your plugin!\n\n";
    }

    // helper function to ask questions
    private function askQuestions()
    {
        for ($i = 0; $i < count($this->questions); $i++) {
            $this->questions[$i]['response'] = $this->ask(
                $this->questions[$i][array_key_first($this->questions[$i])],
                $this->questions[$i]['default']
            );
        }
        // confirm details with user
        $this->confirmDetails();
    }

    // function to display question and get user input
    private function ask($questions, $default = '')
    {
        // display the question and get user input
        $prompt = $questions . ($default ? " [{$default}]: " : ': ');
        echo $prompt;
        $input = trim(fgets(STDIN));
        return $input ? $input : $default;
    }

    // confrim details with user
    private function confirmDetails()
    {
        echo "\n\n";
        echo "═══════════════════════════════════════════════════════════\n";
        echo "Please confirm your plugin details:\n";
        echo "═══════════════════════════════════════════════════════════\n\n";

        for ($i = 0; $i < count($this->questions); $i++) {
            $key = array_key_first($this->questions[$i]);
            $question = $this->questions[$i][$key];
            $value = $this->questions[$i]['response'];
            echo $question . ": " . $value . "\n";
        }

        echo "\n";
        $this->confirm = $this->ask('Is this correct? (yes/no)', 'yes');
    }
}

$setup = new PluginSetup();
$setup->run();
