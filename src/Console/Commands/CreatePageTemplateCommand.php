<?php

namespace FurkanGM\FilamentPageManager\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class CreatePageTemplateCommand extends GeneratorCommand
{
    protected $signature = 'make:page-template {name?}';

    protected $name = 'make:page-template';

    protected $description = 'Create page template';

    protected $type = 'Page Template';

    public function handle(): ?bool
    {
        $name = $this->argument('name') ?? $this->ask('What is page template name?');

        $name = str($name)
            ->studly()
            ->beforeLast('Template');

        $className = $this->qualifyClass($name);

        $className .= 'Template';

        if ($this->isReservedName($className)) {
            $this->error('The name "'.$className.'" is reserved by PHP.');

            return false;
        }

        $path = $this->getPath($className);

        if ($this->files->exists($path)) {
            $this->error(basename($className).' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $class = $this->buildClass($className);

        $this->files->put($path, $this->sortImports(str_replace('{{ name }}', $name->lower(), $class)));

        $viewPath = resource_path("views/templates/{$name->lower()}.blade.php");

        if (! file_exists($viewPath)) {
            $this->files->put($viewPath, "// {$name} page template");
        }

        $this->info($this->type.' created successfully.');

        return true;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\\Support\\PageTemplates';
    }

    protected function getStub(): string
    {
        return __DIR__.'/../../../stubs/PageTemplate.stub';
    }
}
