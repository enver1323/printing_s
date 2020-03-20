<?php


namespace App\Domain\Comment\Entities;


use App\Domain\_core\Entity;

/**
 * Class Comment
 * @package App\Domain\Comment
 *
 * @author Enver Menadjiev <enver1323@gmail.com>
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $message
 */
class Comment extends Entity
{
    protected $table = 'comments';
    public $timestamps = true;
}
