<?php

namespace Symcode\Mediawiki\SymfonyBridge;

use \FOS\UserBundle\Model\GroupManagerInterface;
use \FOS\UserBundle\Model\GroupInterface;

class GroupBridge {

    /**
     * @var AuthBridge
     */
    protected $authBridge;

    /**
     * @var \FOS\UserBundle\Model\GroupManagerInterface
     */
    protected $groupmanager;

    public function __construct($authBridge, $groupmanager = "fos_user.group_manager")
    {
        $this->authBridge = $authBridge;
        $this->groupmanager = $authBridge->getSymfonyConatiner()->get($groupmanager);
        if(!($this->groupmanager instanceof \FOS\UserBundle\Model\GroupManagerInterface)){
            throw new \Exception("Group Bridge is only working with FosUserBundle ()");
        }
    }

    public function initGroups(){
        global $wgGroupPermissions;

        $groups = $this->groupmanager->findGroups();
        foreach($groups as $group){
            //init permissions based on user group permissions
            $wgGroupPermissions[self::getGroupAlias($group)] = $wgGroupPermissions['user'];
        }
    }

    /**
     * @param GroupInterface $group
     * @return string
     */
    public static function getGroupAlias(GroupInterface $group){
        return 'sf_group_'.$group->getId();
    }

    public function setUpGroupNamespaces(){
        global $wgExtraNamespaces, $wgNamespacePermissionLockdown, $wgNonincludableNamespaces;

        if(!$wgNamespacePermissionLockdown || !$wgNonincludableNamespaces){
            throw new \Exception('To use the Group Namespace Feature you need to install Lockdown (https://www.mediawiki.org/wiki/Extension:Lockdown)');
        }

        $nsCount = 200;
        $groups = $this->groupmanager->findGroups();
        foreach($groups as $group){
            $nsName = 'NS_SF_GROUP_'.$group->getId();
            $nsNameTalk = $nsName.'_TALK';
            define($nsName, $nsCount++);
            define($nsNameTalk, $nsCount++);

            $groupName = $group->getName();
            $groupName = strtolower($groupName);
            $groupName = str_replace(array(' ', ',', '.', '-'), '_', $groupName);
            $groupName = ucfirst($groupName);

            # add new namespaces
            $wgExtraNamespaces[constant($nsName)] = $groupName ;
            $wgExtraNamespaces[constant($nsNameTalk)] = $groupName.'_talk' ;

            #restrict "read" permission to logged in users
            $wgNamespacePermissionLockdown[constant($nsName)]['read'] = array(self::getGroupAlias($group));
            $wgNamespacePermissionLockdown[constant($nsNameTalk)]['read'] = array(self::getGroupAlias($group));

            #prevent inclusion of pages from that namespace
            $wgNonincludableNamespaces[] = constant($nsName);
            $wgNonincludableNamespaces[] = constant($nsNameTalk);

        }

    }

}