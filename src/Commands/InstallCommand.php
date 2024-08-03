<?php

namespace Naykel\Pageit\Commands;

use Illuminate\Console\Command;
use Naykel\Gotime\Facades\FileManagement as FMS;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'pageit:install {--L|local : Indicates if components and views support should be published}';

    /**
     * The console command description.
     */
    protected $description = 'Install Pageit resources';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->addContentStorageDisk();

        return Command::SUCCESS;
    }

    public function addContentStorageDisk()
    {
        if (!FMS::stringInFile('./config/filesystems.php', "'content' => [")) {
            FMS::replaceInFile(
                "'disks' => [",
                "'disks' => [\n\n\t\t" .
                    "'content' => [\n" .
                    "\t\t\t'driver' => 'local',\n" .
                    "\t\t\t'root' => storage_path('app/public/content'),\n" .
                    "\t\t\t'url' => env('APP_URL') . '/storage/content',\n" .
                    "\t\t\t'visibility' => 'public',\n" .
                    "\t\t],",
                './config/filesystems.php'
            );
        }
    }
}
