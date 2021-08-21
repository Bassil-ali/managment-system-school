<?php

namespace Livewire\Commands;

use Illuminate\Support\Facades\File;

class MakeCommand extends FileManipulationCommand
{
    protected $signature = 'livewire:make {name} {--force} {--inline}';

    protected $description = 'Create a new Livewire component';

    public function handle()
    {
        $this->parser = new ComponentParser(
            config('livewire.class_namespace'),
            config('livewire.view_path'),
            $this->argument('name')
        );

        if($this->isReservedClassName($name = $this->parser->className())) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS! </> 😳 \n");
            $this->line("<fg=red;options=bold>Class is reserved:</> {$name}");
            return;
        }

        $force = $this->option('force');
        $inline = $this->option('inline');

        $showWelcomeMessage = $this->isFirstTimeMakingAComponent();

        $class = $this->createClass($force, $inline);
        $view = $this->createView($force, $inline);

        $this->refreshComponentAutodiscovery();

        if($class || $view) {
            $this->line("<options=bold,reverse;fg=green> COMPONENT CREATED </> 🤙\n");
            $class && $this->line("<options=bold;fg=green>CLASS:</> {$this->parser->relativeClassPath()}");

            if (! $inline) {
                $view && $this->line("<options=bold;fg=green>VIEW:</>  {$this->parser->relativeViewPath()}");
            }

            if ($showWelcomeMessage && ! app()->environment('testing')) {
                $this->writeWelcomeMessage();
            }
        }
    }

    protected function createClass($force = false, $inline = false)
    {
        $classPath = $this->parser->classPath();

        if (File::exists($classPath) && ! $force) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS-IE-TOOTLES </> 😳 \n");
            $this->line("<fg=red;options=bold>Class already exists:</> {$this->parser->relativeClassPath()}");

            return false;
        }

        $this->ensureDirectoryExists($classPath);

        File::put($classPath, $this->parser->classContents($inline));

        return $classPath;
    }

    protected function createView($force = false, $inline = false)
    {
        if ($inline) {
            return false;
        }
        $viewPath = $this->parser->viewPath();

        if (File::exists($viewPath) && ! $force) {
            $this->line("<fg=red;options=bold>View already exists:</> {$this->parser->relativeViewPath()}");

            return false;
        }

        $this->ensureDirectoryExists($viewPath);

        File::put($viewPath, $this->parser->viewContents());

        return $viewPath;
    }

    public function isReservedClassName($name)
    {
        return array_search($name, ['Parent', 'Component', 'Interface']) !== false;
    }
}
