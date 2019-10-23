<?php

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Component\Enum\Bench\Compare;

interface CompareEnumBench
{
    public function benchReflectionEnum();

    public function benchReflectionEnumNoMagic();

    public function benchExplicitEnum();

    public function benchMyCLabsEnum();

    public function benchMabeEnum();

    public function benchMabeNoMagicEnum();

    public function benchHappyTypesEnum();
}
