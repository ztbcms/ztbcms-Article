<extend name="../../Admin/View/Common/element_layout"/>

<block name="content">
    <style>
        .imgListItem {
            height: 120px;
            border: 1px dashed #d9d9d9;
            border-radius: 6px;
            display: inline-flex;
            margin-right: 10px;
            margin-bottom: 10px;
            position: relative;
            cursor: pointer;
            vertical-align: top;
        }
        .deleteMask {
            position: absolute;
            top: 0;
            left: 0;
            width: 120px;
            height: 120px;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.6);
            color: #fff;
            font-size: 40px;
            opacity: 0;
        }
        .deleteMask:hover {
            opacity: 1;
        }
    </style>
    <div id="app" style="padding: 8px;" v-cloak>
        <el-card>
            <el-row>
                <el-col :span="24">
                    <div class="grid-content">
                        <el-form ref="form" :model="form" label-width="120px">

                            <el-form-item label="文章标题" required>
                                <el-input v-model="form.title" size="small" style="width: 200px;" placeholder="文章标题"></el-input>
                            </el-form-item>

                            <el-form-item label="文章分类" label-width="120px" required>
                                <el-select v-model="form.group_id">
                                    <el-option label="请选择分类" value=""></el-option>
                                    <el-option label="抢鲜须知" value="1"></el-option>
                                    <el-option label="高手进阶" value="2"></el-option>
                                    <el-option label="拉新教程" value="3"></el-option>
                                </el-select>
                            </el-form-item>

                            <el-form-item label="封面图" required>
                                <template v-if="form.cover_url != ''">
                                    <div class="imgListItem">
                                        <img :src="form.cover_url" style="width: 120px;height: 120px;">
                                        <div class="deleteMask" @click="uploadImg">
                                            <span style="line-height: 120px;font-size: 22px" class="el-icon-upload"></span>
                                        </div>
                                    </div>
                                </template>
                                <template v-else>
                                    <div class="imgListItem">
                                        <div @click="uploadImg" style="width: 120px;height: 120px;text-align: center;">
                                            <span style="line-height: 120px;font-size: 22px" class="el-icon-plus"></span>
                                        </div>
                                    </div>
                                </template>
                            </el-form-item>

                            <el-form-item label="文章简介" required>
                                <el-input style="width: 750px;" type="textarea" v-model="form.about"
                                          rows="7"></el-input>
                            </el-form-item>

                            <el-form-item label="浏览量">
                                <el-input v-model="form.view_num" size="small" type="number" style="width: 200px;"></el-input>
                            </el-form-item>

                            <el-form-item label="排序" required>
                                <el-input v-model="form.listorder" size="small" type="number" style="width: 200px;"></el-input>
                            </el-form-item>

                            <el-form-item label="是否显示" required>
                                <el-switch v-model="form.is_display" size="small" active-value="1" inactive-value="0"></el-switch>
                            </el-form-item>

                            <el-form-item label="内容" label-width="120px" required>
                                <div style="line-height: 0;">
                                    <textarea id="editor_content" style="height: 600px;width: 700px"></textarea>
                                </div>
                            </el-form-item>

                            <el-form-item>
                                <el-button size="small" type="primary" @click="onSubmit">提交</el-button>
                                <el-button size="small" type="danger" @click="onCancel">关闭</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </el-col>
                <el-col :span="16"><div class="grid-content"></div></el-col>
            </el-row>
        </el-card>
    </div>

    <include file="../../Admin/View/Common/ueditor"/>
    <script>
        $(document).ready(function () {
            var ueditorInstance = UE.getEditor('editor_content');
            window.__app = new Vue({
                el: '#app',
                data: {
                    id: '{:I("get.id")}',
                    form: {
                        cover_url : '',
                        type : "{$_GET['type']}",
                        listorder : '',
                        is_display : '1',
                        title : '',
                        id:"{$_GET['id']}",
                        about: '',
                        view_num : '0',
                        group_id : ''
                    },
                    upload_flag: ''
                },
                watch: {},
                filters: {

                },
                methods: {
                    ZTBCMS_UPLOAD_FILE: function(event){
                        var that = this;
                        this._uploadImage(event);
                    },
                    uploadLogo: function(){
                        this.upload_flag = 'logo';
                        layer.open({
                            type: 2,
                            title: '',
                            closeBtn: false,
                            content: '{:U("Upload/UploadCenter/imageUploadPanel")}&max_upload=1',
                            area: ['80%', '70%']
                        })
                    },
                    uploadImg: function(){
                        this.upload_flag = 'img';
                        layer.open({
                            type: 2,
                            title: '',
                            closeBtn: false,
                            content: '{:U("Upload/UploadCenter/imageUploadPanel")}&max_upload=1',
                            area: ['70%', '80%']
                        })
                    },
                    _uploadImage: function(){
                        var that = this;
                        var files = event.detail.files;
                        that.form.cover_url = files[0].url;
                    },
                    getDetails: function(){
                        var that = this;
                        var url = '{:U("articleDetails")}';
                        that.httpGet(url, {id: that.id}, function(res){
                            if(res.status){
                                that.form = res.data;
                            }
                        });
                    },
                    onSubmit: function(){
                        var that = this;
                        var url = '{:U("Article/addEditArticle")}';
                        that.form.content = ueditorInstance.getContent();
                        var data = that.form;
                        that.httpPost(url, data, function(res){
                            if(res.status){
                                layer.msg('提交成功', {time: 1000}, function(){
                                    parent.layer.closeAll();
                                });
                            }else{
                                layer.msg(res.msg, {time: 1000});
                            }
                        });
                    },
                    onCancel: function(){
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                    }
                },
                mounted: function () {
                    var that = this;
                    window.addEventListener('ZTBCMS_UPLOAD_FILE', this.ZTBCMS_UPLOAD_FILE.bind(this));
                    if(that.id){
                        that.getDetails();
                    }
                    //富文本
                    ueditorInstance.ready(function (editor) {
                        //ueditor 初始化
                        editor.setContent(that.form.content);
                    }.bind(this, ueditorInstance));
                }
            })
        })
    </script>
</block>
