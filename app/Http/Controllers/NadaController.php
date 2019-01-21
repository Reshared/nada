<?php
/**
 * Created by PhpStorm.
 * User: reshared
 * Date: 2019-01-11
 * Time: 11:40
 */

namespace App\Http\Controllers;


class NadaController extends Controller
{
    public function index()
    {
        return response()->json([
            'header' => '用户列表',
            'description' => '用户列表描述',
            'edit' => true,
            'view' => true,
            'create' => true,
            'delete' => true,
            'mult_select' => true,
            'export_able' => true,
            'paginate' => true,
            'soft_delete' => false,
            'default_sort' => 'id',
            'default_sort_type' => 'asc',
            'fields' => [
                 [
                    'key' => 'id',
                    'title' => 'ID',
                    'filter' => '',
                    'search' => '=',
                    'sort' => true,
                    'editable' => false,
                ],
                [
                    'key' => 'avatar',
                    'title' => '头像',
                    'filter' => '<a href="{?}">点击查看</a>',
                    'search' => false,
                    'sort' => false,
                    'editable' => false,
                ],
                [
                    'key' => 'name',
                    'title' => '用户名',
                    'filter' => '<b>{?}</b>',
                    'search' => 'l',
                    'sort' => true,
                    'editable' => true,
                ],
                [
                    'key' => 'email',
                    'title' => '邮箱',
                    'filter' => '<b>{?}</b>',
                    'search' => 'l',
                    'sort' => true,
                    'editable' => true,
                ],
                [
                    'key' => 'created_at',
                    'title' => '创建时间',
                    'filter' => '<b>{?}</b>',
                    'search' => '>',
                    'sort' => true,
                    'editable' => false,
                ],
                [
                    'key' => 'updated_at',
                    'title' => '更新时间',
                    'filter' => '<b>{?}</b>',
                    'search' => '<',
                    'sort' => true,
                    'editable' => false,
                ],
                [
                    'key' => 'email_verified_at',
                    'title' => '邮箱验证时间',
                    'filter' => '<b>{?}</b>',
                    'search' => 'b',
                    'sort' => true,
                    'editable' => false,
                ],
            ]
        ]);
    }

    public function create()
    {

    }


    public function store()
    {

    }

    public function show()
    {
        return $this->detail(1);
    }

    public function edit()
    {
        return $this->form();
    }

    public function update()
    {

    }

    public function destroy()
    {

    }

    protected function detail($id)
    {
        return response()->json([
            'header' => '用户详情',
            'description' => '我是用户详情内容',
            'fields' => [
                [
                    'key' => 'id',
                    'title' => 'ID',
                    'type' => 'text',
                ],
                [
                    'key' => 'avatar',
                    'title' => '头像',
                    'type' => 'img',
                ],
                [
                    'key' => 'name',
                    'title' => '用户名',
                    'type' => 'text',
                ],
                [
                    'key' => 'email',
                    'title' => '邮箱',
                    'type' => 'text',
                ],
                [
                    'key' => 'created_at',
                    'title' => '创建时间',
                    'type' => 'datetime',
                ],
                [
                    'key' => 'updated_at',
                    'title' => '更新时间',
                    'type' => 'datetime',
                ],
                [
                    'key' => 'email_verified_at',
                    'title' => '邮箱验证时间',
                    'type' => 'datetime',
                ]
            ]
        ]);
    }

    protected function form()
    {
        return response()->json([
            'header' => '编辑用户',
            'description' => '编辑编辑用户信息',
            'back' => true,
            'sab' => true,
            'sae' => true,
            'saa' => true,
            'sav' => true,
            'fields' => [
                [
                    'key' => 'id',
                    'title' => 'ID',
                    'rule' => '',
                    'help' => '这个是ID',
                    'readOnly' => true,
                    'type' => 'text',
                ],
                [
                    'key' => 'avatar',
                    'title' => '头像',
                    'rule' => 'required',
                    'help' => '',
                    'readOnly' => false,
                    'type' => 'image',
                ],
                [
                    'key' => 'name',
                    'title' => '用户名',
                    'rule' => 'required|string',
                    'help' => '请填写用户名',
                    'readOnly' => false,
                    'type' => 'text',
                ],
                [
                    'key' => 'email',
                    'title' => '邮箱',
                    'rule' => 'required|email',
                    'help' => '这个是邮箱',
                    'readOnly' => false,
                    'type' => 'text',
                ],
                [
                    'key' => 'password',
                    'title' => '密码',
                    'rule' => 'required',
                    'help' => '这个是密码',
                    'readOnly' => false,
                    'type' => 'text',
                ],
                [
                    'key' => 'created_at',
                    'title' => '创建时间',
                    'rule' => '',
                    'help' => '',
                    'readOnly' => true,
                    'type' => 'datetime',
                ],
                [
                    'key' => 'updated_at',
                    'title' => '更新时间',
                    'rule' => '',
                    'help' => '',
                    'readOnly' => true,
                    'type' => 'datetime',
                ],
                [
                    'key' => 'email_verified_at',
                    'title' => '邮箱验证时间',
                    'rule' => '',
                    'help' => '',
                    'readOnly' => true,
                    'type' => 'datetime',
                ],
            ]
        ]);
    }
}
