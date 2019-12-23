<?php
/**
 * Created by PhpStorm.
 * User: cycle_3
 * Email: 953006367@qq.com
 * Date: 2019/12/23
 * Time: 10:32
 */
namespace Article\Controller;

use Common\Controller\AdminBase;
use Article\Service\ArticleService;

/**
 * 文章管理
 * Class ArticleController
 * @package Banner\Controller
 */
class ArticleController extends AdminBase
{

    /**
     * 获取文章列表
     */
    public function articleList(){
        if(IS_AJAX){
            $where = [];
            $page = I('page','1','trim');
            $limit = I('limit','20','trim');
            $where['is_delete'] = '0';
            $type = I('type','','trim');
            if($type) $where['type'] = $type;
            $title = I('title','','trim');
            if($title) $where['title'] = ['like',['%'.$title.'%']];
            $group_name = I('group_name','','trim');
            if($group_name) $where['group_name'] = ['like',['%'.$group_name.'%']];
            $about = I('about','','trim');
            if($about) $where['about'] = ['like',['%'.$about.'%']];
            $res = ArticleService::getArticleList($where,'listorder desc,id desc',$page,$limit);
            $this->ajaxReturn($res);
        } else {
            $this->display();
        }
    }

    /**
     * 获取文章详情
     */
    public function articleDetails(){
        if(IS_AJAX){
            $id = I('id','','trim');
            $res = ArticleService::articleDetails($id);
            $this->ajaxReturn($res);
        } else {
            $this->display();
        }
    }

    /**
     * 添加或者编辑新闻内容
     */
    public function addEditArticle(){
        $post = I('post.');
        $res = ArticleService::addEditArticle($post);
        $this->ajaxReturn($res);
    }

    /**
     * 编辑分类资料
     */
    public function updatinArticle(){
        $id = I('id','','trim'); //id
        $field = I('field','','trim'); //字段
        $value = I('value','','trim'); //值
        $res = ArticleService::updatinArticle($id,$field,$value);
        $this->ajaxReturn($res);
    }

}

