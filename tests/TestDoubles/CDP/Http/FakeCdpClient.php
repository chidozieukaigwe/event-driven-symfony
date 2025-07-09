<?php

declare(strict_types=1);

namespace App\Tests\TestDoubles\CDP\Http;

use App\CDP\Analytics\Model\ModelInterface;
use App\CDP\Http\CdpClientInterface;

class FakeCdpClient implements CdpClientInterface
{
    private int $identifyCallCount = 0;

    private ModelInterface $identifyModel;

    private int $trackCallCount = 0;

    private ModelInterface $trackModel;

    public function track(ModelInterface $model): void
    {
        //  Increment identify call count
        $this->trackCallCount++;

        // Store the model so that the forwarded data can be checked
        $this->trackModel = $model;
    }

    public function identify(ModelInterface $model): void
    {
        //  Increment identify call count
        $this->identifyCallCount++;

        // Store the model so that the forwarded data can be checked
        $this->identifyModel = $model;
    }

    public function getIdentifyModel(): ModelInterface
    {
        return $this->identifyModel;
    }

    public function getTrackModel(): ModelInterface
    {
        return $this->trackModel;
    }

    public function getIdentifyCallCount(): int
    {
        return $this->identifyCallCount;
    }

    public function getTrackCallCount(): int
    {
        return $this->trackCallCount;
    }
}
