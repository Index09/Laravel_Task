<?php

namespace App\Traits;

use App\Models\device;
use App\Models\User;

trait DeviceUserTrait
{
    public function registerDevices(array $deviceIds)
    {
        $this->devices()->attach($deviceIds);
    }

    public function getDeviceUsers(device $device)
    {
        return $device->Users;
    }

    public function getUserDevices()
    {
        return $this->Devices;
    }



}