<?php

namespace Goldfinch\Requester\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:request')]
class MakeRequestCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:request';

    protected $description = 'Create new reqeust';

    protected $path = 'app/src/Requests';

    protected $type = 'request';

    protected $stub = './stubs/request.stub';

    protected $prefix = 'Request';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
