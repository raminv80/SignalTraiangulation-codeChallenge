# Triangulation using only two signals
[![Build Status](https://travis-ci.org/raminv80/SignalTraiangulation-codeChallenge.svg?branch=master)](https://travis-ci.org/raminv80/SignalTraiangulation-codeChallenge)

## Installation
```
git clone ... <project-dir>
cd <project-dir>
composer install
```
## Run server
``` 
php -S 127.0.0.1:8002
```

Then post a json object with following format to http://127.0.0.1:8002/

```json
{
  "samples": [
    {
      "x": 0,
      "y": 0,
      "distance": 5
    }, {
      "x": 6.0,
      "y": 8.0,
      "distance": 5.0
    }
  ]
}
```

Response will include possible source locations:

```json
{
    "samples":[
        {
            "x":0,
            "y":0,
            "distance":5
        },{
            "x":6,
            "y":8,
            "distance":5
        }
    ],
    "sources":[
        {
            "x":3,
            "y":4
        }
    ]
}
```
 
## Run unit tests
```
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/unit/
```

Or alternatively ```./vendor/bin/phpunit``` to use phpunit.xml config.
