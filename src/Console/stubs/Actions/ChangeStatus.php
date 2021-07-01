<?php

namespace App\Admin\Actions;

use QuarkCMS\QuarkAdmin\Actions\Action;

class ChangeStatus extends Action
{
    /**
     * 行为名称，当行为在表格行展示时，支持js表达式
     *
     * @var string
     */
    public $name = "<% data.status==1 ? '禁用' : '启用' %>";

    /**
     * 设置按钮类型,primary | ghost | dashed | link | text | default
     *
     * @var string
     */
    public $type = 'link';

    /**
     * 设置按钮大小,large | middle | small | default
     *
     * @var string
     */
    public $size = 'small';

    /**
     * 初始化
     *
     * @param  void
     * @return void
     */
    public function __construct()
    {
        // 当行为在表格行展示时，支持js表达式
        $this->withConfirm("确定要<% data.status==1 ? '禁用' : '启用' %>数据吗？", null, 'pop');
    }

    /**
     * 接口接收的参数
     *
     * @return string
     */
    public function apiParams()
    {
        return ['id', 'status'];
    }

    /**
     * 执行行为
     *
     * @param  Fields  $fields
     * @param  Collection  $models
     * @return mixed
     */
    public function handle($fields, $models)
    {
        foreach ($models as $model) {
            $model->update([
                'status' => !$fields['status']
            ]);
        }

        return success('操作成功！');
    }
}