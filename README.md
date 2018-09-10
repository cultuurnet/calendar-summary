# Warning: This project has been deprecated
It should only be used with Culturefeed and CdbXml integrations. 
For all other uses this project has been deprecated and superseded by [calendar-summary-v3](https://github.com/cultuurnet/calendar-summary-v3)
 

# calendar-summary 

[![Build Status](https://travis-ci.org/cultuurnet/calendar-summary.svg?branch=master)](https://travis-ci.org/cultuurnet/calendar-summary) [![Coverage Status](https://coveralls.io/repos/cultuurnet/calendar-summary/badge.svg?branch=master&service=github)](https://coveralls.io/github/cultuurnet/calendar-summary?branch=master)

## Installation

You can install the CultuurNet\calendar-summary PHP library in different ways:

* Standalone. Clone or download from github and use [Composer][composer]. Run ``composer install`` from
  the root of the clone to download the necessary dependencies. Standalone usage is probably only useful for testing
  purposes.
* Inside your project: require the cultuurnet/calendar-summary package (it is
  [registered on Packagist][packagist]) and the cultuurnet/cdb package in your project's
  composer.json file and run ``composer update``.

```json
{
    "require": {
        "cultuurnet/calendar-summary": "~1.0",
    }
}
```

## How it works

The calendar-summary PHP takes a CultureFeed_Cdb_Data_Calendar object (hence the dependency on cultuurnet/cdb, 
and formats it. 
Right now there's a HTML formatter and a plain text formatter. But other formatters can easily be implemented.
