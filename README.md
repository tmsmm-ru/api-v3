# Документация к TmSMM API для работы с услугами

Получить PHP Class для работы с API можно по ссылке: https://github.com/tmsmm-ru/api-v3/blob/main/TmSMMApiV3.php


## #Баланс аккаунта

### Пример запроса

```php
    <?php

    $token = '';

    $oTmSMM = new TmSMMApiV3($token);

    $oTmSMM->getProfile();
```

### Пример ответа

```
Array
(
    [response] => Array
        (
            [success] => Array
                (
                    [code] => 1
                    [data] => Array
                        (
                            [email] => name@email.com
                            [balance] => Array
                                (
                                    [amount] => 12398.61
                                    [currency] => RUB
                                )

                        )

                )

        )

)
```
