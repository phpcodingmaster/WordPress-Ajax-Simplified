# WordPress-Ajax-Simplified
A beautiful PHP Class to make Ajax Requests in WordPress. Handles wp_ajax_nopriv_{$action} & wp_ajax_{$action} . Download the PHP class and require the file in your main WordPress Plugin file. Write two methods to make Ajax Work in your WordPress website.

----------------------------------------------------------------------------------------------------
### 1. Enqueue the JavaScript file & Create the Javascript Object 
----------------------------------------------------------------------------------------------------

#### AjaxSimplified::setAjaxData( string $scriptName, string $scriptPath, array $dependencies, string $scriptVersion, string $objectName, array $parameters );

```
AjaxSimplified::setAjaxData("hello",
"/your-plugin_directory-name/hello.js", 
array(),
'1.0.0',
'sayhello',
array()
);
```

- What is $objectName?

```
$objectName is the name of the JavaScript object created by the wp_localize_script(); WordPress function.
The class method above will enqueue your JavaScript file and create the JavaScript object with a **ajaxurl** property.

In the example above, your JavaScript file will look similar to the example below:


jQuery(document).ready(function () {

    jQuery("#sayHiButton").click(function () {
		
	var name = jQuery("#name").val();
		
        jQuery.ajax({
            url: sayhello.ajaxurl,
            type: 'GET',
            data: {
                action: 'sayhello',
		name: name
            },
            success: function (response) {
                console.log(response);
		alert("Hi," + response);
            }
        });
				
    });

});

```

----------------------------------------------------------------------------------------------------
### 2. Handle Ajax Requests in the WordPress Admin Dashboard
----------------------------------------------------------------------------------------------------

#### AjaxSimplified::validateAdminAjaxRequest(string, $action, callable $callback);

```
AjaxSimplified::validateAdminAjaxRequest('sayhello', function() {
if( isset($_GET["name"] ) {
	$name = $_GET["name"];
	update_option("name", $name);
}
});
```

----------------------------------------------------------------------------------------------------
### 3. Handle AJAX requests from unauthenticated users
----------------------------------------------------------------------------------------------------

#### AjaxSimplified::validateAjaxRequest(string $action, callable $callback);

```
AjaxSimplified::validateAjaxRequest('sayhello', function() {
if( isset($_GET["name"] ) {
	$name = $_GET["name"];
	update_option("name", $name);
}
});
```
