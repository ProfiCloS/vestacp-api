[![GitHub version](https://badge.fury.io/gh/ProfiCloS%2Fvestacp-api.svg)](https://badge.fury.io/gh/ProfiCloS%2Fvestacp-api)
[![Build Status](https://travis-ci.com/ProfiCloS/vestacp-api.svg?branch=master)](https://travis-ci.com/ProfiCloS/vestacp-api)
[![codecov](https://codecov.io/gh/ProfiCloS/vestacp-api/branch/master/graph/badge.svg)](https://codecov.io/gh/ProfiCloS/vestacp-api)

# VestaCP PHP API


## How to use

1) Installation
	```sh
	$ composer require proficlos/vestacp-api
	```
2) Create Client

	a) Easy way
	```php
	use ProfiCloS\VestaCP\Client;
	
	// easy way to create Client
	$client = Client::simpleFactory('someHost', 'someUser', 'somePass');
	```
	
	b) For some reasons (more hosts, etc) you may need create objects alone
	```php
	use ProfiCloS\VestaCP\Client;
	use ProfiCloS\VestaCP\Authorization\Credentials;
	use ProfiCloS\VestaCP\Authorization\Host;
	
	$credentials = new Credentials('someUser', 'somePassword');
	$host = new Host('someHost', $credentials);
	$client = new Client($host);

3) Usage

	...


## Buy us a coffee <3
[![Buy me a Coffee](https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=E8NK53NGKVDHS)

## Donate us <3
```
ETH: 0x7D771A56735500f76af15F589155BDC91613D4aB
UBIQ: 0xAC08C7B9F06EFb42a603d7222c359e0fF54e0a13
```

