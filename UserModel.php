<?php

namespace ryzen\ryzen;

use ryzen\ryzen\db\DbModel;

/**
 * @author razoo.choudhary@gmail.com
 * Class UserModel
 * @package ryzen\ryzen
 */

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}