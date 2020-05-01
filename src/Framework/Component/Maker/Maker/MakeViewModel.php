<?php

declare(strict_types=1);

namespace App\Framework\Component\Maker\Maker;

use App\Framework\Component\Maker\ClassDetails;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

final class MakeViewModel extends AbstractMaker
{
    private const VIEW_MODEL_SUFFIX = 'ViewModel';

    public static function getCommandName(): string
    {
        return 'make:view-model';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConfig): void
    {
        $nameDescription = 'The name of the  view-model class (e.g. <fg=yellow>BlogPostViewModel</>)';
        $boundClassDescription = 'The name of the interface or model class name that the new view model will be bounced to (empty for none)';
        $command
            ->setDescription('create a new view-model class')
            ->addArgument('name', InputArgument::OPTIONAL, $nameDescription)
            ->addArgument('bounced-class', InputArgument::OPTIONAL, $boundClassDescription)
            ->setHelp(file_get_contents(__DIR__ . '/../Resources/help/MakeViewModel.txt'));
    }

    public function configureDependencies(DependencyBuilder $dependencies): void
    {
    }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator): void
    {
        $viewModelClassNameDetails = $generator->createClassNameDetails(
            $input->getArgument('name'),
            'ViewModels\\',
            self::VIEW_MODEL_SUFFIX
        );

        $bouncedClass = $input->getArgument('bounced-class');

        $bouncedClassDetails = new ClassDetails($bouncedClass);

        $generator->generateClass(
            $viewModelClassNameDetails->getFullName(),
            __DIR__ . '/../Resources/skeleton/view-model/ViewModel.tpl.php',
            [
                'properties'              => $bouncedClassDetails->getProperties(),
                'bounced_class_namespace' => $bouncedClassDetails->getFullName(),
                'bounced_class_name'      => $bouncedClassDetails->getShortName(),
            ]
        );

        $generator->writeChanges();

        $this->writeSuccessMessage($io);

        $io->text('Next: Open your view-model and add your code.');
    }
}
