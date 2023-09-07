<?php

namespace Goldfinch\Requester;

use SilverStripe\Control\HTTPRequest;

class Requester
{
    protected function getData()
    {
        return $request->postVars();
    }

    protected function getParams()
    {
        return $request->latestParams();
    }

    public function handle(HTTPRequest $request)
    {
        //
    }
}
