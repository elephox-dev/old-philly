<?php
declare(strict_types=1);

namespace Philly\Foundation\CLI\Commands;

use JetBrains\PhpStorm\Pure;
use Philly\CLI\Commands\Command;
use Philly\CLI\Commands\CommandArgumentTemplate;
use Philly\CLI\Commands\CommandResult;
use Philly\CLI\Commands\CommandSignature;
use Philly\Container\Collection;
use Philly\Contracts\CLI\Commands\CommandArgumentCollection as CommandArgumentCollectionContract;
use Philly\Contracts\CLI\Commands\CommandResult as CommandResultContract;
use Philly\Exceptions\FileNotFoundException;
use Philly\Exceptions\NullReferenceException;
use Philly\Support\Str;
use ricardoboss\Console;

/**
 * Class CreateCommandCommand.
 */
class CreateCommandCommand extends Command
{
    public function __construct()
    {
        parent::__construct(new CommandSignature(
            "create:command",
            [
                new CommandArgumentTemplate("name"),
                new CommandArgumentTemplate("short", optional: true),
                new CommandArgumentTemplate("args", optional: true),
                new CommandArgumentTemplate("namespace", optional: true, default: "App\\CLI\\Commands"),
                new CommandArgumentTemplate("classname", optional: true),
                new CommandArgumentTemplate("stub", optional: true, default: __DIR__."/stubs/Command.php.stub"),
                new CommandArgumentTemplate("dest", optional: true, default: "src/App/CLI/Commands/")
            ]
        ));
    }

	/**
	 * @inheritDoc
	 */
	public function handle(CommandArgumentCollectionContract $args): CommandResultContract
	{
	    /** @var string $name */
        $name = $args->getValue('name');
        Console::debug("Command name: %s", $name);

        /** @var string $namespace */
        $namespace = $args->getValue('namespace');
        Console::debug("Namespace: %s", $namespace);

        /** @var string[] $arg_names */
        $arg_names = (new Collection(explode(",", $args->getValue("args") ?? "")))
            ->where(fn($v) => strlen($v) > 0) // filter empty args
            ->asArray();
        Console::debug("Arg names: [%s]", implode(', ', $arg_names));

        /** @var string $classname */
        $classname = $args->getValue("classname") ?? ucfirst(Str::camel($name));
        if (!Str::endsWith($classname, "Command"))
            $classname .= "Command";

        Console::debug("Classname: %s", $classname);

        /** @var string $stub_path */
        $stub_path = $args->getValue("stub");
        Console::debug("Stub path: %s", $stub_path);

        /** @var string $destination */
        $destination = $args->getValue("dest");
        Console::debug("Destination: %s", $destination);

        try {
            $stub = $this->loadStub($stub_path);

            $stub = Str::replaceAll('$STUB_NAMESPACE', $namespace, $stub);
            $stub = Str::replaceAll('$STUB_CLASS_NAME', $classname, $stub);
            $stub = Str::replaceAll('$STUB_COMMAND_NAME', $name, $stub);

            $signature = $this->generateSignature($name, $arg_names);
            $stub = Str::replaceAll('$STUB_COMMAND_SIGNATURE', $signature, $stub);

            $filename = Str::finish($destination, DIRECTORY_SEPARATOR) . $classname . '.php';
            $success = @file_put_contents($filename, $stub);

            if ($success !== false) {
                return CommandResult::success($filename);
            }

            return CommandResult::fail(new FileNotFoundException("Failed to put contents for new command at $filename."));
        } catch (FileNotFoundException $fileNotFoundException) {
            return CommandResult::fail($fileNotFoundException);
        } catch (NullReferenceException $nullReferenceException) {
            return CommandResult::fail($nullReferenceException);
        }
    }

    /**
     * @throws FileNotFoundException
     * @throws NullReferenceException
     */
	private function loadStub(?string $path): string {
	    if ($path === null)
	        throw new NullReferenceException(var_name: 'path');

	    $p = realpath($path);
	    if ($p === false || !file_exists($p)) {
            throw new FileNotFoundException(path: $path);
        }

        return file_get_contents($path);
    }

    #[Pure] private function generateSignature(string $command, array $arg_names): string {
        $sig = "new CommandSignature(\n            \"$command\"";
        $sig .= ",\n            [";

        foreach ($arg_names as $arg) {
            $sig .= "\n                new CommandArgumentTemplate(\"$arg\"),";
        }

        $sig = Str::replaceLast(",", "", $sig);

        $sig .= "\n            ]";
        $sig .= "\n    )";

        return $sig;
    }
}
