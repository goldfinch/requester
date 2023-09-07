<?php

namespace Goldfinch\Requester\Controllers;

use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Security\SecurityToken;

class RequesterController extends Controller
{
    // private static $url_segment = 'api';

    private static $url_handlers = [
        'POST tunnel' => 'tunnel',
    ];

    private static $allowed_actions = [
        'tunnel',
    ];

    public function init()
    {
        parent::init();
    }

    public function tunnel(HTTPRequest $request)
    {
        $this->authorized($request);

        // $data = $request->postVars();
        // $rules = ss_config('Goldfinch\API\Router', 'rules');

        // if (isset($rules[$paramUrl]))
        // {
        //     $class;

        //     return $class;
        // }
        // else
        // {
        //     return $this->httpError(403);
        // }

        return json_encode(true);
    }

    protected function authorized(HTTPRequest $request)
    {
        if(!$request->isPOST())
        {
            return $this->httpError(403, 'This action is unauthorized');
        }
        else if($request->getHeader('X-CSRF-TOKEN') != SecurityToken::getSecurityID())
        {
            return $this->httpError(401, 'Unauthorized');
        }
    }
}
