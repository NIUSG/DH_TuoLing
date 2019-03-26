<?php
namespace app\test\validate;
use think\Validate;
class ValidateTest extends Validate
{
    //?name=niushaogang&email=370574131@qq.com
    protected $rule=[
        'name'=>'require|alpha|max:25',
        'email'=>'require|email',
        'age'=>'require|between:1,120',
        'password'=>'require|alpha|between:5,32',
    ];
    protected $message = [
        'name.alpha' => '二愣子，名称要用字母',
    ];
    protected $scene = [
        'edit' => ['name','age'],
    ];
}