<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace think;

use think\exception\ClassNotFoundException;

class Validate
{
    // 实例
    protected static $instance;

    // 自定义的验证类型
    protected static $type = [];

    // 验证类型别名
    protected $alias = [
        '>' => 'gt', '>=' => 'egt', '<' => 'lt', '<=' => 'elt', '=' => 'eq', 'same' => 'eq',
    ];

    // 当前验证的规则
    protected $rule = [];

    // 验证提示信息
    protected $message = [];
    // 验证字段描述
    protected $field = [];

    // 验证规则默认提示信息
    protected static $typeMsg = [
        'require'     => ':attribute require',
        'number'      => ':attribute must be numeric',
        'integer'     => ':attribute must be integer',
        'float'       => ':attribute must be float',
        'boolean'     => ':attribute must be bool',
        'email'       => ':attribute not a valid email address',
        'array'       => ':attribute must be a array',
        'accepted'    => ':attribute must be yes,on or 1',
        'date'        => ':attribute not a valid datetime',
        'file'        => ':attribute not a valid file',
        'image'       => ':attribute not a valid image',
        'alpha'       => ':attribute must be alpha',
        'alphaNum'    => ':attribute must be alpha-numeric',
        'alphaDash'   => ':attribute must be alpha-numeric, dash, underscore',
        'activeUrl'   => ':attribute not a valid domain or ip',
        'chs'         => ':attribute must be chinese',
        'chsAlpha'    => ':attribute must be chinese or alpha',
        'chsAlphaNum' => ':attribute must be chinese,alpha-numeric',
        'chsDash'     => ':attribute must be chinese,alpha-numeric,underscore, dash',
        'url'         => ':attribute not a valid url',
        'ip'          => ':attribute not a valid ip',
        'dateFormat'  => ':attribute must be dateFormat of :rule',
        'in'          => ':attribute must be in :rule',
        'notIn'       => ':attribute be notin :rule',
        'between'     => ':attribute must between :1 - :2',
        'notBetween'  => ':attribute not between :1 - :2',
        'length'      => 'size of :attribute must be :rule',
        'max'         => 'max size of :attribute must be :rule',
        'min'         => 'min size of :attribute must be :rule',
        'after'       => ':attribute cannot be less than :rule',
        'before'      => ':attribute cannot exceed :rule',
        'afterWith'   => ':attribute cannot be less than :rule',
        'beforeWith'  => ':attribute cannot exceed :rule',
        'expire'      => ':attribute not within :rule',
        'allowIp'     => 'access IP is not allowed',
        'denyIp'      => 'access IP denied',
        'confirm'     => ':attribute out of accord with :2',
        'different'   => ':attribute cannot be same with :2',
        'egt'         => ':attribute must greater than or equal :rule',
        'gt'          => ':attribute must greater than :rule',
        'elt'         => ':attribute must less than or equal :rule',
        'lt'          => ':attribute must less than :rule',
        'eq'          => ':attribute must equal :rule',
        'unique'      => ':attribute has exists',
        'regex'       => ':attribute not conform to the rules',
        'method'      => 'invalid Request method',
        'token'       => 'invalid token',
        'fileSize'    => 'filesize not match',
        'fileExt'     => 'extensions to upload is not allowed',
        'fileMime'    => 'mimetype to upload is not allowed',
    ];

    // 当前验证场景
    protected $currentScene = null;

    // 正则表达式 regex = ['zip'=>'\d{6}',...]
    protected $regex = [];

    // 验证场景 scene = ['edit'=>'name1,name2,...']
    protected $scene = [];

    // 验证失败错误信息
    protected $error = [];

    // 批量验证
    protected $batch = false;

    /**
     * 构造函数
     * @access public
     * @param array $rules 验证规则
     * @param array $message 验证提示信息
     * @param array $field 验证字段描述信息
     */
    public function __construct(array $rules = [], $message = [], $field = [])
    {
        $this->rule    = array_merge($this->rule, $rules);
        $this->message = array_merge($this->message, $message);
        $this->field   = array_merge($this->field, $field);
    }

    /**
     * 实例化验证
     * @access public
     * @param array     $rules 验证规则
     * @param array     $message 验证提示信息
     * @param array     $field 验证字段描述信息
     * @return Validate
     */
    public static function make($rules = [], $message = [], $field = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($rules, $message, $field);
        }
        return self::$instance;
    }

    /**
     * 添加字段验证规则
     * @access protected
     * @param string|array  $name  字段名称或者规则数组
     * @param mixed         $rule  验证规则
     * @return Validate
     */

    /**
     *rule方法,注册验证规则。和构造方法,check方法注册rule同理。验证规则写入属性$rule中
     *两种传参：单个字段单个验证规则。或者name为数组,直接写入验证规则
     */
    public function rule($name, $rule = '')
    {
        if (is_array($name)) {
            //可以补加验证规则
            $this->rule = array_merge($this->rule, $name);
        } else {
            //rule数组加字段,可以补充添加规则
            $this->rule[$name] = $rule;
        }
        return $this;
    }

    /**
     * 注册验证（类型）规则
     * @access public
     * @param string    $type  验证规则类型
     * @param mixed     $callback callback方法(或闭包)
     * @return void
     */
    public static function extend($type, $callback = null)
    {
        if (is_array($type)) {
            self::$type = array_merge(self::$type, $type);
        } else {
            self::$type[$type] = $callback;
        }
    }

    /**
     * 设置验证规则的默认提示信息
     * @access protected
     * @param string|array  $type  验证规则类型名称或者数组
     * @param string        $msg  验证提示信息
     * @return void
     */
    public static function setTypeMsg($type, $msg = null)
    {
        if (is_array($type)) {
            self::$typeMsg = array_merge(self::$typeMsg, $type);
        } else {
            self::$typeMsg[$type] = $msg;
        }
    }

    /**
     * 设置提示信息
     * @access public
     * @param string|array  $name  字段名称
     * @param string        $message 提示信息
     * @return Validate
     */
    public function message($name, $message = '')
    {
        if (is_array($name)) {
            $this->message = array_merge($this->message, $name);
        } else {
            $this->message[$name] = $message;
        }
        return $this;
    }

    /**
     * 设置验证场景
     * @access public
     * @param string|array  $name  场景名或者场景设置数组
     * @param mixed         $fields 要验证的字段
     * @return Validate
     */
    public function scene($name, $fields = null)
    {
        if (is_array($name)) {
            $this->scene = array_merge($this->scene, $name);
        }if (is_null($fields)) {
            // 设置当前场景
            $this->currentScene = $name;
        } else {
            // 设置验证场景
            $this->scene[$name] = $fields;
        }
        return $this;
    }

    /**
     * 判断是否存在某个验证场景
     * @access public
     * @param string $name 场景名
     * @return bool
     */
    public function hasScene($name)
    {
        return isset($this->scene[$name]);
    }

    /**
     * 设置批量验证
     * @access public
     * @param bool $batch  是否批量验证
     * @return Validate
     */
    public function batch($batch = true)
    {
        $this->batch = $batch;
        return $this;
    }

    /**
     * 数据自动验证
     * @access public
     * @param array     $data  数据
     * @param mixed     $rules  验证规则
     * @param string    $scene 验证场景
     * @return bool
     */
    /**
     * check，验证类的核心方法,用来验证字段。支持传入验证规则,验证场景
     */
    public function check($data, $rules = [], $scene = '')
    {
        //验证失败,错误信息清零
        $this->error = [];
        //验证规则,为空取默认
        if (empty($rules)) {
            // 读取验证规则
            $rules = $this->rule;
        }

        // 分析验证规则
        //获取验证场景，传参验证场景
        $scene = $this->getScene($scene);
        //如果场景为空,输出空数组,也是按照场景的规则走
        if (is_array($scene)) {
            // 处理场景验证字段
            $change = [];
            $array  = [];
            foreach ($scene as $k => $val) {
                if (is_numeric($k)) {
                    $array[] = $val;
                } else {
                    $array[]    = $k;
                    $change[$k] = $val;
                }
            }
            //场景为空,场景验证字段都为空
        }
        //开始验证,遍历验证规则
        foreach ($rules as $key => $item) {
//=======================判断验证规则的两种写法,取验证=================================
            if (is_numeric($key)) {
                // [field,rule1|rule2,msg1|msg2]
                $key  = $item[0];
                $rule = $item[1];
                if (isset($item[2])) {
                    $msg = is_string($item[2]) ? explode('|', $item[2]) : $item[2];
                } else {
                    $msg = [];
                }
            //字段对规则默认无法写报错信息，拿到了验证规则
            } else {
                $rule = $item;
                $msg  = [];
            }
//======================================取字段描述==================================
//两个过程，先取规则定义中的写法,如果没有,取当前注册的，如果没注册,取当前key
            if (strpos($key, '|')) {
                // 字段|描述 用于指定属性名称
                //$title字段描述
                list($key, $title) = explode('|', $key);
            } else {
                $title = isset($this->field[$key]) ? $this->field[$key] : $key;
            }
//===================================场景验证=======================================
//也就是利用场景,从许多规则中取出当前的场景需要的验证规则
            // 场景检测
            if (!empty($scene)) {
                if ($scene instanceof \Closure && !call_user_func_array($scene, [$key, $data])) {
                    continue;
                } elseif (is_array($scene)) {
                    if (!in_array($key, $array)) {
                        continue;
                    } elseif (isset($change[$key])) {
                        // 重载某个验证规则
                        $rule = $change[$key];
                    }
                }
            }
//============================之前的准备工作完成,开始验证============================
            // 获取数据 支持二维数组
            //获取需要验证的数据
            $value = $this->getDataValue($data, $key);
            //$rule这个验证规则是不是回调函数,如果是回调函数直接调用函数,如果不是,其他验证方法验证
            // 字段验证
            if ($rule instanceof \Closure) {
                // 匿名函数验证 支持传入当前字段和所有字段两个数据
                $result = call_user_func_array($rule, [$value, $data]);
            } else {
                $result = $this->checkItem($key, $value, $rule, $data, $title, $msg);
            }

            if (true !== $result) {
                // 没有返回true 则表示验证失败
                if (!empty($this->batch)) {
                    // 批量验证
                    if (is_array($result)) {
                        $this->error = array_merge($this->error, $result);
                    } else {
                        $this->error[$key] = $result;
                    }
                } else {
                    $this->error = $result;
                    return false;
                }
            }
        }
        return !empty($this->error) ? false : true;
    }

    /**
     * 根据验证规则验证数据
     * @access protected
     * @param  mixed     $value 字段值
     * @param  mixed     $rules 验证规则
     * @return bool
     */
    protected function checkRule($value, $rules)
    {
        if ($rules instanceof \Closure) {
            return call_user_func_array($rules, [$value]);
        } elseif (is_string($rules)) {
            $rules = explode('|', $rules);
        }

        foreach ($rules as $key => $rule) {
            if ($rule instanceof \Closure) {
                $result = call_user_func_array($rule, [$value]);
            } else {
                // 判断验证类型
                list($type, $rule) = $this->getValidateType($key, $rule);

                $callback = isset(self::$type[$type]) ? self::$type[$type] : [$this, $type];

                $result = call_user_func_array($callback, [$value, $rule]);
            }

            if (true !== $result) {
                return $result;
            }
        }

        return true;
    }

    /**
     * 验证单个字段规则
     * @access protected
     * @param string    $field  字段名
     * @param mixed     $value  字段值
     * @param mixed     $rules  验证规则
     * @param array     $data  数据
     * @param string    $title  字段描述
     * @param array     $msg  提示信息
     * @return mixed
     */
    protected function checkItem($field, $value, $rules, $data, $title = '', $msg = [])
    {
        // rule，当前数据的验证规则,支持多个规则,所以要利用|分开
        if (is_string($rules)) {
            $rules = explode('|', $rules);
        }
        $i = 0;
        //rule数组,便利验证每一个规则
        foreach ($rules as $key => $rule) {
            //规则是回调函数,则调用函数
            if ($rule instanceof \Closure) {
                $result = call_user_func_array($rule, [$value, $data]);
                $info   = is_numeric($key) ? '' : $key;
            } else {
            //规则不是回调函数,则默认按照本类的验证
                // 判断验证类型
                list($type, $rule, $info) = $this->getValidateType($key, $rule);
                // 如果不是require 有数据才会行验证
                //info中是否包含require.             //验证的值非null且不等于空
                //也就是有值，或者有require,必须验证。如果没有require或者没有值，则不验证
                if (0 === strpos($info, 'require') || (!is_null($value) && '' !== $value)) {
                    // 验证类型
                    //如果没有自定义的验证类型,取当前的验证类型,本类中的is方法
                    $callback = isset(self::$type[$type]) ? self::$type[$type] : [$this, $type];

                    // 验证数据
                    $result = call_user_func_array($callback, [$value, $rule, $data, $field, $title]);
                } else {
                    //如果有require，则全部验证
                    $result = true;
                }
            }
            if (false === $result) {
                // 验证失败 返回错误信息
                //如果定义了错误信息,
                if (isset($msg[$i])) {
                    $message = $msg[$i];
                    if (is_string($message) && strpos($message, '{%') === 0) {
                        $message = Lang::get(substr($message, 2, -1));
                    }
                } else {
                    $message = $this->getRuleMsg($field, $title, $info, $rule);
                }
                return $message;
            } elseif (true !== $result) {
                // 返回自定义错误信息
                if (is_string($result) && false !== strpos($result, ':')) {
                    $result = str_replace([':attribute', ':rule'], [$title, (string) $rule], $result);
                }
                return $result;
            }
            $i++;
        }
        return $result;
    }

    /**
     * 获取当前验证类型及规则
     * @access public
     * @param  mixed     $key
     * @param  mixed     $rule
     * @return array
     */
    protected function getValidateType($key, $rule)
    {
        // 如果key是整形数字,也就是说规则的另一种写法
        if (!is_numeric($key)) {
            return [$key, $rule, $key];
        }
        //规则中有没有:类似于正则表达式验证这种
        if (strpos($rule, ':')) {
            list($type, $rule) = explode(':', $rule, 2);
            if (isset($this->alias[$type])) {
                // 判断别名
                $type = $this->alias[$type];
            }
            $info = $type;
        //本类中是否存在方法,rule中的验证规则如果是方法
        } elseif (method_exists($this, $rule)) {
            $type = $rule;
            $info = $rule;
            $rule = '';
        } else {
            $type = 'is';
            $info = $rule;
        }
        //配合语言包的报错
        //      is  当前小规则  当前小规则
        return [$type, $rule, $info];
    }

    /**
     * 验证是否和某个字段的值一致
     * @access protected
     * @param mixed     $value 字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @param string    $field 字段名
     * @return bool
     */
    protected function confirm($value, $rule, $data, $field = '')
    {
        if ('' == $rule) {
            if (strpos($field, '_confirm')) {
                $rule = strstr($field, '_confirm', true);
            } else {
                $rule = $field . '_confirm';
            }
        }
        return $this->getDataValue($data, $rule) === $value;
    }

    /**
     * 验证是否和某个字段的值是否不同
     * @access protected
     * @param mixed $value 字段值
     * @param mixed $rule  验证规则
     * @param array $data  数据
     * @return bool
     */
    protected function different($value, $rule, $data)
    {
        return $this->getDataValue($data, $rule) != $value;
    }

    /**
     * 验证是否大于等于某个值
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function egt($value, $rule, $data)
    {
        $val = $this->getDataValue($data, $rule);
        return !is_null($val) && $value >= $val;
    }

    /**
     * 验证是否大于某个值
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function gt($value, $rule, $data)
    {
        $val = $this->getDataValue($data, $rule);
        return !is_null($val) && $value > $val;
    }

    /**
     * 验证是否小于等于某个值
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function elt($value, $rule, $data)
    {
        $val = $this->getDataValue($data, $rule);
        return !is_null($val) && $value <= $val;
    }

    /**
     * 验证是否小于某个值
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function lt($value, $rule, $data)
    {
        $val = $this->getDataValue($data, $rule);
        return !is_null($val) && $value < $val;
    }

    /**
     * 验证是否等于某个值
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function eq($value, $rule)
    {
        return $value == $rule;
    }

    /**
     * 验证字段值是否为有效格式
     * @access protected
     * @param mixed     $value  字段值
     * @param string    $rule  验证规则
     * @param array     $data  验证数据
     * @return bool
     */
    protected function is($value, $rule, $data = [])
    {
        switch ($rule) {
            case 'require':
                // 必须
                //后面加0,是因为empty判断不出来0.看是否是非空,如果为空,有为0的情况,在检查
                $result = !empty($value) || '0' == $value;
                break;
            case 'accepted':
                // 接受
                $result = in_array($value, ['1', 'on', 'yes']);
                break;
            case 'date':
                // 是否是一个有效日期
                $result = false !== strtotime($value);
                break;
            case 'alpha':
                // 只允许字母
                $result = $this->regex($value, '/^[A-Za-z]+$/');
                break;
            case 'alphaNum':
                // 只允许字母和数字
                $result = $this->regex($value, '/^[A-Za-z0-9]+$/');
                break;
            case 'alphaDash':
                // 只允许字母、数字和下划线 破折号
                $result = $this->regex($value, '/^[A-Za-z0-9\-\_]+$/');
                break;
            case 'chs':
                // 只允许汉字
                $result = $this->regex($value, '/^[\x{4e00}-\x{9fa5}]+$/u');
                break;
            case 'chsAlpha':
                // 只允许汉字、字母
                $result = $this->regex($value, '/^[\x{4e00}-\x{9fa5}a-zA-Z]+$/u');
                break;
            case 'chsAlphaNum':
                // 只允许汉字、字母和数字
                $result = $this->regex($value, '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]+$/u');
                break;
            case 'chsDash':
                // 只允许汉字、字母、数字和下划线_及破折号-
                $result = $this->regex($value, '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9\_\-]+$/u');
                break;
            case 'activeUrl':
                // 是否为有效的网址
                $result = checkdnsrr($value);
                break;
            case 'ip':
                // 是否为IP地址
                $result = $this->filter($value, [FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6]);
                break;
            case 'url':
                // 是否为一个URL地址
                $result = $this->filter($value, FILTER_VALIDATE_URL);
                break;
            case 'float':
                // 是否为float
                $result = $this->filter($value, FILTER_VALIDATE_FLOAT);
                break;
            case 'number':
                $result = is_numeric($value);
                break;
            case 'integer':
                // 是否为整型
                $result = $this->filter($value, FILTER_VALIDATE_INT);
                break;
            case 'email':
                // 是否为邮箱地址
                $result = $this->filter($value, FILTER_VALIDATE_EMAIL);
                break;
            case 'boolean':
                // 是否为布尔值
                $result = in_array($value, [true, false, 0, 1, '0', '1'], true);
                break;
            case 'array':
                // 是否为数组
                $result = is_array($value);
                break;
            case 'file':
                $result = $value instanceof File;
                break;
            case 'image':
                $result = $value instanceof File && in_array($this->getImageType($value->getRealPath()), [1, 2, 3, 6]);
                break;
            case 'token':
                $result = $this->token($value, '__token__', $data);
                break;
            default:
                if (isset(self::$type[$rule])) {
                    // 注册的验证规则
                    $result = call_user_func_array(self::$type[$rule], [$value]);
                } else {
                    // 正则验证
                    $result = $this->regex($value, $rule);
                }
        }
        return $result;
    }

    // 判断图像类型
    protected function getImageType($image)
    {
        if (function_exists('exif_imagetype')) {
            return exif_imagetype($image);
        } else {
            try {
                $info = getimagesize($image);
                return $info ? $info[2] : false;
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    /**
     * 验证是否为合格的域名或者IP 支持A，MX，NS，SOA，PTR，CNAME，AAAA，A6， SRV，NAPTR，TXT 或者 ANY类型
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function activeUrl($value, $rule)
    {
        if (!in_array($rule, ['A', 'MX', 'NS', 'SOA', 'PTR', 'CNAME', 'AAAA', 'A6', 'SRV', 'NAPTR', 'TXT', 'ANY'])) {
            $rule = 'MX';
        }
        return checkdnsrr($value, $rule);
    }

    /**
     * 验证是否有效IP
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则 ipv4 ipv6
     * @return bool
     */
    protected function ip($value, $rule)
    {
        if (!in_array($rule, ['ipv4', 'ipv6'])) {
            $rule = 'ipv4';
        }
        return $this->filter($value, [FILTER_VALIDATE_IP, 'ipv6' == $rule ? FILTER_FLAG_IPV6 : FILTER_FLAG_IPV4]);
    }

    /**
     * 验证上传文件后缀
     * @access protected
     * @param mixed     $file  上传文件
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function fileExt($file, $rule)
    {
        if (is_array($file)) {
            foreach ($file as $item) {
                if (!($item instanceof File) || !$item->checkExt($rule)) {
                    return false;
                }
            }
            return true;
        } elseif ($file instanceof File) {
            return $file->checkExt($rule);
        } else {
            return false;
        }
    }

    /**
     * 验证上传文件类型
     * @access protected
     * @param mixed     $file  上传文件
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function fileMime($file, $rule)
    {
        if (is_array($file)) {
            foreach ($file as $item) {
                if (!($item instanceof File) || !$item->checkMime($rule)) {
                    return false;
                }
            }
            return true;
        } elseif ($file instanceof File) {
            return $file->checkMime($rule);
        } else {
            return false;
        }
    }

    /**
     * 验证上传文件大小
     * @access protected
     * @param mixed     $file  上传文件
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function fileSize($file, $rule)
    {
        if (is_array($file)) {
            foreach ($file as $item) {
                if (!($item instanceof File) || !$item->checkSize($rule)) {
                    return false;
                }
            }
            return true;
        } elseif ($file instanceof File) {
            return $file->checkSize($rule);
        } else {
            return false;
        }
    }

    /**
     * 验证图片的宽高及类型
     * @access protected
     * @param mixed     $file  上传文件
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function image($file, $rule)
    {
        if (!($file instanceof File)) {
            return false;
        }
        if ($rule) {
            $rule                        = explode(',', $rule);
            list($width, $height, $type) = getimagesize($file->getRealPath());
            if (isset($rule[2])) {
                $imageType = strtolower($rule[2]);
                if ('jpeg' == $imageType) {
                    $imageType = 'jpg';
                }
                if (image_type_to_extension($type, false) != $imageType) {
                    return false;
                }
            }

            list($w, $h) = $rule;
            return $w == $width && $h == $height;
        } else {
            return in_array($this->getImageType($file->getRealPath()), [1, 2, 3, 6]);
        }
    }

    /**
     * 验证请求类型
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function method($value, $rule)
    {
        $method = Request::instance()->method();
        return strtoupper($rule) == $method;
    }

    /**
     * 验证时间和日期是否符合指定格式
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function dateFormat($value, $rule)
    {
        $info = date_parse_from_format($rule, $value);
        return 0 == $info['warning_count'] && 0 == $info['error_count'];
    }

    /**
     * 验证是否唯一
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则 格式：数据表,字段名,排除ID,主键名
     * @param array     $data  数据
     * @param string    $field  验证字段名
     * @return bool
     */
    protected function unique($value, $rule, $data, $field)
    {
        if (is_string($rule)) {
            $rule = explode(',', $rule);
        }
        if (false !== strpos($rule[0], '\\')) {
            // 指定模型类
            $db = new $rule[0];
        } else {
            try {
                $db = Loader::model($rule[0]);
            } catch (ClassNotFoundException $e) {
                $db = Db::name($rule[0]);
            }
        }
        $key = isset($rule[1]) ? $rule[1] : $field;

        if (strpos($key, '^')) {
            // 支持多个字段验证
            $fields = explode('^', $key);
            foreach ($fields as $key) {
                $map[$key] = $data[$key];
            }
        } elseif (strpos($key, '=')) {
            parse_str($key, $map);
        } else {
            $map[$key] = $data[$field];
        }

        $pk = isset($rule[3]) ? $rule[3] : $db->getPk();
        if (is_string($pk)) {
            if (isset($rule[2])) {
                $map[$pk] = ['neq', $rule[2]];
            } elseif (isset($data[$pk])) {
                $map[$pk] = ['neq', $data[$pk]];
            }
        }
        if ($db->where($map)->field($pk)->find()) {
            return false;
        }
        return true;
    }

    /**
     * 使用行为类验证
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return mixed
     */
    protected function behavior($value, $rule, $data)
    {
        return Hook::exec($rule, '', $data);
    }

    /**
     * 使用filter_var方式验证
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function filter($value, $rule)
    {
        if (is_string($rule) && strpos($rule, ',')) {
            list($rule, $param) = explode(',', $rule);
        } elseif (is_array($rule)) {
            $param = isset($rule[1]) ? $rule[1] : null;
            $rule  = $rule[0];
        } else {
            $param = null;
        }
        return false !== filter_var($value, is_int($rule) ? $rule : filter_id($rule), $param);
    }

    /**
     * 验证某个字段等于某个值的时候必须
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function requireIf($value, $rule, $data)
    {
        list($field, $val) = explode(',', $rule);
        if ($this->getDataValue($data, $field) == $val) {
            return !empty($value) || '0' == $value;
        } else {
            return true;
        }
    }

    /**
     * 通过回调方法验证某个字段是否必须
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function requireCallback($value, $rule, $data)
    {
        $result = call_user_func_array($rule, [$value, $data]);
        if ($result) {
            return !empty($value) || '0' == $value;
        } else {
            return true;
        }
    }

    /**
     * 验证某个字段有值的情况下必须
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function requireWith($value, $rule, $data)
    {
        $val = $this->getDataValue($data, $rule);
        if (!empty($val)) {
            return !empty($value) || '0' == $value;
        } else {
            return true;
        }
    }

    /**
     * 验证是否在范围内
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function in($value, $rule)
    {
        return in_array($value, is_array($rule) ? $rule : explode(',', $rule));
    }

    /**
     * 验证是否不在某个范围
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function notIn($value, $rule)
    {
        return !in_array($value, is_array($rule) ? $rule : explode(',', $rule));
    }

    /**
     * between验证数据
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function between($value, $rule)
    {
        if (is_string($rule)) {
            $rule = explode(',', $rule);
        }
        list($min, $max) = $rule;
        return $value >= $min && $value <= $max;
    }

    /**
     * 使用notbetween验证数据
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function notBetween($value, $rule)
    {
        if (is_string($rule)) {
            $rule = explode(',', $rule);
        }
        list($min, $max) = $rule;
        return $value < $min || $value > $max;
    }

    /**
     * 验证数据长度
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function length($value, $rule)
    {
        if (is_array($value)) {
            $length = count($value);
        } elseif ($value instanceof File) {
            $length = $value->getSize();
        } else {
            $length = mb_strlen((string) $value);
        }

        if (strpos($rule, ',')) {
            // 长度区间
            list($min, $max) = explode(',', $rule);
            return $length >= $min && $length <= $max;
        } else {
            // 指定长度
            return $length == $rule;
        }
    }

    /**
     * 验证数据最大长度
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function max($value, $rule)
    {
        if (is_array($value)) {
            $length = count($value);
        } elseif ($value instanceof File) {
            $length = $value->getSize();
        } else {
            $length = mb_strlen((string) $value);
        }
        return $length <= $rule;
    }

    /**
     * 验证数据最小长度
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function min($value, $rule)
    {
        if (is_array($value)) {
            $length = count($value);
        } elseif ($value instanceof File) {
            $length = $value->getSize();
        } else {
            $length = mb_strlen((string) $value);
        }
        return $length >= $rule;
    }

    /**
     * 验证日期
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function after($value, $rule, $data)
    {
        return strtotime($value) >= strtotime($rule);
    }

    /**
     * 验证日期
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function before($value, $rule, $data)
    {
        return strtotime($value) <= strtotime($rule);
    }

    /**
     * 验证日期字段
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function afterWith($value, $rule, $data)
    {
        $rule = $this->getDataValue($data, $rule);
        return !is_null($rule) && strtotime($value) >= strtotime($rule);
    }

    /**
     * 验证日期字段
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function beforeWith($value, $rule, $data)
    {
        $rule = $this->getDataValue($data, $rule);
        return !is_null($rule) && strtotime($value) <= strtotime($rule);
    }

    /**
     * 验证有效期
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @return bool
     */
    protected function expire($value, $rule)
    {
        if (is_string($rule)) {
            $rule = explode(',', $rule);
        }
        list($start, $end) = $rule;
        if (!is_numeric($start)) {
            $start = strtotime($start);
        }

        if (!is_numeric($end)) {
            $end = strtotime($end);
        }
        return $_SERVER['REQUEST_TIME'] >= $start && $_SERVER['REQUEST_TIME'] <= $end;
    }

    /**
     * 验证IP许可
     * @access protected
     * @param string    $value  字段值
     * @param mixed     $rule  验证规则
     * @return mixed
     */
    protected function allowIp($value, $rule)
    {
        return in_array($_SERVER['REMOTE_ADDR'], is_array($rule) ? $rule : explode(',', $rule));
    }

    /**
     * 验证IP禁用
     * @access protected
     * @param string    $value  字段值
     * @param mixed     $rule  验证规则
     * @return mixed
     */
    protected function denyIp($value, $rule)
    {
        return !in_array($_SERVER['REMOTE_ADDR'], is_array($rule) ? $rule : explode(',', $rule));
    }

    /**
     * 使用正则验证数据
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则 正则规则或者预定义正则名
     * @return mixed
     */
    protected function regex($value, $rule)
    {
        if (isset($this->regex[$rule])) {
            $rule = $this->regex[$rule];
        }
        if (0 !== strpos($rule, '/') && !preg_match('/\/[imsU]{0,4}$/', $rule)) {
            // 不是正则表达式则两端补上/
            $rule = '/^' . $rule . '$/';
        }
        return is_scalar($value) && 1 === preg_match($rule, (string) $value);
    }

    /**
     * 验证表单令牌
     * @access protected
     * @param mixed     $value  字段值
     * @param mixed     $rule  验证规则
     * @param array     $data  数据
     * @return bool
     */
    protected function token($value, $rule, $data)
    {
        $rule = !empty($rule) ? $rule : '__token__';
        if (!isset($data[$rule]) || !Session::has($rule)) {
            // 令牌数据无效
            return false;
        }

        // 令牌验证
        if (isset($data[$rule]) && Session::get($rule) === $data[$rule]) {
            // 防止重复提交
            Session::delete($rule); // 验证完成销毁session
            return true;
        }
        // 开启TOKEN重置
        Session::delete($rule);
        return false;
    }

    // 获取错误信息
    public function getError()
    {
        return $this->error;
    }

    /**
     * 获取数据值
     * @access protected
     * @param array $data 数据
     * @param string $key 数据标识 支持二维
     * @return mixed
     */
    protected function getDataValue($data, $key)
    {
        if (is_numeric($key)) {
            $value = $key;
        } elseif (strpos($key, '.')) {
            // 支持二维数组验证
            list($name1, $name2) = explode('.', $key);
            $value               = isset($data[$name1][$name2]) ? $data[$name1][$name2] : null;
        } else {
            //利用key去除当前需要验证的数据，同key
            $value = isset($data[$key]) ? $data[$key] : null;
        }
        return $value;
    }

    /**
     * 获取验证规则的错误提示信息
     * @access protected
     * @param string    $attribute  字段英文名
     * @param string    $title  字段描述名
     * @param string    $type  验证规则名称
     * @param mixed     $rule  验证规则数据
     * @return string
     */
    protected function getRuleMsg($attribute, $title, $type, $rule)
    {
        if (isset($this->message[$attribute . '.' . $type])) {
            $msg = $this->message[$attribute . '.' . $type];
        } elseif (isset($this->message[$attribute][$type])) {
            $msg = $this->message[$attribute][$type];
        } elseif (isset($this->message[$attribute])) {
            $msg = $this->message[$attribute];
        } elseif (isset(self::$typeMsg[$type])) {
            $msg = self::$typeMsg[$type];
        } elseif (0 === strpos($type, 'require')) {
            $msg = self::$typeMsg['require'];
        } else {
            $msg = $title . Lang::get('not conform to the rules');
        }
        if (is_string($msg) && 0 === strpos($msg, '{%')) {
            $msg = Lang::get(substr($msg, 2, -1));
        } elseif (Lang::has($msg)) {
            $msg = Lang::get($msg);
        }

        if (is_string($msg) && is_scalar($rule) && false !== strpos($msg, ':')) {
            // 变量替换
            if (is_string($rule) && strpos($rule, ',')) {
                $array = array_pad(explode(',', $rule), 3, '');
            } else {
                $array = array_pad([], 3, '');
            }
            $msg = str_replace(
                [':attribute', ':rule', ':1', ':2', ':3'],
                [$title, (string) $rule, $array[0], $array[1], $array[2]],
                $msg);
        }
        return $msg;
    }

    /**
     * 获取数据验证的场景
     * @access protected
     * @param string $scene  验证场景
     * @return array
     */
    protected function getScene($scene = '')
    {
        //场景为空,取当前场景，如果当前场景为空,则取空数组
        if (empty($scene)) {
            // 读取指定场景
            $scene = $this->currentScene;
        }
        //场景非空且当前场景已定义
        if (!empty($scene) && isset($this->scene[$scene])) {
            // 如果设置了验证适用场景
            $scene = $this->scene[$scene];
            if (is_string($scene)) {
                $scene = explode(',', $scene);
            }
        } else {
            $scene = [];
        }
        //如果没有定义场景,输出空数组
        return $scene;
    }

    public static function __callStatic($method, $params)
    {
        $class = self::make();
        if (method_exists($class, $method)) {
            return call_user_func_array([$class, $method], $params);
        } else {
            throw new \BadMethodCallException('method not exists:' . __CLASS__ . '->' . $method);
        }
    }
}
