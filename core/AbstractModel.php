<?php

abstract class AbstractModel
{
    protected static $dir;
    protected $data = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public static function all()
    {
        if(file_exists(static::$dir)){
            return json_decode(file_get_contents(static::$dir));
        }
        return false;
    }

    public static function find($id) 
    {
        $data = self::all();

        $arr = [];
        foreach($data as $vs) {
            if ($vs->ident != $id) {
                continue;
            }
            foreach ($vs as $k => $v) {

                //$ids[] = $v;
                $arr[$k] = $v;
            }
        }
            return $arr;
    }

    public function insert() 
    {
        $all = self::all();

        $all[] = $this->data;

        if(!file_put_contents(static::$dir, json_encode($all)))
        {
           return false;
        }
    }

    public function update() 
    {
        $data = self::all();

        $arr = [];
        foreach($data as $ks => $vs) {
            if ($vs->ident == $this->ident) {
                // unset($data[$ks]);
                continue;
            }
            $arr[] = $vs;
        }
        $arr[] = $this->data;

        if(!file_put_contents(static::$dir, json_encode($arr)))
        {
            return false;
        }
    }

    public function delete() 
    {
        $data = self::all();

        $arr = [];
        foreach($data as $ks => $vs) 
        {
            if ($vs->ident == $this->ident) 
            {
                continue;
            }
            $arr[] = $vs;

        }
        if(!file_put_contents(static::$dir, json_encode($arr)))
        {
            return false;
        }
        return true;
    }
    
    public static function ids()
    {
        $data = self::all();
        if($data)
        {
            $ids = [];
            foreach ($data as $keys => $values)
            {
                foreach ($values as $key => $value)
                {
                    if($key != 'ident')
                    {
                        continue;
                    }
                    $ids[] = $value;
                }
            }
            $ident = max($ids) + 1;
            return (string) $ident;
        }
        return false;
    }
}