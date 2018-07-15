<?php
class Page
{
    private $total_pages = 100; //总的记录数
    private $pagesize = 2;      //每页显示的记录数
    private $now_page = 1;      //当前是第几页
    private $url = '';          //跳转到哪个页面

    public function __set($p,$v)
    {
        if(property_exists($this, $p)){
            $this->$p = $v;
        }
    }
    public function __get($p)
    {
        return $this->$p;
    }

    //创建分页导航条的方法
    public function create()
    {
        //首页导航按钮
        $first_active = $this->now_page == 1 ? 'active' :'';
        //将来给每一个超链接增加page参数，保存当前的页数
        $url = $this->url.'&page=';
        $first = 1;

        $page = <<<HTML
            <ul class="pagination">
            <li class="$first_active"><a href="$url$first">首页</a></li>
HTML;
        //遍历中间的分页导航按钮
        $total_pages = ceil($this->total_pages / $this-> pagesize);
        //显示当前页的前3页、后3页，例如：当前页是5页               2 3 4 5 6 7 8
        //特殊情况，我们特殊处理，例如：

        for($i=$this->now_page-3;$i<=$this->now_page+3;$i++){
            if($i<2 || $i>$total_pages-1){
                continue;
            }
            $active = $this->now_page == $i ? 'active':'';
            $page .= <<<HTML
            <li class="$active"><a href="$url$i">$i</a></li>
HTML;
        }

        //尾页导航按钮
        $last_active = $this->now_page == $total_pages ? 'active':'';
        $page .= <<<HTML
            <li class="$last_active"><a href="$url$total_pages">尾页</a></li>
        </ul>
HTML;
        return $page;
    }
}