<?php

namespace Symcode\Mediawiki\SymfonyBridge;

/**
 * Class Connection
 * @package Symcode\Mediawiki\SymfonyBridge
 */
class Connection {

    /**
     * @var string
     */
    protected $host = 'localhost';
    /**
     * @var
     */
    protected $user;
    /**
     * @var
     */
    protected $password;
    /**
     * @var
     */
    protected $database;
    /**
     * @var string
     */
    protected $prefix = 'phpbb_';
    /**
     * @var array
     */
    protected $groups = array();
    /**
     * @var string
     */
    protected $usernamePrefix = '';

    /**
     * @param $host
     */
    public function setHost($host) {
        $this->host = $host;
    }

    /**
     * @param $user
     */
    public function setUser($user) {
        $this->user = $user;
    }

    /**
     * @param $prefix
     */
    public function setUsernameprefix($prefix) {
        $this->usernamePrefix = $prefix;
    }

    /**
     * @param $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @param $database
     */
    public function setDatabase($database) {
        $this->database = $database;
    }

    /**
     * @param $prefix
     */
    public function setPrefix($prefix) {
        $this->prefix = $prefix;
    }

    /**
     * @param $groups
     */
    public function setGroups($groups) {
        $this->groups = $groups;
    }

    /**
     * @return string
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getDatabase() {
        return $this->database;
    }

    /**
     * @return string
     */
    public function getPrefix() {
        return $this->prefix;
    }

    /**
     * @return array
     */
    public function getGroups() {
        return $this->groups;
    }

    /**
     * @return string
     */
    public function getUserTable(){
        return $this->prefix.'users';
    }

    /**
     * @return string
     */
    public function getUserGroupTable(){
        return $this->prefix.'user_groups';
    }

    /**
     * @return string
     */
    public function getGroupTable(){
        return $this->prefix.'groups';
    }

    /**
     * @return string
     */
    public function getUsernamePrefix(){
        return $this->usernamePrefix;
    }
}

