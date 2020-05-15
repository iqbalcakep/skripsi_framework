<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Crawl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:crawl {--path=} {--total=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $output = shell_exec('python '.$this->option('path').' '.$this->option('total'));
        // dump($output);
        // $process = Process::fromShellCommandline('python '.$this->option('path'));
        // $process->run(null, []);
        
        // if (!$process->isSuccessful()) {
        //     throw new ProcessFailedException($process);
        // }
        
        $this->info($output);
    }
}
