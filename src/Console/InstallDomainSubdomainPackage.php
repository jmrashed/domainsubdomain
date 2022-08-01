<?php

namespace Jmrashed\DomainSubdomain\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallDomainSubdomainPackage extends Command
{
    protected $hidden = true; // Hide the command from the list of commands

    protected $signature = 'domainsubdomain:install'; // The signature of the command

    protected $description = 'Install the domainsubdomain';

    public function handle()
    {
        $this->info('Installing domainsubdomain...');

        $this->info('Publishing configuration...');

        if (!$this->configExists('domainsubdomain.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('Installed domainsubdomain');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Jmrashed\DomainSubdomain\DomainSubdomainServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
    }
}
