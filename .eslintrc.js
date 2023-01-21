module.exports = {
    root: true,
    env: {
        browser: true,
    },
    parser: '@typescript-eslint/parser',
    parserOptions: {
        ecmaVersion: 'latest',
        sourceType: 'module',
    },
    rules: {
        'max-len': [1, 250, 4],
        'no-invalid-this': 0,
        'no-multi-str': 0,
        'no-console': 2,
        'no-alert': 2,
        'no-debugger': 2,
    },
    ignorePatterns: [
        'bin/',
        'config/',
        'migrations/',
        'node_modules/',
        'public/',
        'secrets/',
        'src/',
        'templates/',
        'translations/',
        'var/',
        'vendor/',
    ],
};
