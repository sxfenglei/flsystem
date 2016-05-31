 <?php
 /**
  * 公共函数
  * @author sxfenglei
  * @email sxfenglei@vip.qq.com
  * @github https://github.com/sxfenglei/flsystem
  */

  /**
  * 验证码校验
  */
 function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

/**
* 生成指定位数的随机字符串
* echo getRandChar(8);
*/
function getRandChar($length=8){
   $str = null;
   $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
   $max = strlen($strPol)-1;

   for($i=0;$i<$length;$i++){
    $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
   }

   return $str;
}
/**
* 密码加密
*/
function pwdEncrypt($pwd,$salt){
    return md5(md5($pwd).$salt);
}
//--------------------

 /**
 * 根据身份证号码返回年龄 周岁
 * @param  [type] $id [description]
 * @return [type]     [description]
 *  echo getAgeByID('610122198706011234');
 */
function getAgeByID($id){
//过了这年的生日才算多了1周岁
if(empty($id)) return '';
$date=strtotime(substr($id,6,8));
//获得出生年月日的时间戳
$today=strtotime('today');
//获得今日的时间戳
$diff=floor(($today-$date)/86400/365);
//得到两个日期相差的大体年数
//strtotime加上这个年数后得到那日的时间戳后与今日的时间戳相比
$age=strtotime(substr($id,6,8).' +'.$diff.'years')>$today?($diff+1):$diff;
return $age;
}

/**
 * 返回给定时间的当月最大天数
 * @param string $Date 需要与当前时间比较的时间字符串 2015-03-15
 * @return int 天数
 */
function returnMaxDayOfMonth($Date2 = ''){
        import('ORG.Util.Date');// 导入日期类
        $Date = new Date('Y-m-d');
        if(empty($Date2)){
            $Date2 = new Date('Y-m-d');
        }else{
            $Date2 = new Date($Date2);
        }
        return $Date2->maxDayOfMonth(); // 计算当月的最大天数
}
/**
 * 字符串截取
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
  if(function_exists("mb_substr")){
              if($suffix)
              return mb_substr($str, $start, $length, $charset)."...";
              else
                   return mb_substr($str, $start, $length, $charset);
         }
         elseif(function_exists('iconv_substr')) {
             if($suffix)
                  return iconv_substr($str,$start,$length,$charset)."...";
             else
                  return iconv_substr($str,$start,$length,$charset);
         }
         $re['utf-8']   = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef]
                  [x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
         $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
         $re['gbk']    = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
         $re['big5']   = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
         preg_match_all($re[$charset], $str, $match);
         $slice = join("",array_slice($match[0], $start, $length));
         if($suffix) return $slice."......";
         return $slice;
}
/**
 * 生成唯一订单编号
 */
function build_order_no(){
    //短
    // return date('ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 4);
    return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}



/**
 * 用户角色
 */
function getAuleGroup($id='',$field='title'){
    if(empty($id)){
        return '';
    }
    $model = M('AuthGroupAccess');
    $map['uid'] = array('eq',$id);
    $res = $model->where($map)->find();
    if($res){
        return getField($res['group_id'],$field,'AuthGroup');
    }else{
        return false;
    }
}
/**
  * 权限验证
  * @param rule string|array  需要验证的规则列表,支持逗号分隔的权限规则或索引数组
  * @param uid  int           认证用户的id
  * @param string mode        执行check的模式
  * @param relation string    如果为 'or' 表示满足任一条规则即通过验证;如果为 'and'则表示需满足所有规则才能通过验证
  * @return boolean           通过验证返回true;失败返回false
 */
function authCheck($rule,$uid,$type=1, $mode='url', $relation='or'){
    //超级管理员跳过验证
    $auth=new \Think\Auth();
    //获取当前uid所在的角色组id
    $groups=$auth->getGroups($uid);
    // var_dump($rule);
    // echo 'uid='.$uid;
    // var_dump($auth->check($rule,$uid,$type,$mode,$relation));die();
    //这里偷懒了,因为我设置的是一个用户对应一个角色组,所以直接取值.如果是对应多个角色组的话,需另外处理
    //if(in_array($groups[0]['id'], C('ADMINISTRATOR'))){
    if(in_array($uid, C('ADMINISTRATOR'))){
        return true;
    }else{
        return $auth->check($rule,$uid,$type,$mode,$relation)?true:false;
    }
}

/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function list_to_tree($list, $pk='id', $pid = 'parent_id', $child = '_child', $root = 0) {
    // 创建Tree
    $tree = array();
    if(is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId =  $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 将list_to_tree的树还原成列表
 * @param  array $tree  原来的树
 * @param  string $child 孩子节点的键
 * @param  string $order 排序显示的键，一般是主键 升序排列
 * @param  array  $list  过渡用的中间数组，
 * @return array        返回排过序的列表数组
 * @author yangweijie <yangweijiester@gmail.com>
 */
function tree_to_list($tree, $child = '_child', $order='id', &$list = array()){
    if(is_array($tree)) {
        $refer = array();
        foreach ($tree as $key => $value) {
            $reffer = $value;
            if(isset($reffer[$child])){
                unset($reffer[$child]);
                tree_to_list($value[$child], $child, $order, $list);
            }
            $list[] = $reffer;
        }
        $list = list_sort_by($list, $order, $sortby='asc');
    }
    return $list;
}

/**
 * 获取排序后的分类
 * @param  [type]  $data  [description]
 * @param  integer $pid   [description]
 * @param  string  $html  [description]
 * @param  integer $level [description]
 * @return [type]         [description]
 */
function getCategoryTree($data,$pid=0,$html="|---",$level=0){
    $temp = array();
    foreach ($data as $k => $v) {
        if($v['parent_id'] == $pid){

            $str = str_repeat($html, $level);
            $v['html'] = $str;
            $temp[] = $v;

            $temp = array_merge($temp,getCategoryTree($data,$v['id'],'|---',$level+1));
        }

    }
    return $temp;
}

//--------------------
/**
* 返回数组的维度
* @param [type] $arr [description]
* @return [type] [description]
*/
function arrayLevel($arr){
    $al = array(0);
    aL($arr,$al);
    return max($al);
}
//arrayLevel()子函数
function aL($arr,&$al,$level=0){
    if(is_array($arr)){
        $level++;
        $al[] = $level;
        foreach($arr as $v){
             aL($v,$al,$level);
        }
    }
}

/**
* 判断数组key键是否为数字
*/
function arrayKeyIsNum($arr){
    if(!is_array($arr)){
        return false;
    }
    $keys = array_keys($arr);
    $tag = false;
    foreach ($keys as $k => $v) {
        if(is_numeric($v)){
            $tag = true;
            break;
        }
    }
    return $tag;
}

/**
* 公共输出
* @param int $code 错误代码标识
* @param string $msg 错误信息描述
* @param array $data 要返回的数据
*/
function showReturn($code=-1,$msg='',$data=''){

    $resData = '';
    if(is_numeric($code)){
        if(is_integer($code)){
            $code = "$code";
        }
    }else{
        $code = -1;
    }

    if(is_array($data)){
        //一维数组
        if(arrayLevel($data)==1 && !arrayKeyIsNum($data) ){
            $resData = array_merge(array("code"=>$code,"msg"=>$msg),$data);
        }else{
            //数组
            $resData = array(
                "code"=>$code,
                "msg"=>$msg,
                "list"=>$data
            );
        }

    }else{
        //字符串
        $resData = array(
            "code"=>$code,
            "msg"=>$msg
        );
        if(!empty($data)){
            $resData = array_merge($resData,array("data"=>$data));
        }
    }
    echo json_encode($resData,JSON_UNESCAPED_UNICODE);
    exit;
}
//--------------------
/**
 * 根据id，返回数据
 */
function getField($id,$field,$table){
    if(empty($id) || empty($table)){
        return '';
    }
    if(empty($field)){
        return M($table)->where(array('id'=>array('eq',$id)))->find();
    }else{
        return M($table)->where(array('id'=>array('eq',$id)))->getField($field);
    }
}
