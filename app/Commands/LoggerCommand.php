<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Filesystem\Filesystem;

class LoggerCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'getlog {loc?} -t {format?}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Read and Convert Log Files';

    protected $files;
    protected $loc;
    protected $format;

    public function __construct(Filesystem $file){
        parent::__construct();
        $this->files=$file;
    }

    public function createFile($file_str){
        $path = getcwd().'/files';
        if(!$this->files->isDirectory($path)){
            $this->files->makeDirectory($path);
        }
        $content = "MyTools Output\nBy Muhammad Ilham A\n\n".$file_str;
        $this->files->put($path.'/output.txt',$content);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $exec=shell_exec('cp -p '.$this->loc.' .');
        $file_str='';
        $this->checkLocation();
        $this->checkFormat();
        $this->createFile($file_str);

        $this->info($exec);
    }

    public function checkLocation(){
        $this->loc = $this->argument('loc');
        if(!$this->argument('loc')){
            $this->loc = $this->ask('Enter Log File Path Directory');
        }
    }

    public function checkFormat(){
        $this->format = $this->argument('format');
        if(!$this->argument('format')){
            $this->format = $this->ask('Enter File Format');
        }
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
