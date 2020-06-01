<?php

declare(strict_types=1);

namespace App\Framework\Component\Maker\Maker;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Bundle\MakerBundle\Str;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

final class MakeUseCaseEntity extends AbstractMaker
{
    public static function getCommandName(): string
    {
        return 'make:use-case-entity';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConfig)
    {
        $nameDescription = 'The name of the use-case class (e.g. <fg=yellow>BlogPost</>)';
        $moduleDescription = 'The name of the module where the entity will be located';
        $crudTypeDescription = 'The type of use case';
        $command
            ->setDescription('create a new use-case classes')
            ->addArgument('name', InputArgument::OPTIONAL, $nameDescription)
            ->addArgument('module', InputArgument::OPTIONAL, $moduleDescription)
            ->addArgument('crud-type', InputArgument::OPTIONAL, $crudTypeDescription)
            ->setHelp(file_get_contents(__DIR__ . '/../Resources/help/MakeUseCaseEntity.txt'));

        $inputConfig->setArgumentAsNonInteractive('name');
        $inputConfig->setArgumentAsNonInteractive('module');
        $inputConfig->setArgumentAsNonInteractive('crud-type');
    }

    public function interact(InputInterface $input, ConsoleStyle $io, Command $command): void
    {
        if (!$input->getArgument('name')) {
            $argument = $command->getDefinition()->getArgument('name');
            $question = new Question($argument->getDescription());
            $value = $io->askQuestion($question);

            $input->setArgument('name', $value);
        }

        if (!$input->getArgument('module')) {
            $argument = $command->getDefinition()->getArgument('module');
            $question = new Question($argument->getDescription(), $input->getArgument('name'));
            $value = $io->askQuestion($question);

            $input->setArgument('module', $value);
        }

        if (!$input->getArgument('crud-type')) {
            $argument = $command->getDefinition()->getArgument('crud-type');
            $question = new ChoiceQuestion($argument->getDescription(), ['Create']);
            $value = $io->askQuestion($question);

            $input->setArgument('crud-type', $value);
        }
    }

    public function configureDependencies(DependencyBuilder $dependencies): void
    {
    }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator): void
    {
        $entityName = $input->getArgument('name');
        $moduleName = $input->getArgument('module');
        $crudType = 'Read' === $input->getArgument('crud-type') ? 'Get' : $input->getArgument('crud-type');

        $variables = ['module' => $moduleName, 'entity_name' => $entityName, 'crud_type' => $crudType,];
        $classesToGenerate = [
            'Entity' => 'Entities',
            'EntityFactory' => 'Entities',
            'EntityGateway' => 'Gateways',
            'UseCase' => 'UseCases',
            'UseCaseRequest' => 'Requestors',
            'UseCaseRequestBuilder' => 'Requestors',
            'UseCaseRequestDTO' => 'UseCases\DTO\Request',
            'UseCaseResponse' => 'Responders',
            'UseCaseResponseAssembler' => 'Responders',
            'UseCaseResponseAssemblerImpl' => 'UseCases\DTO\Response',
            'UseCaseResponseDTO' => 'UseCases\DTO\Response',
            'UseCaseTest' => 'UseCases',
        ];

        foreach ($classesToGenerate as $class => $package) {
            $suffix = preg_replace('/^(Entity|UseCase)/', '', $class);
            $prefix = in_array($package, ['UseCases', 'Requestors', 'UseCases\DTO\Request'])? $crudType : '';

            if ('Test' !== $suffix) {
                $generator->generateClass(
                    "App\\BusinessRules\\{$moduleName}\\{$package}\\{$prefix}{$entityName}{$suffix}",
                    __DIR__ . "/../Resources/skeleton/module/{$class}.tpl.php",
                    $variables
                );
            } else {
                $generator->generateFile(
                    "tests/BusinessRules/{$moduleName}/{$package}/{$prefix}{$entityName}{$suffix}.php",
                    __DIR__ . "/../Resources/skeleton/module/{$class}.tpl.php",
                    $variables
                );
            }
        }

        $generator->writeChanges();

        $this->writeSuccessMessage($io);

        $io->text('Next: Open your use-case and add your code.');
    }
}
