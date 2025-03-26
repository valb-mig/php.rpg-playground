<?php
$finder = (new PhpCsFixer\Finder())
    ->in(['src', 'tests']);

return (new PhpCsFixer\Config())
        ->setRules([
                '@PSR12' => true,
                'strict_param' => true,
                'declare_strict_types' => true,
                'single_quote' => true
        ])
        ->setLineEnding("\n")
        ->setFinder($finder);
