<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $ecsConfig): void {
    // A. full sets
    $ecsConfig->sets([
        SetList::COMMON,
        SetList::CLEAN_CODE,
        SetList::PSR_12
    ]);

    // TODO: Skipping Rules for now
    $ecsConfig->skip([
        // Rule Set Skip from COMMON
        PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer::class,            // Unnecessary tag checking

        // Rule Set Skip
        PhpCsFixer\Fixer\Operator\ConcatSpaceFixer::class,
        PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer::class,
        PhpCsFixer\Fixer\Phpdoc\PhpdocNoEmptyReturnFixer::class,
        PhpCsFixer\Fixer\Phpdoc\PhpdocTrimFixer::class,
        PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer::class,

        // Rule Set Skip from PHP_CS_FIXER
        PhpCsFixer\Fixer\Basic\BracesFixer::class,
        PhpCsFixer\Fixer\ClassNotation\SingleTraitInsertPerStatementFixer::class,
        PhpCsFixer\Fixer\LanguageConstruct\SingleSpaceAfterConstructFixer::class,
    ]);

    // Adding Specific rule, Disabled for now
//    $ecsConfig->rules([
//        PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer::class,
//        PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer::class,
//        PhpCsFixer\Fixer\Basic\BracesFixer::class,
//    ]);

    // B. standalone rule
    $ecsConfig->ruleWithConfiguration(ArraySyntaxFixer::class, [
        'syntax' => 'short',
    ]);
};
