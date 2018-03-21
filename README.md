OpenTrans
=========

[![Latest Stable Version](https://poser.pugx.org/se/opentrans/v/stable.png)](https://packagist.org/packages/se/opentrans) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/4a0d246b-2d30-4c46-8161-a85c39ec5e7d/mini.png)](https://insight.sensiolabs.com/projects/4a0d246b-2d30-4c46-8161-a85c39ec5e7d)

Allows you to read, create and write OpenTRANS compatible documents from PHP


#### Dev branch is master branch.

[![Build Status](https://api.travis-ci.org/sveneisenschmidt/opentrans.png?branch=master)](https://travis-ci.org/svenseisenschmidt/opentrans)


##### Table of Contents

[Installation](#installation)

[Usage](#usage)

* [Build document](#builder)
* [Document factory](#factory)
* [Run tests](#tests)
* [Symfony2 integration](#bundle)

[Roadmap](#roadmap)

<a name="installation"></a>
## Installation

The recommended way to install is through [Composer](http://getcomposer.org).

```yaml
{
    "require": {
        "se/opentrans": "dev-master"
    }
}
```

<a name="usage"></a>

## Usage

<a name="builder"></a>
### Build document

Assuming you already have a builder (See [document factory](#factory))

``` php
<?php

use \SE\Component\OpenTrans;

$document = $builder->getDocument();

$document->getHeader()->getOrderInfo()->setOrderId('00000000001');

$orderLine1 = new OpenTrans\Node\Order\ItemNode();
$orderLine1->setLineId('P00000001');

$document->addItem($orderLine1);

$xml = $builder->serialize();

```

Returns:

``` xml
<?xml version="1.0" encoding="ISO-8859-1"?>
<ORDER version="1.0" type="standard">
  <ORDER_HEADER>
    <CONTROL_INFO>
      <GENERATOR_INFO/>
      <GENERATION_DATE/>
    </CONTROL_INFO>
    <ORDER_INFO>
      <ORDER_ID>00000000001</ORDER_ID>
    </ORDER_INFO>
  </ORDER_HEADER>
  <ORDER_ITEM_LIST>
    <ORDER_ITEM>
      <LINE_ITEM_ID>P00000001</LINE_ITEM_ID>
  </ORDER_ITEM_LIST>
  <ORDER_SUMMARY/>
</ORDER>
```


<a name="factory"></a>
### Document factory

``` php
<?php

use \SE\Component\OpenTrans;

//to allow for loading from annotations
AnnotationRegistry::registerAutoloadNamespace(
    'JMS\Serializer\Annotation',
    dirname(__FILE__). "/../vendor/jms/serializer/src"
);

// Pick a factory to create your document (i.e. an Order)
$loader = new OpenTrans\NodeLoader();
$factory = new OpenTrans\DocumentFactory\OrderFactory($loader);
$builder = new OpenTrans\DocumentBuilder($factory);
$builder->build(); // bootstraps the default document structure

$document = $builder->getDocument();
// ... build your document

```

#### Resolve document factory by document type

``` php
<?php

use \SE\Component\OpenTrans;

// Let the DocumentFactoryResolver pick the factory you need

$loader = new OpenTrans\NodeLoader();
$factoryClass = OpenTrans\DocumentFactory\DocumentFactoryResolver::resolveFactory(
    $loader,
    OpenTrans\DocumentType::DOCUMENT_ORDER
);

$factory = new $factoryClass($loader);
$builder = new OpenTrans\DocumentBuilder($factory);
$builder->build(); // bootstraps the default document structure

$document = $builder->getDocument();
// ... build your document

```

<a name="tests"></a>
### Run tests
``` bash
$> vendor/bin/phpunit
```

<a name="bundle"></a>
### Symfony2 bundle

This library is integrated into Symfony2 through the [OpenTransBundle](https://github.com/sveneisenschmidt/opentrans-bundle).


<a name="roadmap"></a>
## Roadmap

* Implement Document types
    * (x) Order
    * (  ) Invoice
    * (  ) OrderChange
    * (  ) OrderResponse
    * (  ) Quotation
    * (  ) RFQ
    * (  ) ReceiptAcknowledgement
