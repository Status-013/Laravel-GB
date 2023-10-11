<?php

namespace App\Jobs;

use App\Models\Resource;
use App\Services\Interfaces\Parser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewsParsingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Resource $resource,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(Parser $parserService): void
    {
        $parserService->parseData($this->resource);
    }
}
