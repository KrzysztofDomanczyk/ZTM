<?php

$finder = PhpCsFixer\Finder::create()
    ->in(['app', 'domain', 'infrastructure']);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'single_quote' => true,
        'no_unused_imports' => true,
        'no_extra_blank_lines' => true,
        'no_trailing_whitespace' => true,
        'no_whitespace_in_blank_line' => true,
        'braces' => true,
    ])
    ->setFinder($finder);