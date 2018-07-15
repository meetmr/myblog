

#创建blog表
CREATE DATABASE myblog;
#选中 myblog 表
use myblog;

#创建网站设置表
CREATE TABLE setup(
  setup_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT 'id',
  website_name VARCHAR(50) NOT NULL COMMENT '网站名称',
  icp_code VARCHAR(50) NOT NULL COMMENT 'PIC 备案号',
  mailbox VARCHAR(50) NOT NULL COMMENT '网站邮件',
  address VARCHAR(50) NOT NULL COMMENT '网站地址',
  amount INT UNSIGNED NOT NULL COMMENT '网站访问量',
  web_time INT UNSIGNED NOT NULL COMMENT '网站上线时间',
  notice VARCHAR (255)COMMENT '网站公告',
  inc_pic VARCHAR(225) COMMENT '网站图标'
)  ENGINE=InnoDB DEFAULT CHARSET=utf8;


#创建用户表
CREATE TABLE user(
  user_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT 'id',
  user_user VARCHAR(20) NOT NULL COMMENT '登陆名',
  user_name VARCHAR(20) NOT NULL COMMENT '姓名',
  user_pwd VARCHAR(124) NOT NULL COMMENT '登陆密码',
  user_Birthday VARCHAR(50) NOT NULL COMMENT '用户生日',
  user_phone VARCHAR(15) NOT NULL COMMENT '用户电话',
  user_admin INT(1) NOT NULL DEFAULT 0 COMMENT '管理权限',
  user_pic VARCHAR(124) NOT NULL COMMENT '头像地址',
  user_meg TEXT NOT NULL COMMENT '个人信息',
  user_mail VARCHAR(50) NOT NULL COMMENT '用户邮件',
  user_qq VARCHAR(11) NOT NULL  COMMENT 'qq',
  user_time INT UNSIGNED NOT NULL COMMENT '注册时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
#创建栏目表

CREATE TABLE class(
  col_id  INT UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT 'id',
  col_content VARCHAR(20) NOT NULL COMMENT '栏目名称',
  col_message VARCHAR(40) NULL NULL COMMENT '栏目描述'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#创建文章表
CREATE TABLE article(
  art_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT 'id',
  col_id INT UNSIGNED NOT NULL COMMENT '栏目id',
  user_id INT UNSIGNED NOT NULL COMMENT '发布人id',
  art_title VARCHAR(50) NOT NULL COMMENT '文章标题',
  art_content TEXT COMMENT '文章内容',
  art_cover VARCHAR(255) NOT NULL COMMENT '文章封面',
  art_num INT NOT NULL DEFAULT 0 COMMENT '点击量',
  aer_time INT NOT NULL COMMENT '发布时间',
  art_name VARCHAR(20)   NOT NULL COMMENT '发布人',

)ENGINE=InnoDB DEFAULT CHARSET=utf8;

#创建评论表
CREATE TABLE discuss(
  dis_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT 'id',
  art_id INT UNSIGNED NOT NULL COMMENT '文章id',
  dis_name VARCHAR(20) NOT NULL COMMENT '评论姓名',
  dis_content TEXT NOT NULL COMMENT '评论内容',
  dis_pic VARCHAR(124) NOT NULL COMMENT '评论头像',
  dis_tiem INT UNSIGNED NOT NULL COMMENT '评论时间'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

#创建留言表
CREATE TABLE messgae(
  me_id  INT UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT 'id',
  me_name VARCHAR(20) NOT NULL COMMENT '留言姓名',
  me_content TEXT NOT NULL COMMENT '留言内容',
  me_pic VARCHAR(124) NOT NULL COMMENT '留言头像',
  me_tiem INT UNSIGNED NOT NULL COMMENT '留言时间'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

#创建友情连接表

CREATE TABLE connect(
  ct_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT 'id',
  ct_content VARCHAR(30) NOT NULL COMMENT '链接名称',
  ct_url VARCHAR (200) NOT NULL COMMENT 'URL',
  ct_msg VARCHAR (20) NOT NULL  COMMENT '站点描述'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;