<?php

namespace Goldfinch\Requester;

use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;

class Requester
{
    protected static $request;

    public static function init(HTTPRequest $request)
    {
        static::$request = $request;

        if (static::validator()) {
            return static::handle();
        } else {
            return Controller::curr()->httpError(403);
        }
    }

    public static function handle()
    {
        return;
    }

    public static function validator()
    {
        return false;
    }

    protected static function getData()
    {
        $data = static::$request->postVars();

        foreach ($data as $key => $item) {
            if ($item === 'true') {
                $data[$key] = true;
            } elseif ($item === 'false') {
                $data[$key] = false;
            } elseif ($item === 'undefined') {
                $data[$key] = false;
            }
            // else if (is_numeric($item) && !($item[0] == '0' && strlen($item) > 1)) // +123 -3213 counts as numeric ... so disable for now (maybe need to remove this)
            // {
            //     $data[$key] = (int) $item;
            // }
        }

        return $data;
    }

    protected static function getParams()
    {
        return static::$request->latestParams();
    }

    protected function abort($data, $code = 422)
    {
        return Controller::curr()->httpError($code, json_encode($data));
    }

    protected static function message($data)
    {
        return '';
    }
}
