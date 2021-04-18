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

    public static function setAjaxData(string $scriptName, string $scriptPath, array $dependencies = array(), string $scriptVersion, string $objectName) {

        self::$scriptName = $scriptName;
        self::$scriptPath = plugins_url() . $scriptPath;
        self::$dependencies = $dependencies;
        self::$scriptversion = $scriptVersion;
        self::$objectName = $objectName;

    }

    public static function validateAdminAjaxRequest(callable $callback) {
        add_action('admin_enqueue_scripts', array( get_called_class(), 'enqueueAjaxData' ) );
        add_action("wp_ajax_" . self::$objectName, $callback );
    }

    public static function validateAjaxRequest(callable $callback) {
        add_action('wp_enqueue_scripts', array( get_called_class(), 'enqueueAjaxData' ) );
        add_action("wp_ajax_nopriv_" . self::$objectName, $callback );
    }

    public static function enqueueAjaxData() {
        // Enqueue Script
        wp_enqueue_script(self::$scriptName, self::$scriptPath, self::$dependencies,self::$scriptversion);
        wp_localize_script(self::$scriptName, self::$objectName, array(
            'ajaxurl' => admin_url('admin-ajax.php')
        ));
    }

 }

?>
