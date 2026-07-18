<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {modelName} {--namespace=} {--api=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'it takes modelName required , namespace & api  are optional params for web / api controllers & requests';

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
        $ds = DIRECTORY_SEPARATOR;
        $name = $this->argument('modelName');
        $modelObject = Str::camel($name);
        $modelName = ucfirst($modelObject);
        $webNamespace = $this->option('namespace');
        $apiNamespace = $this->option('api');

        $this->info($this->createRepository($modelName, $ds));
        $this->info($this->createContract($modelName, $ds));
        $this->info($this->createController($modelName, $ds, $modelObject, $webNamespace,
            $apiNamespace));
        $this->info($this->createApiController($modelName, $ds, $modelObject, $apiNamespace));
        $this->info($this->createRequest($modelName, $ds, $webNamespace));
        $this->info($this->createApiRequest($modelName, $ds, $apiNamespace));
        $this->info($this->createResource($modelName, $ds));
    }


    public function createRepository($modelName, $ds)
    {
        $template = file_get_contents(__DIR__ . $ds . '/repositoryFilesTemplate/RepositoryTemplate.stub');

        $templateClass = $this->replaceTemplateContent($template, $modelName);

        $directory = $this->getRepositoriesPath();

        $this->makeDirectory($directory . 'SQL');

        $filePath = $directory . 'SQL';
        $fileName = $modelName . 'Repository' . '.php';

        return $this->saveTemplateCopy($filePath, $fileName, $ds, $templateClass);
    }

    public function createContract($modelName, $ds)
    {
        $template = file_get_contents(__DIR__ . $ds . '/repositoryFilesTemplate/ContractTemplate.stub');

        $templateClass = $this->replaceTemplateContent($template, $modelName);

        $directory = $this->getRepositoriesPath();

        $this->makeDirectory($directory . 'Contracts');

        $filePath = $directory . 'Contracts';
        $fileName = $modelName . 'Contract' . '.php';

        return $this->saveTemplateCopy($filePath, $fileName, $ds, $templateClass);
    }

    public function createController($modelName, $ds, $modelObject, $webNamespace = null,$apiNamespace=null)
    {
        $template = file_get_contents(__DIR__ . $ds . '/repositoryFilesTemplate/ControllerTemplate.stub');

        $templateClass = $this->replaceTemplateContent($template, $modelName, $webNamespace, $modelObject,$apiNamespace);

        $directory = $this->getControllerPath($webNamespace);

        $this->makeDirectory($directory);

        $fileName = $modelName . 'Controller' . '.php';

        return $this->saveTemplateCopy($directory, $fileName, $ds, $templateClass);
    }

    public function createApiController($modelName, $ds, $modelObject, $webNamespace = null)
    {
        $template = file_get_contents(__DIR__ . $ds . '/repositoryFilesTemplate/ApiControllerTemplate.stub');

        $templateClass = $this->replaceTemplateContent($template, $modelName, $webNamespace, $modelObject);

        $directory = $this->getApiControllerPath($webNamespace);

        $this->makeDirectory($directory);

        $fileName = $modelName . 'Controller' . '.php';

        return $this->saveTemplateCopy($directory, $fileName, $ds, $templateClass);
    }

    public function createRequest($modelName, $ds, $webNamespace = null)
    {
        $template = file_get_contents(__DIR__ . $ds . '/repositoryFilesTemplate/RequestTemplate.stub');

        $templateClass = $this->replaceTemplateContent($template, $modelName, $webNamespace);

        $directory = $this->getRequestPath($webNamespace);

        $this->makeDirectory($directory);

        $fileName = $modelName . 'Request' . '.php';

        return $this->saveTemplateCopy($directory, $fileName, $ds, $templateClass);
    }

    public function createApiRequest($modelName, $ds, $webNamespace = null)
    {
        $template = file_get_contents(__DIR__ . $ds . '/repositoryFilesTemplate/ApiRequestTemplate.stub');

        $templateClass = $this->replaceTemplateContent($template, $modelName, $webNamespace);

        $directory = $this->getApiRequestPath($webNamespace);

        $this->makeDirectory($directory);

        $fileName = $modelName . 'Request' . '.php';

        return $this->saveTemplateCopy($directory, $fileName, $ds, $templateClass);
    }

    public function createResource($modelName, $ds)
    {
        $template = file_get_contents(__DIR__ . $ds . '/repositoryFilesTemplate/ApiResourceTemplate.stub');

        $templateClass = $this->replaceTemplateContent($template, $modelName);

        $directory = $this->getResourcePath();

        $this->makeDirectory($directory);

        $fileName = $modelName . 'Resource' . '.php';

        return $this->saveTemplateCopy($directory, $fileName, $ds, $templateClass);
    }

    public function replaceTemplateContent($template, $modelName, $webNamespace = null, $modelObject = null,$apiNamespace=null)
    {
        $search = [
            '{{modelName}}',
            '{{namespace}}',
            '{{modelObject}}',
            '{{apiNamespace}}'
        ];
        $replace = [
            $modelName,
            (isset($webNamespace) && $webNamespace) ? '\\' . str_replace('/', '\\', $webNamespace) : '',
            isset($modelObject) ? $modelObject : '',
            (isset($apiNamespace) && $apiNamespace) ? '\\' . str_replace('/', '\\', $apiNamespace) : '',

        ];

        return str_replace($search, $replace, $template);
    }

    public function getRepositoriesPath()
    {
        $ds = DIRECTORY_SEPARATOR;
        $appBase = app_path() . $ds;
        $repositoriesNamespace = 'Repositories' . $ds;

        $path = $appBase . $repositoriesNamespace;
        return $path;
    }

    public function getControllerPath($webNamespace = null)
    {
        $ds = DIRECTORY_SEPARATOR;
        $appBase = app_path() . $ds;
        $controllerNamespace = 'Http' . $ds . 'Controllers' . $ds;

        $path = $appBase . $controllerNamespace . $webNamespace;
        return $path;
    }

    public function getApiControllerPath($webNamespace = null)
    {
        $ds = DIRECTORY_SEPARATOR;
        $appBase = app_path() . $ds;
        $controllerNamespace = 'Http' . $ds . 'Controllers' . $ds . 'Api' . $ds;

        $path = $appBase . $controllerNamespace . $webNamespace;
        return $path;
    }

    public function getRequestPath($webNamespace = null)
    {
        $ds = DIRECTORY_SEPARATOR;
        $appBase = app_path() . $ds;
        $requestNamespace = 'Http' . $ds . 'Requests' . $ds;

        $path = $appBase . $requestNamespace . $webNamespace;
        return $path;
    }

    public function getApiRequestPath($webNamespace = null)
    {
        $ds = DIRECTORY_SEPARATOR;
        $appBase = app_path() . $ds;
        $requestNamespace = 'Http' . $ds . 'Requests' . $ds . 'Api' . $ds;

        $path = $appBase . $requestNamespace . $webNamespace;
        return $path;
    }

    public function getResourcePath()
    {
        $ds = DIRECTORY_SEPARATOR;
        $appBase = app_path() . $ds;
        $requestNamespace = 'Http' . $ds . 'Resources' . $ds;

        $path = $appBase . $requestNamespace;
        return $path;
    }

    public function makeDirectory($directory)
    {
        if (!is_dir($directory)) {
            return mkdir($directory, 0755, true);
        }
        return null;
    }

    public function saveTemplateCopy($filePath, $fileName, $ds, $template)
    {
        file_put_contents($filePath . $ds . $fileName, $template);
        return $fileName . ' has been created';
    }
}
