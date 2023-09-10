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

        // Rule Set Skip
//        PhpCsFixer\Fixer\Operator\ConcatSpaceFixer::class,
//        PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer::class,
        PhpCsFixer\Fixer\Phpdoc\PhpdocNoEmptyReturnFixer::class,
//        PhpCsFixer\Fixer\Phpdoc\PhpdocTrimFixer::class,
//        PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer::class,

        // Rule Set Skip from COMMON
//        PhpCsFixer\Fixer\CastNotation\CastSpacesFixer::class,                   // Always add space after casting
//        PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer::class,
        PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer::class,                  // I want to use Yoda - Skip for now
//        PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer::class, // Always add comma at the end
//        PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer::class,
//        PhpCsFixer\Fixer\Phpdoc\NoEmptyPhpdocFixer::class,
//        PhpCsFixer\Fixer\Phpdoc\PhpdocSeparationFixer::class,
        PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer::class,            // Unnecessary tag checking
//        PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer::class,                // Always use Single quote over Double
//        PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer::class,
//        PhpCsFixer\Fixer\Whitespace\LineEndingFixer::class,                       // Skip, Always use LF for line ending
//        PhpCsFixer\Fixer\Whitespace\NoWhitespaceInBlankLineFixer::class,          // No whitespace in blank lines(end)
//        PhpCsFixer\Fixer\Whitespace\SingleBlankLineAtEofFixer::class,             // Always add a blank line at the eof
//        Symplify\CodingStandard\Fixer\ArrayNotation\ArrayOpenerAndCloserNewlineFixer::class, // Skip for now
//
//        // Rule Set Skip from PHP_CS_FIXER
//        PhpCsFixer\Fixer\Basic\BracesFixer::class,
//        PhpCsFixer\Fixer\NamespaceNotation\BlankLineAfterNamespaceFixer::class,
        PhpCsFixer\Fixer\ClassNotation\SingleTraitInsertPerStatementFixer::class,
//        PhpCsFixer\Fixer\LanguageConstruct\SingleSpaceAfterConstructFixer::class,
//        PhpCsFixer\Fixer\Operator\IncrementStyleFixer::class,   // Disable post/pre increment checking
//        PhpCsFixer\Fixer\PhpUnit\PhpUnitInternalClassFixer::class,
//        PhpCsFixer\Fixer\Phpdoc\PhpdocAlignFixer::class,
//        PhpCsFixer\Fixer\Phpdoc\AlignMultilineCommentFixer::class,
//        PhpCsFixer\Fixer\Phpdoc\NoBlankLinesAfterPhpdocFixer::class,
//        PhpCsFixer\Fixer\Phpdoc\PhpdocNoPackageFixer::class,    // Removes @package tag - Skip for now
//        PhpCsFixer\Fixer\Phpdoc\PhpdocSummaryFixer::class,      // Period at the end - Skip for now
//        PhpCsFixer\Fixer\Phpdoc\PhpdocToCommentFixer::class,    // Allow doc to comment
//        PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer::class,
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
