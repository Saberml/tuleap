<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
function autoload67c7f4534cddc0e5950bad50dfd89325($class) {
    static $classes = null;
    if ($classes === null) {
        $classes = array(
            'openid_authenticationfailedexception' => '/AuthenticationFailedException.class.php',
            'openid_connexionmanager' => '/ConnexionManager.class.php',
            'openid_dao' => '/Dao.class.php',
            'openid_driver_connexiondriver' => '/driver/ConnexionDriver.class.php',
            'openid_logincontroller' => '/LoginController.class.php',
            'openid_openidexception' => '/OpenIdException.class.php',
            'openid_openidrouter' => '/OpenIdRouter.class.php',
            'openid_usernotfoundexception' => '/UserNotFoundException.class.php',
            'openidplugin' => '/openidPlugin.class.php',
            'openidplugindescriptor' => '/OpenidPluginDescriptor.class.php',
            'openidplugininfo' => '/OpenidPluginInfo.class.php'
        );
    }
    $cn = strtolower($class);
    if (isset($classes[$cn])) {
        require dirname(__FILE__) . $classes[$cn];
    }
}
spl_autoload_register('autoload67c7f4534cddc0e5950bad50dfd89325');
// @codeCoverageIgnoreEnd