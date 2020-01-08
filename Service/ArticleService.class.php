<?php
/**
 * Created by PhpStorm.
 * User: cycle_3
 * Email: 953006367@qq.com
 * Date: 2019/12/23
 * Time: 10:52
 */
namespace Article\Service;

use System\Service\BaseService;
use Article\Model\CommonlyArticleModel;
use Article\Service\ArticleGroupService;

class ArticleService extends BaseService
{

    /**
     * 获取文章列表
     * @param $where
     * @param $order
     * @param $page
     * @param $limit
     * @return array
     */
    static function getArticleList($where = [],$order = '',$page = 1,$limit = 20){
        $res = self::select('commonly_article',$where,$order,$page,$limit);
        $items = $res['data']['items'];
        foreach ($items as $k => $v){
            $items[$k]['inputtime_name'] = date('Y-m-d H:i',$v['inputtime']);
            $items[$k]['updatetime_name'] = date('Y-m-d H:i',$v['updatetime']);
        }
        $res['data']['items'] = $items;
        return $res;
    }

    /**
     * 添加或者编辑文章
     * @param $post
     * @return array
     */
    static function addEditArticle($post){
        $CommonlyArticleModel = new CommonlyArticleModel();
        $checkRes = $CommonlyArticleModel->checkData($post);
        if(!$checkRes['status']) return $checkRes;
        $content = $checkRes['data'];
        if($post['id']){
            $CommonlyArticleModel->where(['id'=>$post['id']])->save($content);
        } else {
            $content['inputtime'] = time();
            $CommonlyArticleModel->add($content);
        }
        return self::createReturn(true,'','操作成功');
    }

    /**
     * 编辑信息
     * @param $id
     * @param $field
     * @param $value
     * @return array
     */
    static function updatinArticle($id,$field,$value){
        $CommonlyArticleModel = new CommonlyArticleModel();
        $save[$field] = $value;
        $save['updatetime'] = time();
        $res = $CommonlyArticleModel->where(['id'=>$id])->save($save);
        return createReturn(true,$res,'操作成功');
    }

    /**
     * 获取文章详情
     * @param $id
     * @return array
     */
    static function articleDetails($id){
        $CommonlyArticleModel = new CommonlyArticleModel();
        $res = $CommonlyArticleModel->where(['id'=>$id])->find();
        $res['content'] = htmlspecialchars_decode($res['content']);
        $res['inputtime_name'] = date('Y-m-d H:i',$res['inputtime']);
        $res['updatetime_name'] = date('Y-m-d H:i',$res['updatetime']);
        $res['group_id'] = ArticleGroupService::getPid($res['group_id'],true);
        return createReturn(true,$res);
    }

}