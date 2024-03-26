<?php

require_once $global['systemRootPath'] . 'plugin/Cache/Objects/CachesInDB.php';
require_once $global['systemRootPath'] . 'plugin/Cache/Objects/CachesInDBMem.php';

class CacheDB
{
    public static $loggedType_NOT_LOGGED = 'n';
    public static $loggedType_LOGGED = 'l';
    public static $loggedType_ADMIN = 'a';
    public static $prefix = 'ypt_cache_';
    static $CACHE_ON_DISK = 'disk';
    static $CACHE_ON_MEMORY = 'mem';
    private static $cacheType = 'disk';

    public static function encodeContent($content)
    {
        return CachesInDB::encodeContent($content);
    }

    public static function deleteCacheStartingWith($name)
    {
        try {
            if(self::$cacheType == self::$CACHE_ON_MEMORY){
                return CachesInDBMem::_deleteCacheStartingWith($name);
            }else{
                return CachesInDB::_deleteCacheStartingWith($name);
            }
        } catch (\Throwable $th) {
            _error_log("CacheDB::deleteCacheStartingWith($name)");
        }
    }

    public static function deleteCacheWith($name)
    {
        if(self::$cacheType == self::$CACHE_ON_MEMORY){
            return CachesInDBMem::_deleteCacheWith($name);
        }else{
            return CachesInDB::_deleteCacheWith($name);
        }
    }

    public static function deleteAllCache()
    {
        if(self::$cacheType == self::$CACHE_ON_MEMORY){
            return CachesInDBMem::_deleteAllCache();
        }else{
            return CachesInDB::_deleteAllCache();
        }
    }

    public static function deleteCache($name)
    {
        if(self::$cacheType == self::$CACHE_ON_MEMORY){
            return CachesInDBMem::_deleteCache($name);
        }else{
            return CachesInDB::_deleteCache($name);
        }
    }

    public static function getCache($name, $domain, $ishttps, $user_location, $loggedType, $ignoreMetadata = false)
    {
        if(self::$cacheType == self::$CACHE_ON_MEMORY){
            return CachesInDBMem::_getCache($name, $domain, $ishttps, $user_location, $loggedType, $ignoreMetadata);
        }else{
            return CachesInDB::_getCache($name, $domain, $ishttps, $user_location, $loggedType, $ignoreMetadata);
        }
    }


    public static function setBulkCache($cacheArray, $metadata)
    {
        if(self::$cacheType == self::$CACHE_ON_MEMORY){
            return CachesInDBMem::setBulkCache($cacheArray, $metadata);
        }else{
            return CachesInDB::setBulkCache($cacheArray, $metadata);
        }
    }
}
