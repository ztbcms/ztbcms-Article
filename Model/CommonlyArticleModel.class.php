<?php
/**
 * Created by PhpStorm.
 * User: cycle_3
 * Email: 953006367@qq.com
 * Date: 2019/12/23
 * Time: 10:49
 */
namespace Article\Model;

use Common\Model\RelationModel;

class CommonlyArticleModel extends RelationModel
{

    protected $tableName = 'commonly_article';

    const DEFAULT_TYPE = 'default';  //默认分类

    /**
     * 校验数据
     * @param $post
     * @return array
     */
    function checkData($post){
        if(!$post['cover_url']) return createReturn(false,'','封面图不能为空');
        if(!$post['type']) return createReturn(false,'','类型不能为空');
        if(!$post['title']) return createReturn(false,'','文章标题不能为空');
        if(!$post['about']) return createReturn(false,'','文章简介不能为空');
        if(!$post['group_id']) return createReturn(false,'','文章分类不能为空');
        if(!$post['content']) return createReturn(false,'','文章内容不能为空');
        $content['cover_url'] = $post['cover_url'];
        $content['type'] = $post['type'];
        $content['listorder'] = $post['listorder'];
        $content['is_display'] = $post['is_display'];
        $content['title'] = $post['title'];
        $content['about'] = $post['about'];
        $content['view_num'] = $post['view_num'];
        $content['group_id'] = $post['group_id'];
        $content['group_name'] = $this->getGroupName($post['group_id']);
        $content['content'] = $post['content'];
        $content['updatetime'] = time();
        $content['is_delete'] = '0';
        return createReturn(true,$content,'校验成功');
    }

    /**
     * 获取分类名称
     * @param $group_id
     * @return string
     */
    function getGroupName($group_id){
        if($group_id == '1'){
            return '抢鲜须知';
        } else if($group_id == '2'){
            return '高手进阶';
        } else if($group_id == '3'){
            return '拉新教程';
        }
    }

}