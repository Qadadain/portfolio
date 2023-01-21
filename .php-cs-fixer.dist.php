<?php

$finder = (new PhpCsFixer\Finder())
    ->in(dirs: __DIR__)
    ->exclude(dirs: 'node_modules')
    ->exclude(dirs: 'var')
    ->exclude(dirs: 'vendor')
;

return (new PhpCsFixer\Config())
    ->setRules(rules: [
        '@Symfony' => true,
        '@PSR12' => true,
        'phpdoc_align' => [
            'tags' => ['param', 'property', 'property-read', 'property-write', 'return', 'throws', 'type', 'var', 'method'],
            'align' => 'left',
        ],
        'trailing_comma_in_multiline' => [
            'elements' => ['arrays', 'arguments', 'parameters'],
            'after_heredoc' => true,
        ],
    ])
    ->setFinder(finder: $finder)
    ;
