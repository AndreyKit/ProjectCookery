<?php

namespace Controller;

use Core\Config;
use Model\DishesModel;
use TexLab\MyDB\DB;

class DishesManagerController extends DishesController
{

    protected  $tableName = "dishes";
    protected  $table;

    public function __construct($view)
    {
        parent::__construct($view);

        $this->table = new DishesModel(
            "dishes",
            DB::Link([
                'host' => Config::MYSQL_HOST,
                'username' => Config::MYSQL_USER_NAME,
                'password' => Config::MYSQL_PASSWORD,
                'dbname' => Config::MYSQL_DATABASE
            ])
        );

        $this
            ->view
            ->setFolder('dishesmanager');
    }

    public function actionShow(array $data)
    {
//       print_r($this->table->setPageSize(Config::PAGE_SIZE_DISH)->getDishesStatusFilter(2));
        parent::actionShow($data); // TODO: Change the autogenerated stub
        $this
            ->view
            ->setTemplate('managerShow')
            ->setData([
                'table' => $this
                    ->table
                    ->reset()
                    ->setPageSize(Config::PAGE_SIZE_DISH)
                    ->getDishesStatusFilter($data['get']['page'] ?? 1),
                'fields' => array_diff($this->table->getColumnsNames(), ['id']),
                'comments' => $this->table->getColumnsComments(),
                'type' => $this->getClassName(),
                'pageCount' => $this->table->pageCount()
            ]);
    }

    public function actionAdd(array $data)
    {

    }

    public function actionEdit(array $data)
    {

    }

    public function actionDel(array $data)
    {

    }
}
