# sabredav-bundle

## Installation

do the

``
composer require signalzwei/sabredav-bundle
``

and add to the kernel.

## Configuration

This is the full default config for your ``config.yml``

```
sabre_dav:
    backends:
        auth:       sabredav.backend.auth
        principal:  sabredav.backend.principal
        caldav:     sabredav.backend.caldav
    plugins:
        acl         false
        auth:       false
        browser:    false
        caldav:     false
    mount:
        - sabredav.collections.principal
        - sabredav.collections.calendar
```

## Thanks

To secotrust/SecotrustSabreDavBundle for the great ideas.