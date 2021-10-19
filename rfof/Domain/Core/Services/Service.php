<?php


namespace Rfof\Domain\Core\Services;


class Service
{
    public static $model;

    public function __construct($model = null)
    {
        static::$model = static::$model ?: $model;
    }

    public static function for($model)
    {
        return new static($model);
    }

    public static function make()
    {
        return new static();
    }

    public function persist($model = null)
    {
        return PersistService::for(static::$model);
    }

    public function adminPersist($model = null)
    {
        return AdminPersistService::for(static::$model);
    }

    protected static function model()
    {
        return static::$model;
    }

    protected static function newModel()
    {
        return new static::$model;
    }
}
