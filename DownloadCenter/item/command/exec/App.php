<?php
namespace command\exec;
use \core\coreClass\test;
class App
{
    public function run()
    {
        var_dump(test::test1());
    }
}