<?php

namespace App\Services\Interfaces;

use App\Models\Resource;

interface Parser
{
    public function parseData(Resource $resource): void;
}
