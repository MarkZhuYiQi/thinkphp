<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public $items='';       //全局存放一个数组集合
    public $menu='';
    public $main='
        <ul class="sidebar-menu">
            <li class="header">主菜单</li>
            {main}
        </ul>
    ';
    public $mainItem='
        <li class="treeview">{mainItem}</li>
    ';
    public $childMain='
        <li>
            <a href="{href}">
                <i class="fa fa-dashboard"></i> <span>{nodename}</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            {child}
        </li>
    ';
    public $child='
        <ul class="treeview-menu">{children}</ul>
    ';

    public $item='
        <li><a href="{href}"><i class="fa fa-circle-o"></i>{nodename}</a></li>
    ';

    public function index(){
        $this->display();
    }

    /**
     * 递归子菜单方法
     * 最终获得一个菜单数组
     */
    public function sidebar()
    {
        $sidebar=M('usernode');
        $this->items=$sidebar->select();
//        var_export($this->items);
        $this->menu=$this->_sidebarOutput();
//        echo "sidebarDetail=".json_encode($menu).";";
        var_export($this->menu);
//        $this->genSidebar();
        exit();
    }

    /**
     * 初级循环，找到根节点
     * @return array
     */
    public function _sidebarOutput()
    {
        //循环原数组
        foreach($this->items as $key=>$value)
        {
            //如果成员的pid为0说明是根目录
            if($value['node_pid']==0)
            {
                //删除该节点
                unset($this->items[$key]);
                //使用该节点去寻找其子节点。
                $menu[]=$this->_buildMenuTree($value,$value['node_id']);
            }
        }
        return $menu;
    }

    /**
     * 递归主函数，先根据根节点寻找子节点，子节点集合存在value的child子成员中，
     * 然后开始递归，循环子成员数组，对自成员再一次做一个子节点寻找。
     * 如果找到了就把子节点的子节点放到子节点的child成员中，如果没有比进行任何操作。
     * @param $value
     * @param $id
     * @return mixed
     */
    public function _buildMenuTree($value,$id)
    {
        //根据根节点的id去寻找子节点并放进value中,到这一步就有2层菜单了
        $childs=$this->_getChildMenu($value,$id);

        //如果2级菜单有子节点
        if(isset($childs['child']))
        {
            //循环所有2级菜单子节点，以这些子节点作为根节点再去寻找他们的子节点
            foreach($childs['child'] as $k=>$v)
            {
                $children=$this->_buildMenuTree($v,$v['node_id']);
                if($children['child']!=null)
                {
                    //如果寻找到子节点就再放进去。
                    $childs['child'][$k]['child']=$children;
                }
            }
        }
//        var_export($childs);
        return $childs;
    }

    /**
     * 根据父节点查找是否有子节点，子节点保存到child子数组中
     * @param $value    上级菜单的内容
     * @param $id       上级菜单的id，作为下级菜单的pid
     * @return mixed
     */
    public function _getChildMenu($value,$id)
    {
        foreach($this->items as $k=>$v)
        {
            if($v['node_pid']==$id)
            {
                unset($this->items[$k]);
                $value['child'][]=$v;
            }
        }
        return $value;
    }

    public function genSidebar(){
        $display=$this->main;
        foreach($this->menu as $items){
            if(is_array($items))
            {
                //这里传递过去的是每个根目录
                $this->_genChild($items);
            }
        }
    }
    public function _genChild($items){
//        var_export($items);
        //判断主目录是否有子节点
        if(key_exists('child',$items))
        {
            $this->_genChild($items['child']);
        }else{
            echo $this->replaceTpl($items,$this->item);
        }
    }
    public function replaceTpl($item,$tpl){
        foreach($item as $key => $value)
        {
            $tpl=preg_replace('/'.$key.'/',$value,$tpl);
        }
        return $tpl;
    }

}




?>
<meta charset="utf-8">
<li class="treeview">
    <a href="#">
        <i class="fa fa-share"></i> <span>Multilevel</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
        <li>
            <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
    </ul>
</li>