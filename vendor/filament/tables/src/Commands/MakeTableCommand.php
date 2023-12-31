<?php

namespace Filament\Tables\Commands;

use Filament\Support\Commands\Concerns\CanIndentStrings;
use Filament\Support\Commands\Concerns\CanManipulateFiles;
use Filament\Support\Commands\Concerns\CanReadModelSchemas;
use Filament\Support\Commands\Concerns\CanValidateInput;
use Filament\Tables\Commands\Concerns\CanGenerateTables;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeTableCommand extends Command
{
    use CanGenerateTables;
    use CanIndentStrings;
    use CanManipulateFiles;
    use CanReadModelSchemas;
    use CanValidateInput;

    protected $description = 'Create a new Livewire component containing a Filament table';

    protected $signature = 'make:livewire-table {name?} {model?} {--G|generate} {--F|force}';

    public function handle(): int
    {
        $component = (string) str($this->argument('name') ?? $this->askRequired('Name (e.g. `Products/ListProducts`)', 'name'))
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->replace('/', '\\');
        $componentClass = (string) str($component)->afterLast('\\');
        $componentNamespace = str($component)->contains('\\') ?
            (string) str($component)->beforeLast('\\') :
            '';

        $view = str($component)
            ->replace('\\', '/')
            ->prepend('Livewire/')
            ->explode('/')
            ->map(fn ($segment) => Str::lower(Str::kebab($segment)))
            ->implode('.');

        $model = (string) str($this->argument('model') ?? $this->askRequired('Model (e.g. `Product`)', 'model'))
            ->replace('/', '\\');
        $modelClass = (string) str($model)->afterLast('\\');

        $path = (string) str($component)
            ->prepend('/')
            ->prepend(app_path('Livewire/'))
            ->replace('\\', '/')
            ->replace('//', '/')
            ->append('.php');

        $viewPath = resource_path(
            (string) str($view)
                ->replace('.', '/')
                ->prepend('views/')
                ->append('.blade.php'),
        );

        if ((! $this->option('force')) && $this->checkForCollision([$path, $viewPath])) {
            return static::INVALID;
        }

        $this->copyStubToApp('Table', $path, [
            'class' => $componentClass,
            'columns' => $this->indentString($this->option('generate') ? $this->getResourceTableColumns(
                'App\\Models\\' . $model,
            ) : '//', 4),
            'model' => $model,
            'modelClass' => $modelClass,
            'namespace' => 'App\\Livewire' . ($componentNamespace !== '' ? "\\{$componentNamespace}" : ''),
            'view' => $view,
        ]);

        $this->copyStubToApp('TableView', $viewPath);

        $this->info("Successfully created {$component}!");

        return static::SUCCESS;
    }
}
