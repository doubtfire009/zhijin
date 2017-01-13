<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 *  global_function_helper.php 公共函数库
 *
 * @author 李之玉 <hn.lizhiyu@163.com>
 */

/**
 * static 文件路径
 * @param string $uri 需要连接的 static文件的路径
 * @return static url
 *
 * 方法介绍：
 *          $realpath = 0 为默认到theme文件夹  如需要具体调用相关
 *
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function static_url($uri = '', $realpath = 0)
{
	$CI = & get_instance();

	//默认的static文件路径
	if ($realpath == 0) {
		if (PLATFORM_DEFAULT_THEME == '') {
			$uri = 'theme/' . $uri;
		} else {
			$uri = 'theme/' . PLATFORM_DEFAULT_THEME . '/' . $uri;
		}
	} else if ($realpath == 1) {
		$uri = 'theme/' . PLATFORM_DEFAULT_THEME . '/yironghe_' . PLATFORM_EXCLUSIVE_THEME . '/' . $uri;
	}
	return $CI->config->base_url($uri);
}

/**
 * 网络路径 与 本地路径
 * @param string $file 文件的路径
 * @param int $realpath 0 网络路径 1 本地路径
 * @return url
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function up_url($file, $realpath = 0)
{
	$CI = & get_instance();
	$up_path = trim($CI->config->item('up_path'), '/');
	if ($realpath == 1) {
		return FCPATH . $up_path . '/' . $file;
	}
	return base_url($CI->config->item('up_path') . trim($file, '/'));
}

/**
 * 获取一级城市
 * @return array
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function province()
{
	$CI = & get_instance();
	$where['parent_id'] = 1;
	$result = $CI->Data_model->getData('base_region', $where);
	if ($result) {
		return $result;
	} else {
		return false;
	}
}

/**
 * 短信发送
 * @param string|array $mobile 手机号
 * @param string $content 短信内容
 * @return boolean
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function send_sms($mobile = '', $content = '')
{

	// 平台用户id
	$Id = '90128';
	// 用户
	$code = 'xloha';
	$pass = 'xloha01';
	$pass = MD5($code . $pass);
	$content = iconv("utf-8", "gbk//ignore", $content);
	$content = urlencode($content);
	if (is_array($mobile)) {
		$mobile = implode(',', $mobile);
	}

	$api = "http://210.5.158.31/hy?uid=".$Id."&auth=".$pass."&mobile=".$mobile."&msg=".$content."&expid=0";

	$res = file_get_contents($api);
	$result = explode(',', $res);
	/**
	 * 参数返回值
	 * 0 成功 -6余额不足 -5 内容过长 -10 内容为空 -11账户无效 -13操作过于频繁 -21 含有屏蔽词语
	 * 
	 * 
	 */

	if ($result[0] == 0) {
		return true;
	} else {

		return false;
	}



}

//手机号的验证
function mobile_check($mobile)
{
	$strlen = strlen($mobile);
	if ($strlen != 11) {
		return false;
	}

	$mobile = trim($mobile);

	$account_preg = '/^((13|14|15|17|18)+)\d{9}$/';
	$account_res = preg_match($account_preg, $mobile);
	if ($account_res) {
		return true;
	} else {
		return false;
	}
}

/**
 * 支持断点下载
 * @param string $fileName 服务器文件路径
 * @param string $fancyName 下载文件名字(默认为服务器文件名)
 * @param type $forceDownload 是否许可用户下载方式(默认可选)
 * @param type $speedLimit 速度限制(默认自动)
 * @param string $contentType 文件类型(默认所有) 
 * @return boolean
 * @author 张月东 <zyd@xinlonghang.cn>
 */
function download_file($fileName, $fancyName = '', $forceDownload = true, $speedLimit = 0, $contentType = '')
{
	if (!is_readable($fileName)) {
		header("HTTP/1.1 404 Not Found");
		return false;
	}

	$fileStat = stat($fileName);
	$lastModified = $fileStat['mtime'];

	$md5 = md5($fileStat['mtime'] . '=' . $fileStat['ino'] . '=' . $fileStat['size']);
	$etag = '"' . $md5 . '-' . crc32($md5) . '"';

	header('Last-Modified: ' . gmdate("D, d M Y H:i:s", $lastModified) . ' GMT');
	header("ETag: $etag");

	if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $lastModified) {
		header("HTTP/1.1 304 Not Modified");
		return true;
	}

	if (isset($_SERVER['HTTP_IF_UNMODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_UNMODIFIED_SINCE']) < $lastModified) {
		header("HTTP/1.1 304 Not Modified");
		return true;
	}

	if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH'] == $etag) {
		header("HTTP/1.1 304 Not Modified");
		return true;
	}

	if ($fancyName == '') {
		$fancyName = basename($fileName);
	}

	if ($contentType == '') {
		$contentType = 'application/octet-stream';
	}

	$fileSize = $fileStat['size'];

	$contentLength = $fileSize;
	$isPartial = false;

	if (isset($_SERVER['HTTP_RANGE'])) {
		if (preg_match('/^bytes=(\d*)-(\d*)$/', $_SERVER['HTTP_RANGE'], $matches)) {
			$startPos = $matches[1];
			$endPos = $matches[2];

			if ($startPos == '' && $endPos == '') {
				return false;
			}

			if ($startPos == '') {
				$startPos = $fileSize - $endPos;
				$endPos = $fileSize - 1;
			} else if ($endPos == '') {
				$endPos = $fileSize - 1;
			}

			$startPos = $startPos < 0 ? 0 : $startPos;
			$endPos = $endPos > $fileSize - 1 ? $fileSize - 1 : $endPos;

			$length = $endPos - $startPos + 1;

			if ($length < 0) {
				return false;
			}

			$contentLength = $length;
			$isPartial = true;
		}
	}

	// send headers
	if ($isPartial) {
		header('HTTP/1.1 206 Partial Content');
		header("Content-Range: bytes $startPos-$endPos/$fileSize");
	} else {
		header("HTTP/1.1 200 OK");
		$startPos = 0;
		$endPos = $contentLength - 1;
	}

	header('Pragma: cache');
	header('Cache-Control: public, must-revalidate, max-age=0');
	header('Accept-Ranges: bytes');
	header('Content-type: ' . $contentType);
	header('Content-Length: ' . $contentLength);

	if ($forceDownload) {
		header('Content-Disposition: attachment; filename="' . rawurlencode($fancyName) . '"');
	}

	header("Content-Transfer-Encoding: binary");

	$bufferSize = 2048;

	if ($speedLimit != 0) {
		$packetTime = floor($bufferSize * 1000000 / $speedLimit);
	}

	$bytesSent = 0;
	$fp = fopen($fileName, "rb");
	fseek($fp, $startPos);
	while ($bytesSent < $contentLength && !feof($fp) && connection_status() == 0) {
		if ($speedLimit != 0) {
			list($usec, $sec) = explode(" ", microtime());
			$outputTimeStart = ((float) $usec + (float) $sec);
		}

		$readBufferSize = $contentLength - $bytesSent < $bufferSize ? $contentLength - $bytesSent : $bufferSize;
		$buffer = fread($fp, $readBufferSize);

		echo $buffer;

		ob_flush();
		flush();

		$bytesSent += $readBufferSize;

		if ($speedLimit != 0) {
			list($usec, $sec) = explode(" ", microtime());
			$outputTimeEnd = ((float) $usec + (float) $sec);

			$useTime = ((float) $outputTimeEnd - (float) $outputTimeStart) * 1000000;
			$sleepTime = round($packetTime - $useTime);
			if ($sleepTime > 0) {
				usleep($sleepTime);
			}
		}
	}
	return true;
}

/**
 * 邮件发送类
 *
 */
function send_email()
{
	// -----------------------------------
	// 邮箱的配置
	// -----------------------------------
}


/*
 * 重写$_SERVER['REQUREST_URI']
 */
function request_uri()
{
    if (isset($_SERVER['REQUEST_URI']))
    {
        $uri = $_SERVER['REQUEST_URI'];
    }
    else
    {
        if (isset($_SERVER['argv']))
        {
            $uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['argv'][0];
        }
        else
        {
            $uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'];
        }
    }
    return $uri;
}


/**
 * 过滤短信的手机号码
 *
 * @param $mobile 要发送的手机号
 * @return boolean
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function sms_not_send($mobile)
{
	$mobile_exclude = array('13816468994', '13166368098');
	if (in_array($mobile, $mobile_exclude)) {
		return true;
	} else {
		return false;
	}
}

/**
 * 格式化时间 当前 int时间 转化 datetime
 * @return datetime time
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function formate_time()
{
	return date('Y-m-d H:i:s', time());
}

/**
 * 判断email格式是否正确
 * @param string $email
 * @return boolean
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function is_email($email)
{
	return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}

/**
 * 手机号的验证
 * @param string $mobile
 * @return boolean
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function is_mobile($mobile)
{
	$strlen = strlen($mobile);
	if ($strlen != 11) {
		return false;
	}
	$mobile = trim($mobile);

	$account_preg = '/^((13|14|15|17|18)+)\d{9}$/';
	$account_res = preg_match($account_preg, $mobile);
	if ($account_res) {
		return true;
	} else {
		return false;
	}
}

/**
 * 检测输入中是否含有错误字符
 *
 * @param char $string 要检查的字符串名称
 * @return boolean
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function is_badword($string)
{
	$badwords = array("\\", '&', ' ', "'", '"', '/', '*', ',', '<', '>', "\r", "\t", "\n", "#");
	foreach ($badwords as $value) {
		if (strpos($string, $value) !== FALSE) {
			return TRUE;
		}
	}
	return FALSE;
}

/**
 * 账号的验证 account  支持 4-16由英文字母数字下划线组成
 * @param string $account
 * @return boolean
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function is_account($account)
{
	$strlen = strlen($account);
	if (is_badword($account) || !preg_match("/^\w{4,16}$/", $account)) {
		return false;
	} elseif (16 < $strlen || $strlen < 4) {
		return false;
	}
	return true;
}

/**
 * 产生随机字符串
 *
 * @param    int        $length  输出长度
 * @param    string     $chars   可选的 ，默认为 0123456789
 * @return   string     字符串
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function random($length, $chars = '0123456789')
{
	$hash = '';
	$max = strlen($chars) - 1;
	for ($i = 0; $i < $length; $i++) {
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}

/**
 * 生成随机字符串
 * @param string $lenth 长度
 * @return string 字符串
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function create_randomstr($lenth = 6)
{
	return random($lenth, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
}

/**
 * 获取请求ip
 *
 * @return ip地址
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function ip()
{
	if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
		$ip = getenv('HTTP_CLIENT_IP');
	} elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	} elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
		$ip = getenv('REMOTE_ADDR');
	} elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return preg_match('/[\d\.]{7,15}/', $ip, $matches) ? $matches [0] : '';
}

/**
 * 字符截取 支持UTF8/GBK
 * @param $string
 * @param $length
 * @param $dot
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function str_cut($string, $length, $dot = '...', $charset = 'utf-8')
{
	$strlen = strlen($string);
	if ($strlen <= $length)
		return $string;
	$string = str_replace(array(' ', '&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array('∵', ' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
	$strcut = '';
	if (strtolower($charset) == 'utf-8') {
		$length = intval($length - strlen($dot) - $length / 3);
		$n = $tn = $noc = 0;
		while ($n < strlen($string)) {
			$t = ord($string[$n]);
			if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1;
				$n++;
				$noc++;
			} elseif (194 <= $t && $t <= 223) {
				$tn = 2;
				$n += 2;
				$noc += 2;
			} elseif (224 <= $t && $t <= 239) {
				$tn = 3;
				$n += 3;
				$noc += 2;
			} elseif (240 <= $t && $t <= 247) {
				$tn = 4;
				$n += 4;
				$noc += 2;
			} elseif (248 <= $t && $t <= 251) {
				$tn = 5;
				$n += 5;
				$noc += 2;
			} elseif ($t == 252 || $t == 253) {
				$tn = 6;
				$n += 6;
				$noc += 2;
			} else {
				$n++;
			}
			if ($noc >= $length) {
				break;
			}
		}
		if ($noc > $length) {
			$n -= $tn;
		}
		$strcut = substr($string, 0, $n);
		$strcut = str_replace(array('∵', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), array(' ', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), $strcut);
	} else {
		$dotlen = strlen($dot);
		$maxi = $length - $dotlen - 1;
		$current_str = '';
		$search_arr = array('&', ' ', '"', "'", '“', '”', '—', '<', '>', '·', '…', '∵');
		$replace_arr = array('&amp;', '&nbsp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;', ' ');
		$search_flip = array_flip($search_arr);
		for ($i = 0; $i < $maxi; $i++) {
			$current_str = ord($string[$i]) > 127 ? $string[$i] . $string[++$i] : $string[$i];
			if (in_array($current_str, $search_arr)) {
				$key = $search_flip[$current_str];
				$current_str = str_replace($search_arr[$key], $replace_arr[$key], $current_str);
			}
			$strcut .= $current_str;
		}
	}
	return $strcut . $dot;
}

/**
 * 获取当前页面完整URL地址
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function get_url()
{
	$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
	$php_self = $_SERVER['PHP_SELF'] ? safe_replace($_SERVER['PHP_SELF']) : safe_replace($_SERVER['SCRIPT_NAME']);
	$path_info = isset($_SERVER['PATH_INFO']) ? safe_replace($_SERVER['PATH_INFO']) : '';
	$relate_url = isset($_SERVER['REQUEST_URI']) ? safe_replace($_SERVER['REQUEST_URI']) : $php_self . (isset($_SERVER['QUERY_STRING']) ? '?' . safe_replace($_SERVER['QUERY_STRING']) : $path_info);
	return $sys_protocal . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url;
}

/**
 * 安全过滤函数
 *
 * @param $string
 * @return string
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function safe_replace($string)
{
	$string = str_replace('%20', '', $string);
	$string = str_replace('%27', '', $string);
	$string = str_replace('%2527', '', $string);
	$string = str_replace('*', '', $string);
	$string = str_replace('"', '&quot;', $string);
	$string = str_replace("'", '', $string);
	$string = str_replace('"', '', $string);
	$string = str_replace(';', '', $string);
	$string = str_replace('<', '&lt;', $string);
	$string = str_replace('>', '&gt;', $string);
	$string = str_replace("{", '', $string);
	$string = str_replace('}', '', $string);
	$string = str_replace('\\', '', $string);
	return $string;
}

/**
 * 格式化文本域内容
 *
 * @param $string 文本域内容
 * @return string
 * @author lal@xinlonghang.cn date 2015-7-22
 */
function trim_textarea($string)
{
	$string = nl2br(str_replace(' ', '&nbsp;', $string));
	return $string;
}

/**
 * 友好的时间显示
 *
 * @param int    $sTime 待显示的时间
 * @param string $type  类型. normal | mohu | full | ymd | other
 * @return string
 * @author lal@xinlonghang.cn date 2015-7-22
 *
 * 	时间格式 time type
 * 	normal
 * 		n秒前 		：$dTime<10s 刚刚  10s<$dTime<60
 * 		n分钟前		: 60s<$dTime < 3600
 * 		n小时前		: 本年 本月 本天 3600s < $dTime 3小时前  
 * 		日期		: 日期一：本年 10月10日 9:10  日期二： 不是本年本月 2013年10月10日 9:10
 * 	mohu 
 * 		n秒前 		：$dTime<60  
 * 		n分钟前		: $dTime<3600
 * 		n小时前		: 本年 本月 本天 3600s < $dTime 3小时前  
 * 		n天前		: 0<$dDay  <7  3天前
 * 		n周前		: 7<$dDay  <30  3周前
 * 		n月前		: 30<$dDay 3月前
 * 	full
 * 		Y-m-d , H:i:s
 * 	ymd
 * 		Y-m-d
 * 	other
 * 		n秒前 		：$dTime<60  
 * 		n分钟前		: $dTime<3600
 * 		n小时前		: 本年 本月 本天 3600s < $dTime 3小时前  
 * 		日期		: Y-m-d H:i:s
 */
function friendly_date($sTime, $type = 'normal')
{

	if (!$sTime) {
		return '';
	}

	//sTime=源时间，cTime=当前时间，dTime=时间差
	$cTime = time();
	$dTime = $cTime - $sTime;
	$dDay = intval(date("z", $cTime)) - intval(date("z", $sTime));
	$dYear = intval(date("Y", $cTime)) - intval(date("Y", $sTime));

	//normal：n秒前，n分钟前，n小时前，日期
	if ($type == 'normal') {
		if ($dTime < 60) {
			if ($dTime < 10) {
				return '刚刚';	//by yangjs
			} else {
				return intval(floor($dTime / 10) * 10) . "秒前";
			}
		} elseif ($dTime < 3600) {
			return intval($dTime / 60) . "分钟前";
			//今天的数据.年份相同.日期相同.
		} elseif ($dYear == 0 && $dDay == 0) {
			return intval($dTime / 3600) . "小时前";
			//return '今天'.date('H:i',$sTime);
		} elseif ($dYear == 0) {
			return date("Y年m月d日 H:i", $sTime);
		} else {
			return date("Y-m-d H:i", $sTime);
		}
		//mohu
	} elseif ($type == 'mohu') {
		if ($dTime < 60) {
			return $dTime . "秒前";
		} elseif ($dTime < 3600) {
			return intval($dTime / 60) . "分钟前";
		} elseif ($dTime >= 3600 && $dDay == 0) {
			return intval($dTime / 3600) . "小时前";
		} elseif ($dDay > 0 && $dDay <= 7) {
			return intval($dDay) . "天前";
		} elseif ($dDay > 7 && $dDay <= 30) {
			return intval($dDay / 7) . '周前';
		} elseif ($dDay > 30) {
			return intval($dDay / 30) . '个月前';
		}
		//full: Y-m-d , H:i:s
	} elseif ($type == 'full') {
		return date("Y-m-d , H:i:s", $sTime);
		//ymd
	} elseif ($type == 'ymd') {
		return date("Y-m-d", $sTime);
		//other
	} else {
		if ($dTime < 60) {
			return $dTime . "秒前";
		} elseif ($dTime < 3600) {
			return intval($dTime / 60) . "分钟前";
		} elseif ($dTime >= 3600 && $dDay == 0) {
			return intval($dTime / 3600) . "小时前";
		} elseif ($dYear == 0) {
			return date("Y-m-d H:i:s", $sTime);
		} else {
			return date("Y-m-d H:i:s", $sTime);
		}
	}
}
/**
 * 加密函数
 *
 * @param string $txt 需要加密的字符串
 * @param string $key 密钥
 * @return string 返回加密结果
 */
function encrypt($txt, $key = ''){
	if (empty($txt)) return $txt;
	if (empty($key)) $key = md5('yirong');
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
	$ikey ="-x6g6ZWm2G9g_vr0Bo.pOq3kRIxsZ6rm";
	$nh1 = rand(0,64);
	$nh2 = rand(0,64);
	$nh3 = rand(0,64);
	$ch1 = $chars{$nh1};
	$ch2 = $chars{$nh2};
	$ch3 = $chars{$nh3};
	$nhnum = $nh1 + $nh2 + $nh3;
	$knum = 0;$i = 0;
	while(isset($key{$i})) $knum +=ord($key{$i++});
	$mdKey = substr(md5(md5(md5($key.$ch1).$ch2.$ikey).$ch3),$nhnum%8,$knum%8 + 16);
	$txt = base64_encode(time().'_'.$txt);
	$txt = str_replace(array('+','/','='),array('-','_','.'),$txt);
	$tmp = '';
	$j=0;$k = 0;
	$tlen = strlen($txt);
	$klen = strlen($mdKey);
	for ($i=0; $i<$tlen; $i++) {
		$k = $k == $klen ? 0 : $k;
		$j = ($nhnum+strpos($chars,$txt{$i})+ord($mdKey{$k++}))%64;
		$tmp .= $chars{$j};
	}
	$tmplen = strlen($tmp);
	$tmp = substr_replace($tmp,$ch3,$nh2 % ++$tmplen,0);
	$tmp = substr_replace($tmp,$ch2,$nh1 % ++$tmplen,0);
	$tmp = substr_replace($tmp,$ch1,$knum % ++$tmplen,0);
	return $tmp;
}

/**
 * 解密函数
 *
 * @param string $txt 需要解密的字符串
 * @param string $key 密匙
 * @return string 字符串类型的返回结果
 */
function decrypt($txt, $key = '', $ttl = 0){
	if (empty($txt)) return $txt;
	if (empty($key)) $key = md5('yirong');

	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
	$ikey ="-x6g6ZWm2G9g_vr0Bo.pOq3kRIxsZ6rm";
	$knum = 0;$i = 0;
	$tlen = @strlen($txt);
	while(isset($key{$i})) $knum +=ord($key{$i++});
	$ch1 = @$txt{$knum % $tlen};
	$nh1 = strpos($chars,$ch1);
	$txt = @substr_replace($txt,'',$knum % $tlen--,1);
	$ch2 = @$txt{$nh1 % $tlen};
	$nh2 = @strpos($chars,$ch2);
	$txt = @substr_replace($txt,'',$nh1 % $tlen--,1);
	$ch3 = @$txt{$nh2 % $tlen};
	$nh3 = @strpos($chars,$ch3);
	$txt = @substr_replace($txt,'',$nh2 % $tlen--,1);
	$nhnum = $nh1 + $nh2 + $nh3;
	$mdKey = substr(md5(md5(md5($key.$ch1).$ch2.$ikey).$ch3),$nhnum % 8,$knum % 8 + 16);
	$tmp = '';
	$j=0; $k = 0;
	$tlen = @strlen($txt);
	$klen = @strlen($mdKey);
	for ($i=0; $i<$tlen; $i++) {
		$k = $k == $klen ? 0 : $k;
		$j = strpos($chars,$txt{$i})-$nhnum - ord($mdKey{$k++});
		while ($j<0) $j+=64;
		$tmp .= $chars{$j};
	}
	$tmp = str_replace(array('-','_','.'),array('+','/','='),$tmp);
	$tmp = trim(base64_decode($tmp));

	if (preg_match("/\d{10}_/s",substr($tmp,0,11))){
		if ($ttl > 0 && (time() - substr($tmp,0,11) > $ttl)){
			$tmp = null;
		}else{
			$tmp = substr($tmp,11);
		}
	}
	return $tmp;
}

require 'html_helper.php';
require 'string_helper.php';

