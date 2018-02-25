<?php

//namespace app\controllers;
//
//use app\core\App;
//use app\core\Request;
//use app\models\pagination\Pagination;
//use app\models\sort\Sort;
//use app\models\Task;

class AppController
{
    public function index()
    {
        //Paginator
        $page = isset(Request::params()['page']) ? (int)Request::params()['page'] : 1;
        $count = App::get('database')->count('task');
        $itemsPerPage = 3;
        $p = new Pagination($count, $itemsPerPage, $page);

        //Sorting
        $sort = Request::params()['sort'];
        $sorting = new Sort();
        $sorting->setParams([
            'name' => ['name' => Sort::DESC, '-name' => Sort::ASC],
            'email' => ['email' => Sort::DESC, '-email' => Sort::ASC],
            'status' => ['status' => Sort::DESC, '-status' => Sort::ASC]
        ]);

        if(!empty($sort)) {
            $orderBy = $sorting->getOrderBy($sort);
        }

        $tasks = App::get('database')->selectAll('task', $orderBy);
        $tasks = $p->getModels($tasks);

        return view('index', [
            'tasks' => $tasks,
            'sortParams' => $sorting->params,
            'p' => $p,
            'activeSort' => $sort,
            'activePage' => $p->currentPage
        ]);
    }

    public function create()
    {
        $model = new Task();

        if (Request::method() == 'POST') {
            $params = $_POST;
            $model->load($params);
            $model->validate();
            $model->save();

            $model->uploadFile();

            return redirect('index');
        }

        return view('create', ['model' => $model]);
    }

    public function edit()
    {
        $params = Request::params();

        if (!empty($params['id'])) {

            $model = Task::findOne($params['id']);

            return view('create', ['model' => $model]);
        }

        return redirect('index');
    }
}