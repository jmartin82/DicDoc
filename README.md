DIC - DOC
=========

Dependency Injection Containers Documentator

[![Build Status](https://travis-ci.org/jmartin82/DicDoc.svg?branch=master)](https://travis-ci.org/jmartin82/DicDoc)


The problem
-----------

Since I've been using Dependency Injection Containers in my projects, the IDEs no longer understands what’s going on in some places in my code.

This problems affect the code hints, autocompletion and refactoring tools when dealing with classes. Then my IDE becomes useless.


The solution
------------

You can define class of the variable returned by DIC 'manually':

```
/** @var YourClassType $mailer */
$mailer = $container['mailer'];
```

Use two asterisks and write the data type before the name of the variable. You can write the data type without the name of the variable (but not the name without the data type).

In the major part of the IDEs this comment solves your problems. But...


The lazy solution
-----------------

If you are a lazy person like me, you can use de DIC.

To document any variable from your code, you should enclose the variable with `dd` function, execute the code and black magic is going to happen (ok, not too magic, but it works)!

**Before:**

```
$mailer = dd($container['mailer']);
```

**Start:**

```
/** @var YourClassType $mailer */
$mailer = $container['mailer'];
```


Installation / Usage
--------------------

1. Download and install Composer by following the [official instructions](https://getcomposer.org/download/).
2. Create a composer.json defining the dependencies.

    ``` json
    {
        "require-dev": {
            "jmartin82/DicDoc": "dev-master"
        }
    }
    ```

3. Run Composer: `php composer.phar install`


### Important


* The code have to run to be replaced
* Never use the dd function in production code
* Always review the changes
* Remember refresh the file if the IDE doesn't do it automatically.
