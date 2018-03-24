# PHP Telegram API Symfony Bundle

[![Latest Stable Version](https://poser.pugx.org/zored/telegram-bundle/version.png)](https://packagist.org/packages/zored/telegram-bundle)
[![Build Status](https://travis-ci.org/zored/telegram-bundle.svg?branch=master)](https://travis-ci.org/zored/telegram-bundle)
[![Coverage Status](https://coveralls.io/repos/github/zored/telegram-bundle/badge.svg?branch=master)](https://coveralls.io/github/zored/telegram-bundle?branch=master)
[![Code Quality Status](https://scrutinizer-ci.com/g/zored/telegram-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/zored/telegram-bundle/?branch=master)
[![AppVeyor Status](https://ci.appveyor.com/api/projects/status/ewh9cu52r2e5sukd?svg=true
)](https://ci.appveyor.com/project/zored/telegram-bundle)

Symfony 4 bundle for [Telegram API](https://github.com/zored/telegram).

## Install
```bash
composer require zored/telegram-bundle
```

## CLI usage
- Install bundle globally.
    ```bash
    composer global require zored/telegram-bundle
    ```
- Ensure that your `PATH` looks at composer bin root (see `composer global --help` for details).
- Set-up environment variables:
    ```bash
    export TELEGRAM_PHONE='' TELEGRAM_API_ID='' TELEGRAM_API_HASH=''
    ```
- Run:
    ```
    telegram send-message
    ```
