<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Bench\Segregate;

interface SegregateEnumBench
{
    public function benchInit();

    public function benchCompareSelf();

    public function benchInitTwice();

    public function benchInitTwiceDifferentValue();

    public function benchCompareDifferent();

    public function benchToString();

    public function benchBuildChoices();

    public function benchBuildValues();
}
