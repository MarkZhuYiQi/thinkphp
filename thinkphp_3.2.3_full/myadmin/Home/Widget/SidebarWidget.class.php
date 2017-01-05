<?php
/**
 * Created by PhpStorm.
 * User: szl4zsy
 * Date: 1/5/2017
 * Time: 3:46 PM
 */

namespace Home\Widget;
use Think\Controller;

class SidebarWidget extends Controller
{
    public $items='';       //全局存放一个数组集合
    public $menu='';
    /**
     * 递归子菜单方法
     * 最终获得一个菜单数组
     */
    public function sidebar()
    {
        $cache=S(array(
            'type'=>'Memcache',
            'host'=>'223.112.88.211',
            'post'=>'11211',
            'expire'=>'3600'
        ));
        if(!$cache->sidebar)
        {
            $sidebar=M('usernode');
            $this->items=$sidebar->select();
            $this->menu=$this->_sidebarOutput();
            $cache->sidebar="sidebarDetail=eval('".json_encode($this->menu)."');";
        }
        echo $cache->sidebar;
//        exit();
    }

    /**
     * 初级循环，找到根节点
     * @return array
     */
    public function _sidebarOutput()
    {
        $this->sidebar.=$this->main;
        //循环原数组
        foreach($this->items as $key=>$value)
        {
            //如果成员的pid为0说明是根目录
            if($value['node_pid']==0)
            {

                //删除根节点
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
                    //11月23日修改$children=====>$children['child']，因为这个children包含父节点，所以直接放进去会导致父节点重复！！！
                    $childs['child'][$k]['child']=$children['child'];
                }
            }
        }
        return $childs;
    }
    /**
     * 根据父节点查找是否有子节点，子节点保存到child子数组中
     * @param $value    上级菜单的内容
     * @param $id       上级菜单的id，作为下级菜单的pid
     * @return mixed    注意！这里的结果是上级菜单加上该菜单所拥有的子节点！
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
    public function replaceTpl($items,$tpl)
    {
        foreach($items as $key => $value)
        {
            if(!is_array($value))$tpl=preg_replace('/{'.$key.'}/',$value,$tpl);
        }
        return $tpl;
    }
}