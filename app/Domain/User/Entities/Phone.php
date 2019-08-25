<?php

namespace App\Domain\User\Entities;

use App\Domain\_core\Entity;

/**
 * @property int $id
 * @property int $number
 * @property boolean $verified
 * @property int $profile_id
 * @property int $country_code
 */
class Phone extends Entity
{
	 protected $table = 'phones';
}
