<?php
/**
 * vCode(m,n,x,y) m个数字  显示大小为n   边宽x   边高y
 * micxp
 *jb51.net
 */
session_start();
class captcha{
	public $num = 4;
	public $size = 16;
	public $width = 85;
	public $height = 30;
	public function __construct(){
		$this->init($this->num,$this->size,$this->width,$this->height);
     }
     public function init($num,$size,$width,$height){
         !$width && $width = $num * $size * 4 / 5 + 5;
         !$height && $height = $size + 10;
         // 去掉了 0 1 O l 等
         $str = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVW";
         $code = '';
         for ($i = 0; $i < $num; $i++) {
             $code .= $str[mt_rand(0, strlen($str)-1)];
         }
         // 画图像
         $im = imagecreatetruecolor($width, $height);
         // 定义要用到的颜色
         $back_color = imagecolorallocate($im, 235, 236, 237);
         $boer_color = imagecolorallocate($im, 118, 151, 199);
         $text_color = imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120));
         // 画背景
         imagefilledrectangle($im, 0, 0, $width, $height, $back_color);
         // 画边框
         imagerectangle($im, 0, 0, $width-1, $height-1, $boer_color);
         // 画干扰线
         for($i = 0;$i < 100;$i++) {
             $font_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
             imagearc($im, mt_rand(- $width, $width), mt_rand(- $height, $height), mt_rand(30, $width * 2), mt_rand(20, $height * 2), mt_rand(0, 360), mt_rand(0, 360), $font_color);
         }
         // 画干扰点
         for($i = 0;$i < 100;$i++) {
             $font_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
             imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $font_color);
         }
         // 画验证码
         @imagefttext($im, $size , 3, 15, $size + 13, $text_color, '../public/msyhbd.ttf', $code);
         $_SESSION["VerifyCode"]=$code;
         header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate");
         header("Content-type: image/png;charset=gb2312");
         imagepng($im);
         imagedestroy($im);
	}
}
	new captcha;
?> 