# Tuya Api PHP Client

This is a simple php client to interact with devices that support the tuya api over the cloud.

## Requirements

I believe all is needed is php curl for the requests.

## Installation

```
npm install tuyacloudnodejs
```

## Basic Usage

Use these [setup instructions](https://github.com/codetheweb/tuyapi/blob/master/docs/SETUP.md) for how to find the needed parameters.

### Create new instance

```
const TuyaCloud = require( 'tuyacloudnodejs' );

let Tuya = new TuyaCloud
( {
	"secretKey" : "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" ,
	"accessKey" : "XXXXXXXXXXXXXXXXXXX" ,
	"server": "https://openapi.tuyaus.com"
} );
```
### Get an access token

```
let data = await Tuya.token( ).get_new( );	
```

### Example operations

```
( async function( )
{
	// set some variables for the example
	let result = '';
	let device_id = 'XXXXXXXXXXXXXXXXXXX';
	let home_id = 'XXXXXXX';
	let scene_id = 'XXXXXXXXXXXXXX';

	// get an access token
	let data = await Tuya.token( ).get_new( );
	let token = data.result.access_token;

	// get device details
	result = await Tuya.devices( token ).get_details( device_id );

	// post device commands
	let commands = { "commands": [ { "code": "switch_led" , "value": false } ] };
	result = await Tuya.devices( token ).post_commands( device_id , commands );

	// get list of scenes
	result = await Tuya.scenes( token ).get_list( home_id );

	// trigger a scene
	result = await Tuya.scenes( token ).post_trigger( home_id , scene_id );

} )( );
```
## Show all methods



```
// call one of the main components (home,scenes,devices,token)
// example call to show all methods for devices component
endpoints = Tuya.devices( ).endpoints( );
	
```

