<?php 

/**
 * Made with love by Wilhelm Burger - https://github.com/phpcodingmaster
 */

 class AjaxSimplified {

     protected static $scriptName;
     protected static $scriptPath;
     protected static $dependencies;
     protected static $scriptversion;
     protected static $objectName;
     protected static $parameters;

    public static function setAjaxData(string $scriptName, string $scriptPath, array $dependencies = array(), string $scriptVersion, string $objectName , array $parameters) {

        self::$scriptName = $scriptName;
        self::$scriptPath = plugins_url() . $scriptPath;
        self::$dependencies = $dependencies;
        self::$scriptversion = $scriptVersion;
        self::$objectName = $objectName;
        self::$parameters = array(
            'ajaxurl' => admin_url('admin-ajax.php')
        );
     
        if( isset($parameters) && is_array($parameters) ){
           self::$parameters = array_merge( self::$parameters, $parameters );
        }

    }

    public static function validateAdminAjaxRequest(string $action, callable $callback) {
        add_action('admin_enqueue_scripts', array( get_called_class(), 'enqueueAjaxData' ) );
        add_action("wp_ajax_" . $action, $callback );
    }

    public static function validateAjaxRequest(string $action, callable $callback) {
        add_action('wp_enqueue_scripts', array( get_called_class(), 'enqueueAjaxData' ) );
        add_action("wp_ajax_nopriv_" . $action, $callback );
    }

    public static function enqueueAjaxData() {
     
        // Enqueue Script
        wp_enqueue_script(self::$scriptName,  self::$scriptPath, self::$dependencies,self::$scriptversion);
        wp_localize_script(self::$scriptName, self::$objectName, self::$parameters );
     
    }

 }

?>
