<?php
namespace app\test\controller;
use think\Controller;
use think\Validate;
use app\test\validate\ValidateTest;
class Test extends Controller
{
    private $ValiTest;
    private $Vali;
    public function __construct()
    {
        parent::__construct();
        $this->ValiTest = new ValidateTest;
        $this->Vali = new Validate;
    }
    //独立验证，源码解析测试
    //独立验证分两种,一种是实例化验证类的时候加入验证规则,一种是写好验证规则用方法传入
    public function independentVerifieation()
    {
        //传参str=abc&int=7
        $rule = [
            'str'=>'require|alpha',
            'int'=>'require|integer',
        ];
        $param = input('get.');
        var_dump($param);
        $this->Vali->rule($rule)->check($param);
        $err_msg = $this->Vali->getError();
        var_dump($err_msg);
    }
}