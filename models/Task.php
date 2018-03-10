<?php

namespace app\models;

use app\core\App;
use app\core\database\QueryBuilder;
use app\models\base\Model;

class Task extends Model
{
    public $id;
    public $name;
    public $email;
    public $text;
    public $status;
    public $file;

    const WIDTH_IMG = 320;
    const HEIGHT_IMG = 280;

    protected $tableName = 'task';
    protected $attributes = [
        'id',
        'name',
        'email',
        'text',
        'status',
    ];

    public function save()
    {
        /**
         * @var $query QueryBuilder
         */
        $query = App::get('database');

        $currentTask = self::findOne($this->id);

        if($currentTask && User::isActiveAdmin()) {
            $query->update($this->getTableName(), $this->id, $this->getAttributes());
        } else {
            $this->id = $query->insert($this->getTableName(), $this->getAttributes());
        }
    }

    public static function findOne($id)
    {
        /**
         * @var $query QueryBuilder
         */
        $query = App::get('database');
        return $query->selectOne('task', $id);
    }

    public function uploadFile()
    {
        $imageParams = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($imageParams !== false) {
//            if ($imageParams[0] <= self::WIDTH_IMG && $imageParams[1] <= self::HEIGHT_IMG && $imageParams["mime"] === 'image/jpeg'){
//                $uploadOk = true;
//                $this->file = $path;
//            }
            $uploadOk = true;
        } else {
            $uploadOk = false;
        }

        if ($uploadOk) {
            $dir = 'public/img/' . $this->id;

            $path = $dir."/" . basename($_FILES["fileToUpload"]["name"]);

            $tmpName = $_FILES["fileToUpload"]["tmp_name"];

            $this->file = $path;
            if(!is_dir($dir)) {
                if(mkdir($dir)) {
                    move_uploaded_file($tmpName, $path);
                }
            } else {
                $this->cleanDir($dir);
                move_uploaded_file($tmpName, $path);
            }

            /**
             * @var $query QueryBuilder
             */
            $query = App::get('database');
            $query->update($this->getTableName(), $this->id, ['file' => $this->file]);
        }
    }

    function cleanDir($dir)
    {
        $files = glob($dir."/*");
        if (count($files) > 0) {
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }
    }
}