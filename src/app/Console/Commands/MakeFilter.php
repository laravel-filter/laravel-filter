<?php

namespace laravelFilter\filter\app\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeFilter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filter {filter} {first} {--type=} {--second=} {--relation=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create    a   new     filter.';
    /**
     * @var string
     */
    public $filter_name;
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
     */
    public $second;
    /**
     * @var string
     */
    public $relation;
    /**
     * @var string
     */
    public $first;
    /**
     * @var string
     */
    public $content;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->filter_name = $this->argument('filter');
        $this->type = $this->option('type');
        $this->second = $this->option('second');
        $this->relation = $this->option('relation');
        $this->first = $this->argument('first');
        $this->generateClass();
    }

    private function generateClass()
    {
        switch ($this->type) {
            case 'between':

                break;
            case 'like':

                break;
            case 'relation':

                break;
            default:

                break;
        }

        $this->generateFile();

    }

    /**
     *
     */
    private function generateFile()
    {
        $file = "{$this->classNaming($this->type, $this->filter_name, $this->second)}.php";
        $path = app_path();
        $file = $path.DIRECTORY_SEPARATOR."QueryFilters".DIRECTORY_SEPARATOR.$file;
        $composerDir = $path.DIRECTORY_SEPARATOR."QueryFilters";

        if (!is_dir($composerDir)) {
            mkdir($composerDir, 0775);
        }
        if (file_exists($file)) {
            return $this->error("$file already exist!");
        } else {
            file_put_contents($file, 'tetst'/*$this->content*/);
            $this->info("$this->filter_name generated!");
        }
    }
}
