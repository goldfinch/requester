<?php

namespace Goldfinch\Requester\Controllers;

use Goldfinch\Requester\Requester;
use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Security\SecurityToken;

class RequesterController extends Controller
{
    // private static $url_segment = 'api';

    private static $url_handlers = [
        'POST $@' => 'tunnel',
    ];

    private static $allowed_actions = ['tunnel'];

    public function init()
    {
        parent::init();
    }

    public function tunnel(HTTPRequest $request)
    {
        $this->authorized($request);

        $data = $request->postVars();
        $params = implode('/', $request->latestParams());

        $rules = ss_config(Requester::class, 'rules');

        if (isset($rules[$params])) {
            return $rules[$params]::init($request);
        }

        return $this->httpError(403);
    }

    protected function authorized(HTTPRequest $request)
    {
        if (!$request->isPOST()) {
            return $this->httpError(403, 'This action is unauthorized');
        } elseif (
            $request->getHeader('X-CSRF-TOKEN') !=
            SecurityToken::getSecurityID()
        ) {
            return $this->httpError(401, 'Unauthorized');
        }
    }
}
