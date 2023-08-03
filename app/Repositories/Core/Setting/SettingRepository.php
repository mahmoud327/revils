<?php


namespace App\Repositories\Core\Setting;

use App\Models\Core\Setting;
use App\Repositories\Base\BaisRepository;


class   SettingRepository extends BaisRepository implements SettingRepositoryInterface
{
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }


}
