# MinkPhpWebdriverExtension
Integrating MinkPhpWebDriver into Behat

# Setup

Install package
```bash
$ composer require --dev oleg-andreyev/mink-phpwebdriver-extension
```

Update your behat.yml by adding `OAndreyev\MinkPhpWebdriverExtension`

Example:
```yaml
default:
  extensions:
    OAndreyev\MinkPhpWebdriverExtension: ~
    Behat\MinkExtension:
      default_session: webdriver
      webdriver:
        wd_host: "http://0.0.0.0:4444"
```
## Copyright

Copyright (c) 2021 Oleg Andreyev <oleg@andreyev.lv>
