<?php

namespace msztorc\LaravelEnv\Commands;

use InvalidArgumentException;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use msztorc\LaravelEnv\Env;
use msztorc\LaravelEnv\Commands\Traits\CommandValidator;

class EnvDelCommand extends Command
{

    use CommandValidator;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:del {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete variable from an environment file';

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
        $key = $this->argument('key');

        if (!is_null($key))
            $this->isValidKey($key);

        $env = new Env();
        if (!$env->exists($key))
            return $this->info("There is no exists variable {$key}");

        $env->deleteVariable($key);

        return $this->info("Variable {$key} has been deleted");
    }

}