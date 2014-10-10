<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
function autoload80adfddcb47508625fe560a938f92e10($class) {
    static $classes = null;
    if ($classes === null) {
        $classes = array(
            'checkparameters' => '/jabbex_api/lib/check_parameters/CheckParameters.php',
            'connectionsocket' => '/jabbex_api/lib/jabberclass-0.9/class_ConnectionSocket.php',
            'eventhandler' => '/jabbex_api/EventHandler.php',
            'groupmanager' => '/jabbex_api/lib/group_mng/Openfire.php',
            'groupmanagerinterface' => '/jabbex_api/lib/group_mng/GroupManagerInterface.php',
            'im' => '/IM.class.php',
            'im_widget_myroster' => '/IM_Widget_MyRoster.class.php',
            'imactions' => '/IMActions.class.php',
            'imdao' => '/IMDao.class.php',
            'imdataaccess' => '/IMDataAccess.class.php',
            'immucchangetopicsystemlog' => '/IMMucSystemLog.class.php',
            'immucconversationlog' => '/IMMucConversationLog.class.php',
            'immucjointheroomsystemlog' => '/IMMucSystemLog.class.php',
            'immuclefttheroomsystemlog' => '/IMMucSystemLog.class.php',
            'immuclog' => '/IMMucLog.class.php',
            'immuclogmanager' => '/IMMucLogManager.class.php',
            'immucsystemlog' => '/IMMucSystemLog.class.php',
            'implugin' => '/IMPlugin.class.php',
            'implugindescriptor' => '/IMPluginDescriptor.class.php',
            'implugininfo' => '/IMPluginInfo.class.php',
            'imviews' => '/IMViews.class.php',
            'jabber' => '/jabbex_api/lib/jabberclass-0.9/class_Jabber.php',
            'jabberserverconf' => '/jabbex_api/lib/loadconf/JabberServerConf.php',
            'jabbex' => '/jabbex_api/Jabbex.php',
            'jabbex_xmlparser' => '/jabbex_api/lib/jabberclass-0.9/class_XMLParser.php',
            'jabbexfactory' => '/JabbexFactory.class.php',
            'jabbexinstaller' => '/jabbex_api/installation/install.php',
            'jabbexinterface' => '/jabbex_api/JabbexInterface.php',
            'openfiremessagehandler' => '/jabbex_api/lib/group_mng/Openfire.php',
            'packetmng' => '/jabbex_api/lib/packet_mng/PacketMng.php',
            'pluginimmucchangetopiclogdao' => '/PluginIMMucChangeTopicLogDao.class.php',
            'pluginimmucconversationlogdao' => '/PluginIMMucConversationLogDao.class.php',
            'pluginimmucjointheroomlogdao' => '/PluginIMMucJoinTheRoomLogDao.class.php',
            'pluginimmuclefttheroomlogdao' => '/PluginIMMucLeftTheRoomLogDao.class.php'
        );
    }
    $cn = strtolower($class);
    if (isset($classes[$cn])) {
        require dirname(__FILE__) . $classes[$cn];
    }
}
spl_autoload_register('autoload80adfddcb47508625fe560a938f92e10');
// @codeCoverageIgnoreEnd
