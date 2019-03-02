<?php
// +----------------------------------------------------------------------
// | Description: 个人简介
// +----------------------------------------------------------------------
// | Author: linchuangbin <linchuangbin@honraytech.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

class Personal extends ApiCommon
{
    
    public function index()
    {   
       $postModel = model('Personal');
        $param = $this->param;
        $data = $postModel->getDataById($param['id']);
        if (!$data) {
            return resultArray(['error' => $postModel->getError()]);
        } 
        return resultArray(['data' => $data]);
    }

    public function read()
    {   
        $postModel = model('Personal');
        $param = $this->param;
        $data = $postModel->getDataById($param['id']);
        if (!$data) {
            return resultArray(['error' => $postModel->getError()]);
        } 
        return resultArray(['data' => $data]);
    }

    public function save()
    {
        $postModel = model('Personal');
        $param = $this->param;
        $data = $postModel->createData($param);
        if (!$data) {
            return resultArray(['error' => $postModel->getError()]);
        } 
        return resultArray(['data' => '添加成功']);
    }

    public function update()
    {
        $postModel = model('Personal');
        $param = $this->param;
        $data = $postModel->updateDataById($param, $param['id']);
        if (!$data) {
            return resultArray(['error' => $postModel->getError()]);
        } 
        return resultArray(['data' => '编辑成功']);
    }
}
 