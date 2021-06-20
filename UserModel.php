<?php

namespace app\core;

use app\core\db\DbModel;

/**
 * @author razoo.choudhary@gmail.com
 * Class UserModel
 * @package app\core
 */

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}