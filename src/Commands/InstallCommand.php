<?php

namespace Naykel\Pageit\Commands;

use Illuminate\Console\Command;

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

        // Create content disk
        if (!$this->stringInFile('./config/filesystems.php', "'content' => [")) {

            $this->replaceInFile(
                "'disks' => [",
                "'disks' => [" . "\r\r\t\t" .
                    "'content' => [
            'driver' => 'local',
            'root' => storage_path('app/public/content'),
            'url' => env('APP_URL') . '/storage/content',
            'visibility' => 'public',
        ],",
                './config/filesystems.php'
            );
        }

        return Command::SUCCESS;
    }

        /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }

    /**
     * A given string exists within a given file.
     *
     * @param string $path
     * @param string $search
     * @return bool
     */
    protected function stringInFile($path, $search)
    {
        return str_contains(file_get_contents($path), $search);
    }
}
