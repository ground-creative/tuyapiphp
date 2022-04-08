# Tuya Cloud Api PHP Client

This is a simple php client to interact with devices that support the tuya api.

*If you are looking for a more ready to use solution or u need to control devices from different brands, you can use [this tool](https://github.com/ifsale/YourHomeServer) with nodejs.*

## Requirements

I believe all is needed is php curl for the requests.

## Installation

### With composer:

Add the package to your composer.json file

```
"require": 
{

        "tuyapiphp/tuyapiphp": "*"
}
```

and run `composer update`

### Stand Alone:

You must require all the needed classes manually, or you can use an autoloader [like this one](http://phptoolcase.com/guides/ptc-hm-guide.html).

## Basic Usage

Use these [setup instructions](https://github.com/codetheweb/tuyapi/blob/master/docs/SETUP.md) for how to find the needed parameters.

### Create new instance

```
$config =
[
	'accessKey' 	=> 'xxxxxxxxxxxxxxxxx' ,
	'secretKey' 	=> 'xxxxxxxxxxxxxxxxx' ,
	'baseUrl'		=> 'https://openapi.tuyaus.com'
];

$tuya = new \tuyapiphp\TuyaApi( $config );
```
### Get an access token

```
$data = $tuya->token->get_new( );	
```

### Example device operations

```
$app_id = 'xxxxxxxxxxxxxxxxxxxx';

$device_id = 'xxxxxxxxxxxxxxxxxxx';

// Get a token
$token = $tuya->token->get_new( )->result->access_token;

// Get list of devices connected with tuya/smart life app
$tuya->devices( $token )->get_app_list( $app_id );

// Get device status
$tuya->devices( $token )->get_status( $device_id );

// Set device name
$tuya->devices( $token )->put_name( $device_id , [ 'name' => 'FAN' ] );

// Send command to device
$payload = [ 'code' => 'switch_1' , 'value' => false ];
$tuya->devices( $token )->post_commands( $device_id , [ 'commands' => [ $payload ] ] );
```

### Example camera stream

```
$app_id = 'xxxxxxxxxxxxxxxxxx';

$camera_id = 'xxxxxxxxxxxxxxxxxxxx';

$tuya = new \tuyapiphp\TuyaApi( $config );

// Get a token
$token = $tuya->token->get_new( )->result->access_token;

// Get camera stream link
$stream = $tuya->devices( $token )->post_stream_allocate( $app_id , $camera_id , [ 'type' => 'rtsp' ] );
        
```

Use the returned url to open the stream: `ffplay -i rtsps://xxxxxxxxx`

