<?php

declare(strict_types=1);

namespace App\Framework\Component\Maker\Maker;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

final class MakeUseCaseEntity extends AbstractMaker
{
    private const SRC_CLASSES_WITH_PACKAGE   = [
        'Entity'          => 'Entities',
        'EntityFactory'   => 'Entities',
        'EntityGateway'   => 'Gateways',
        'UseCase'         => 'UseCases',
        'UseCaseRequest'  => 'Requestors',
        'UseCaseResponse' => 'Responders',
    ];

    private const TESTS_CLASSES_WITH_PACKAGE = [
        'InMemoryEntityGateway' => 'Gateways',
        'UseCaseTest'           => 'UseCases',
    ];

    public static function getCommandName(): string
    {
        return 'make:use-case-entity';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConfig)
    {
        $nameDescription = 'The name of the use-case class (e.g. <fg=yellow>BlogPost</>)';
        $moduleDescription = 'The name of the module where the entity will be located';
        $useCasePrefixDescription = 'The prefix will be added in front of the Entity name to create the use case name';
        $missingClassDescription = 'Select the missing class to generate';
        $command
            ->setDescription('create a new use-case classes')
            ->addArgument('name', InputArgument::OPTIONAL, $nameDescription)
            ->addArgument('module', InputArgument::OPTIONAL, $moduleDescription)
            ->addArgument('prefix', InputArgument::OPTIONAL, $useCasePrefixDescription)
            ->addArgument('missing-class', InputArgument::OPTIONAL, $missingClassDescription)
            ->setHelp(file_get_contents(__DIR__ . '/../Resources/help/MakeUseCaseEntity.txt'));

        $inputConfig->setArgumentAsNonInteractive('name');
        $inputConfig->setArgumentAsNonInteractive('module');
        $inputConfig->setArgumentAsNonInteractive('prefix');
        $inputConfig->setArgumentAsNonInteractive('missing-class');
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

        if (!$input->getArgument('prefix')) {
            $argument = $command->getDefinition()->getArgument('prefix');
            $question = new Question($argument->getDescription(), $input->getArgument('prefix'));
            $value = $io->askQuestion($question);

            $input->setArgument('prefix', $value);
        }

        if (!$input->getArgument('missing-class')) {
            $choices = \array_keys(\array_merge(self::SRC_CLASSES_WITH_PACKAGE, self::TESTS_CLASSES_WITH_PACKAGE));
            $argument = $command->getDefinition()->getArgument('missing-class');
            $question = new ChoiceQuestion($argument->getDescription(), $choices, null);
            $value = $io->askQuestion($question);

            $input->setArgument('missing-class', $value);
        }
    }

    public function configureDependencies(DependencyBuilder $dependencies): void
    {
    }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator): void
    {
        $entityName = $input->getArgument('name');
        $moduleName = $input->getArgument('module');
        $prefix = $input->getArgument('prefix');
        $missingClass = $input->getArgument('missing-class');

        $variables = ['module' => $moduleName, 'entity_name' => $entityName, 'prefix' => $prefix];
        $this->generateSrcClasses($generator, $prefix, $moduleName, $entityName, $variables, $missingClass);
        $this->generateTestsClasses($generator, $prefix, $moduleName, $entityName, $variables, $missingClass);

        $generator->writeChanges();

        $this->writeSuccessMessage($io);

        $io->text('Next: Open your use-case and add your code.');
    }

    private function generateSrcClasses(
        Generator $generator,
        string $prefix,
        string $moduleName,
        string $entityName,
        array $variables,
        ?string $missingClass
    ): void {
        foreach ($this->getSrcClassToGenerate($missingClass) as $class => $package) {
            $prefix = $this->getClassNamePrefix($package, $prefix);
            $suffix = $this->getClassNameSuffix($class);

            $generator->generateClass(
                "App\\BusinessRules\\{$moduleName}\\{$package}\\{$prefix}{$entityName}{$suffix}",
                __DIR__ . "/../Resources/skeleton/module/{$class}.tpl.php",
                $variables
            );
        }
    }

    private function getSrcClassToGenerate(?string $missingClass): array
    {
        return $this->getClassToGenerate($missingClass, self::SRC_CLASSES_WITH_PACKAGE);
    }

    private function getClassToGenerate(?string $missingClass, array $classesToGenerate): array
    {
        if (null !== $missingClass && \array_key_exists($missingClass, $classesToGenerate)) {
            $classesToGenerate = [$missingClass, $classesToGenerate[$missingClass]];
        }

        return $classesToGenerate;
    }

    private function getClassNamePrefix($package, string $default): string
    {
        return in_array($package, ['UseCases', 'Requestors']) ? $default : '';
    }

    private function getClassNameSuffix(string $class): string
    {
        return preg_replace('/(Entity|UseCase)/', '', $class);
    }

    private function generateTestsClasses(
        Generator $generator,
        string $prefix,
        string $moduleName,
        string $entityName,
        array $variables,
        ?string $missingClass
    ): void {
        foreach ($this->getTestsClassToGenerate($missingClass) as $class => $package) {
            $prefix = $this->getClassNamePrefix($package, $prefix);
            $suffix = $this->getClassNameSuffix($class);

            $generator->generateFile(
                "tests/BusinessRules/{$moduleName}/{$package}/{$prefix}{$entityName}{$suffix}.php",
                __DIR__ . "/../Resources/skeleton/module/{$class}.tpl.php",
                $variables
            );
        }
    }

    private function getTestsClassToGenerate(?string $missingClass): array
    {
        return $this->getClassToGenerate($missingClass, self::TESTS_CLASSES_WITH_PACKAGE);
    }
}
