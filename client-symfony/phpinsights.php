<?php

declare(strict_types=1);

return [
    'preset' => 'symfony',
    'exclude' => [
        'src/Kernel.php',
    ],
    'config' => [
        \PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff::class => [
            'lineLimit' => 120,
            'absoluteLineLimit' => 160,
        ],
        \SlevomatCodingStandard\Sniffs\TypeHints\TypeHintDeclarationSniff::class => [
            'allAnnotationsAreUseful' => true,
        ],
    ],
];
