<?php
// +----------------------------------------------------------------------
// | Description: 用户组
// +----------------------------------------------------------------------
// | Author: linchuangbin <linchuangbin@honraytech.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

class Percenter extends ApiCommon
{
    
    public function index()
    { 
        $percenterModel = model('Percenter');
        $param = $this->param;
		 
        $data = $percenterModel->getDataList();
        if (!$data) {
            return resultArray(['error' => $percenterModel->getError()]);
        }
		return resultArray(['data' => $data]);
    }

    public function read()
    {   
        $percenterModel = model('Percenter');
        $param = $this->param;
        $data = $percenterModel->getDataById($param['id']);
        if (!$data) {
            return resultArray(['error' => $percenterModel->getError()]);
        } 
        return resultArray(['data' => $data]);
    }

    public function save()
    {
        $percenterModel = model('Percenter');
        $param = $this->param;
        $data = $percenterModel->createData($param);
        if (!$data) {
            return resultArray(['error' => $percenterModel->getError()]);
        } 
        return resultArray(['data' => '添加成功']);
    }

    public function update()
    {
        $percenterModel = model('Percenter');
        $param = $this->param;
        $data = $percenterModel->updateDataById($param, $param['id']);
        if (!$data) {
            return resultArray(['error' => $percenterModel->getError()]);
        } 
        return resultArray(['data' => '编辑成功']);
    }

    public function delete()
    {
        $percenterModel = model('Percenter');
        $param = $this->param;
        $data = $percenterModel->delDataById($param['id'], true);       
        if (!$data) {
            return resultArray(['error' => $percenterModel->getError()]);
        } 
        return resultArray(['data' => '删除成功']);    
    }

    public function deletes()
    {
        $percenterModel = model('Percenter');
        $param = $this->param;
        $data = $percenterModel->delDatas($param['ids'], true);  
        if (!$data) {
            return resultArray(['error' => $percenterModel->getError()]);
        } 
        return resultArray(['data' => '删除成功']); 
    }

    public function enables()
    {
        $percenterModel = model('Percenter');
        $param = $this->param;
        $data = $percenterModel->enableDatas($param['ids'], $param['status'], true);  
        if (!$data) {
            return resultArray(['error' => $percenterModel->getError()]);
        } 
        return resultArray(['data' => '操作成功']);         
    }
}
 