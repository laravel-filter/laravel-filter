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
    public $filter_name;
    public $type;
    public $second;
    public $relation;
    public $first;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->filter_name = $this->argument('filter');
        $this->type = $this->option('type');
        $this->second = $this->option('second');
        $this->relation = $this->option('relation');
        $this->first = $this->argument('first');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        switch ($this->type) {
            case 'between':
                $this->makeTextFilter();
                break;
            case 'like':
                $this->makeSelectFilter();
                break;
            case 'relation':
                $this->makeDateFilter();
                break;
            default:
                $this->makeTextFilter();
                break;
        }

        if ($this->type === 'between') {
            if ($this->second == null || $this->first == null) {
                return $this->error("You should pass first and second options!");
            } else {
                $apply_type = $this->type;

            }
        }
        if ($this->type === 'like') {
            $apply_type = $this->type;
        }
        if ($this->type === 'relation') {
            if ($this->relation === null) {
                return $this->error("in relation type you should insert --relation=relationName");
            }
            $apply_type = $this->type;

        }


        $file = "{$this->classNaming($this->type, $this->filter_name, $this->second)}.php";
        $path = app_path();
        $file = $path."/QueryFilters/$file";
        $composerDir = $path."/QueryFilters";

        if (!is_dir($composerDir)) {
            mkdir($composerDir, 0775);
        }
        if (file_exists($file)) {
            return $this->error("$file already exist!");
        } else {
            file_put_contents($file, $contents);
            $this->info("$this->filter_name generated!");
        }

    }


    public function classNaming($apply_type, $filter_name, $second)
    {
        if ($apply_type == null) {
            return $filter_name;
        } else {
            return strtolower($apply_type).$filter_name.$second;
        }

    }
}
