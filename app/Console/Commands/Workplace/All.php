<?php

namespace App\Console\Commands\Workplace;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class All extends Command
{
    const FOLDERS = [
        'Repositories',
        'Entities',
        'Services'
    ];

    protected $signature = 'workplace:all {table_name}';

    protected $description = 'create Entity, ReadRepository, Service';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = $this->argument('table_name');

        if (!Schema::getColumnListing($table)) {
            $this->error("$table table not found");
            return false;
        }

        $columns = $this->getTableColumnAndTypeList($table);
        $className = $this->generateClassName($table);

        $pathName = dirname(__DIR__, 3) . "\Domain\\$className";

        try {
            foreach (self::FOLDERS as $folder)
                $this->createDirectory("$pathName/$folder");

            $this->generateEntity($pathName, $className, $table, $columns);
            $this->generateUseCase($pathName, $className, $table);
            $this->generateRepository($pathName, $className, $table);
            $this->generateReadRepository($pathName, $className, $table);

        } catch (Exception $e) {
            $this->error($e->getMessage());
        }

        $this->info("generate complete;");
        return true;
    }

    protected function generateClassName(string $table): string
    {
        $table = ucfirst($table);

        if (preg_match('/[-_]/', $table))
            $table = implode('', array_map(function ($item) {
                return ucfirst($item);
            }, preg_split('/(-|_)/', $table)));

        if (substr($table, -3) === 'ies')
            $table = substr($table, 0, -3) . 'y';

        elseif (substr($table, -1) === 's')
            $table = substr($table, 0, -1);

        return $table;
    }

    protected function generateEntity(string $pathName, string $className, string $table, array $columns = null): void
    {
        $pathName .= "/Entities/$className.php";
        $handle = fopen($pathName, 'w') or die("Cannot open file: $pathName");
        $data = "<?php\n\nnamespace App\Domain\\$className\Entities;\n\n";
        $data .= "use Eloquent;\n\n";

        if ($columns)
            $data = $this->generatePropertyComments($data, $columns);

        $data .= "class $className extends Eloquent\n{\n";
        $data .= "\t protected \$table = '$table';\n}";

        fwrite($handle, $data);
        fclose($handle);
    }

    protected function generateUseCase(string $pathName, string $className, string $table): void
    {
        $repository = $className . 'Repository';
        $service = $className . 'Service';
        $pathName .= "/UseCases/$service.php";
        $handle = fopen($pathName, 'w') or die("Cannot open file: $pathName");
        $data = "<?php\n\nnamespace App\Domain\\$className\UseCases;\n\n";
        $data .= "use App\Domain\\$className\Repositories\\$repository;\n\n";

        $data = $this->generatePropertyComments($data, [$table => $repository]);

        $data .= "class $service\n{\n";
        $data .= "\tpublic $$table;\n\n";
        $data .= "\tpublic function __construct($repository \$repository)\n\t{\n";
        $data .= "\t\t\$this->$table = \$repository;\n";
        $data .= "\t}\n";
        $data .= "}";

        fwrite($handle, $data);
        fclose($handle);
    }

    protected function generateRepository(string $pathName, string $className, string $table): void
    {
        $classNameRepository = $className . 'Repository';
        $pathName .= "/Repositories/$classNameRepository.php";
        $handle = fopen($pathName, 'w') or die("Cannot open file: $pathName");
        $data = "<?php\n\nnamespace App\Domain\\$className\Repositories;\n\n";
        $data .= "use App\Domain\\$className\Entities\\$className;\n\n";

        $data = $this->generatePropertyComments($data, [$table => $className]);

        $data .= "class $classNameRepository\n{\n";
        $data .= "\tpublic $$table;\n\n";
        $data .= "\tpublic function __construct($className \$entity)\n\t{\n";
        $data .= "\t\t\$this->$table = \$entity;\n";
        $data .= "\t}\n";
        $data .= "}";

        fwrite($handle, $data);
        fclose($handle);
    }

    protected function generateReadRepository(string $pathName, string $className, string $table): void
    {
        $classNameRepository = $className . 'ReadRepository';
        $pathName .= "/Repositories/$classNameRepository.php";
        $handle = fopen($pathName, 'w') or die("Cannot open file: $pathName");
        $data = "<?php\n\nnamespace App\Domain\\$className\Repositories;\n\n";
        $data .= "use App\Domain\\$className\Entities\\$className;\n\n";

        $data = $this->generatePropertyComments($data, [$table => $className]);

        $data .= "class $classNameRepository\n{\n";
        $data .= "\tpublic $$table;\n\n";
        $data .= "\tpublic function __construct($className \$entity)\n\t{\n";
        $data .= "\t\t\$this->$table = \$entity;\n";
        $data .= "\t}\n";
        $data .= "}";

        fwrite($handle, $data);
        fclose($handle);
    }

    protected function getTableColumnAndTypeList($tableName, $fullType = false): ?array
    {
        $fieldAndTypeList = [];
        foreach (DB::select("describe $tableName") as $field) {
            $type = ($fullType || !str_contains($field->Type, '(')) ? $field->Type : substr($field->Type, 0, strpos($field->Type, '('));
            $type = preg_match('/tinyint/', $type) ? 'boolean' : $type;
            $type = preg_match('/int/', $type) ? 'int' : $type;
            $type = preg_match('/double/', $type) ? 'float' : $type;
            $type = preg_match('/varchar/', $type) ? 'string' : $type;
            $type = preg_match('/timestamp/', $type) ? '\Carbon\Carbon' : $type;
            $fieldAndTypeList[$field->Field] = $type;
        }
        return $fieldAndTypeList;
    }

    protected function generatePropertyComments(string $data, array $columns): string
    {
        $data .= "/**\n";

        foreach ($columns as $column => $type)
            $data .= " * @property $type $" . $column . "\n";

        $data .= " */\n";

        return $data;
    }

    protected function createDirectory(string $directory): void
    {
        if (!is_dir($directory))
            mkdir($directory, 0777, true);
    }
}
