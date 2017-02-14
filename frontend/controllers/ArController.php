<?php

namespace frontend\controllers;
use frontend\models\Customer;
use Yii;
use frontend\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
define('EOL', '<br />');

// This is a quick intro to Yii Active Record
// Link  : http://www.yiiframework.com/doc-2.0/guide-db-active-record.html#declaring-relations

class ArController extends Controller
{

    public function actionIndex()
    {
        $this->simpleQuery();

        $this->useDbs();

        $this->queryData();

        return $this->render('index');
    }

    private function simpleQuery()
    {
        echo 'TEST 1: Saving AR' . EOL;
        $customer = new Customer();
        $customer->name = 'Qiang';
        if( $customer->save() ) {
            echo 'Saved customer successfully';
        } else {
            echo 'Error in saving customer';
        }
        // var_dump($customer);
        echo EOL;

        echo 'TEST 2: Saving data using simple sql' . EOL;
        $db = Yii::$app->db;
        $cmd = $db->createCommand('INSERT INTO customer (name) VALUES (:name)', [
           ':name' => 'Ali'
        ]);
        $rows = $cmd->execute();
        echo 'Inserted rows count : ' . $rows . EOL;

        echo 'TEST 3: Update data using simple sql' . EOL;
        $db = Yii::$app->db;
        $cmd = $db->createCommand('UPDATE customer SET name = :name WHERE id = :id', [
            ':name' => 'Ali updated again',
            ':id' => 9
        ]);
        $rows = $cmd->execute();
        echo 'Updated rows count : ' . $rows . EOL;

    }

    // Create db2 by adding the following to frontend/config/mail-local.php
    /*
    'components' => [
        'db2' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=testdb2',
            'username' => 'root',
            'password' => 'root',
            ],
        ],
    */
    // Override getDb()
    public static function getDb()
    {
        return Yii::$app->db2;
    }

    private function useDbs()
    {
        echo 'TEST 4: Saving AR' . EOL;
        $customer = new Customer();
        $customer->name = 'Qiang from new db2';
        $customer->save();
        echo EOL;
    }

    /*
     * The process usually takes the following three steps:
     *
     * 1: Create a new query object by calling the yii\db\ActiveRecord::find() method OR new Query();
     * 2: Build the query object by calling query building methods :
     *    (select, from, where, filterWhere, andWhere, orderBy, groupBy, having, limit, offset, join, union );
     * 3: Call a query method to retrieve data in terms of Active Record instances.
     *    (all, one, column, scalar, exists, count)
     */
    private function queryData()
    {
        echo 'TEST 5: Find a customer by id' . EOL;
        $customer = Customer::find()->where(['id'=>9])->one(Yii::$app->db2); // add limit(1) to improve performance
        echo $customer->name . EOL;
        $customer2 = Customer::findOne(['id'=>9]);
        echo $customer2->name . EOL;

        echo 'TEST 6: Find customers by ids' . EOL;
        $customers = Customer::find()->where(['id'=>[8,9, 10, 11]])->all();
        foreach($customers as $customer) {
            echo $customer->name . EOL;
        }

        echo 'Short method:' . EOL;
        // SELECT * FROM `customer` WHERE `id` IN (100, 101, 123, 124)
        $customers = Customer::findAll([8,9, 10, 11]);
        foreach($customers as $customer) {
            echo $customer->name . EOL;
        }

        echo 'TEST 7: Find customers by ids using findBySql, it also fills models' . EOL;
        // Do not call extra query building methods after calling findBySql() as they will be ignored.
        $sql = 'SELECT * FROM customer WHERE id=:id';
        $customers = Customer::findBySql($sql, [':id' => 9])->all();

        foreach($customers as $customer) {
            echo $customer->name . EOL;
        }


    }

    function isPrime($x)
    {
        foreach (range(2, $x - 1) as $divisor)
        {
            if ($x % $divisor == 0)
            {
                return true;
            }
        }

        return false;
    }

}
