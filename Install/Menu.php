<?php
/**
 * Created by PhpStorm.
 * User: cycle_3
 * Email: 953006367@qq.com
 * Date: 2019/9/6
 * Time: 11:01
 */
return array(
    array(
        //父菜单ID，NULL或者不写系统默认，0为顶级菜单
        "parentid" => 0,
        //地址，[模块/]控制器/方法
        "route" => "Article/Article/articleList",
        //类型，1：权限认证+菜单，0：只作为菜单
        "type" => 1,
        //状态，1是显示，0不显示（需要参数的，建议不显示，例如编辑,删除等操作）
        "status" => 1,
        //名称
        "name" => "文章管理",
        //备注
        "remark" => "",
        //默认参数
        "parameter" => "type=default",
        //子菜单列表
        "child" => array(
            array(
                "route" => "Article/ArticleGroup/groupList",
                "type" => 1,
                "status" => 1,
                "name" => "文章一级分类",
                "parameter" => "type=default&is_cover=1",
            ),
            array(
                "route" => "Article/ArticleGroup/groupList3",
                "type" => 1,
                "status" => 1,
                "name" => "文章三级分类",
                "parameter" => "type=default&is_cover=1",
            ),
            array(
                "route" => "Article/Article/articleList",
                "type" => 1,
                "status" => 1,
                "name" => "文章管理",
                "parameter" => "type=default",
            )
        ),
    ),
    array(
        //父菜单ID，NULL或者不写系统默认，0为顶级菜单
        "parentid" => 0,
        //地址，[模块/]控制器/方法
        "route" => "Article/%/%",
        //类型，1：权限认证+菜单，0：只作为菜单
        "type" => 1,
        //状态，1是显示，0不显示（需要参数的，建议不显示，例如编辑,删除等操作）
        "status" => 0,
        //名称
        "name" => "文章管理（必选）",
        //备注
        "remark" => "",
        //子菜单列表
        "child" => array(

        ),
    ),
);
