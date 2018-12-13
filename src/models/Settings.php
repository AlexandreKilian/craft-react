<?php

namespace react\models;


use craft\base\Model;


class Settings extends Model {

    public $env = 'client_side';
    public $serverBundle = 'app/server-bundle.js';

    public function rules()
    {
        return [
            [['env', 'serverBundle'], 'required'],
        ];
    }
}