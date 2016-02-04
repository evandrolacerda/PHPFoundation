<?php
namespace App\Model;

use App\Model\BasicModel;

/**
 * Description of Produto
 *
 * @author Evandro Lacerda <evandroplacerda@@gmail.com>
 */
class Produto extends BasicModel
{
    protected $table = 'produtos';
    protected $primaryKey = 'id';
    
}
