<?= "<?php\n" ?>

declare(strict_types=1);

namespace <?= $namespace ?>;

use <?= $bounced_class_namespace ?>;
use App\ViewModels\ViewModelHydrator;

class <?= $class_name ?><?= "\n" ?>
{
<?php foreach ($properties as $property => $typeOptions): ?>
    <?php if ($typeOptions['allowsNull']): ?>
        public ?<?= $typeOptions['type'] ?> $<?= $property ?>;
    <?php else: ?>
        public <?= $typeOptions['type'] ?> $<?= $property ?>;
    <?php endif; ?>
<?php endforeach; ?>

public static function create(<?= $bounced_class_name ?> $<?= lcfirst($bounced_class_name) ?>): self
{
$viewModel = new self();
ViewModelHydrator::hydrate($viewModel, $<?= lcfirst($bounced_class_name) ?>);

return $viewModel;
}
}
