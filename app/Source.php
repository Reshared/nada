<?php
/**
 * Created by PhpStorm.
 * User: reshared
 * Date: 2019-01-18
 * Time: 16:19
 */

namespace App;


interface Source
{
    public function validate();

    public function fetchSave();
}