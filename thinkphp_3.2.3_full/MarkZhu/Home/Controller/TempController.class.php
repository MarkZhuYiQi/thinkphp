<?php
namespace Home\Controller;
use Think\Controller;
use Home\API\UserAPI;
class TempController extends Controller {
    public function test()
    {
        $this->theme('colleague')->display('temp/test');
    }
}

