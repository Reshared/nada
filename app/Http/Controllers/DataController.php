<?php
/**
 * Created by PhpStorm.
 * User: reshared
 * Date: 2019-01-11
 * Time: 16:15
 */

namespace App\Http\Controllers;


use App\User;

class DataController extends Controller
{
    public function index()
    {
        $data = User::query();

        $size = request('size', 15);

        if ($only = request('only')) {
            switch ($only) {
                case 'all' :
                    $data->withTrashed();
                    break;
                case 'only-trashed' :
                    $data->onlyTrashed();
                    break;
            }
        }

        if ($where = request('where')) {
            $where = json_decode($where, true);
            foreach ($where as $key => $value) {
                $item = explode('-', $key);
                switch ($item[1]) {
                    case '=' :
                        $data->where($item[0], $value);
                        break;
                    case '!' :
                        $data->where($item[0], '!=', $value);
                        break;
                    case '>' :
                        $data->where($item[0], '>', $value);
                        break;
                    case '<' :
                        $data->where($item[0], '<', $value);
                        break;
                    case '+' :
                        $data->where($item[0], '>=', $value);
                        break;
                    case '-' :
                        $data->where($item[0], '<=', $value);
                        break;
                    case 'i' :
                        $data->whereIn($item[0], explode(',', $value));
                        break;
                    case 'l' :
                        $data->where($item[0], 'like', '%' . $value . '%');
                        break;
                    case 'b' :
                        $data->whereBetween($item[0], explode(',', $value));
                        break;
                }
            }
        }

        $sort = request('sort');


        if ($sort) {
            $data->orderBy($sort, request('sort_type', 'asc'));
        }

        return $data->paginate($size);
    }

    public function item($id)
    {
        return User::findOrFail($id);
    }

    public function destroyItem($source, $id)
    {
        $this->model($source, $id)->delete();

        return response()->json(['msg' => '删除成功']);
    }

    public function destroyItems($source)
    {
        $this->model($source)->whereIn('id', explode(',', request('ids')))->delete();

        return response()->json(['msg' => '删除成功']);
    }

    protected function model($source, $id = null)
    {
        $id = is_null($id) ? request('id') : $id;
        if ($id) {
            return eval('return App\\' . ucfirst(rtrim($source, 's')) . '::findOrFail(' . $id . ');');
        }

        return eval('return new App\\' . ucfirst(rtrim($source, 's')) . ';');
    }

    public function saveItem($source)
    {
        $model = $this->model($source);

        $model->validate();

        $model->fetchSave();

        return response()->json(['msg' => '保存成功']);
    }
}