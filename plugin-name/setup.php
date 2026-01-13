<?php

/**
 * Setup file for Plugin Name
 */

class PluginSetup
{
    private $questions = array();
    private $responses = array();

    public function __construct()       
    {
        $this->questions = array(
            [
                'plugin_name' => 'What is the name of your plugin?',
                'default' => 'Plugin Name',
            ],
            [
                'plugin_slug' => 'What is the slug for your plugin?',
                'default' => 'plugin-name',
            ],
            [
                'plugin_namespace' => 'What is the base namespace for your plugin?',
                'default' => 'PluginName',
            ],
            [
                'author_name' => 'What is the author name?',
                'default' => '',
            ],
            [
                'author_uri'  => 'What is the author URI?',
                'default' => 'http://example.com/',
            ],
            [
                'plugin_description' => 'Provide a short description of the plugin:',
                'default' => '',
            ],
            [
                'plugin_version' => 'What is the initial version of the plugin?',
                'default' => '1.0.0',
            ],
            [
                'plugin_license' => 'What is the license for the plugin?',
                'default' => 'GPL-2.0+',
            ],
            [
                'plugin_license_uri' => 'What is the license URI?',
                'default' => 'http://www.gnu.org/licenses/gpl-2.0.txt',
            ],
            [
                'plugin_text_domain' => 'What is the text domain for the plugin?',
                'default' => 'plugin-name',
            ],
            [
                'plugin_domain_path' => 'What is the domain path for the plugin?',
                'default' => '/languages',
            ]
        );
    }
    
    // Method to run setup tasks
    public function run()
    {
        $this->printHeader();
        $this->askQuestions();
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
    private function askQuestions()
    {
        // Loop through each question and get user input
        foreach ($this->questions as $question) {
            foreach ($question as $key => $value) {
               $response = $this->ask($question[$key], $question['default']);
            $this->responses[$key] = $response;
            }
            
        }
    }

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

        echo "Plugin Name:     {$this->responses['plugin_name']}\n";
        echo "Plugin Slug:     {$this->responses['plugin_slug']}\n";
        echo "Package Name:    {$this->responses['package_name']}\n";
        echo "Namespace:       {$this->responses['namespace']}\n";
        echo "Text Domain:     {$this->responses['text_domain']}\n";
        echo "Plugin URI:      {$this->responses['plugin_uri']}\n";
        echo "Description:     {$this->responses['description']}\n";
        echo "Author:          {$this->responses['author']}\n";
        echo "Author URI:      {$this->responses['author_uri']}\n";
        echo "Version:         {$this->responses['version']}\n";
        echo "\n";
        $confirm = $this->ask('Is this correct? (yes/no)', 'yes');
        $this->responses['confirm'] = in_array(strtolower($confirm), ['yes', 'y']);
    }
}

$setup = new PluginSetup();
$setup->run();