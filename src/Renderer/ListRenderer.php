<?php

/*
 * This file is part of the hogosha-monitor package
 *
 * Copyright (c) 2016 Guillaume Cavana
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Guillaume Cavana <guillaume.cavana@gmail.com>
 */

namespace Hogosha\Monitor\Renderer;

use Hogosha\Monitor\Model\ResultCollection;
use Webmozart\Console\Api\IO\IO;

/**
 * @author Guillaume Cavana <guillaume.cavana@gmail.com>
 */
class ListRenderer implements RendererInterface
{
    protected $io;

    /**
     * Constructor.
     *
     * @param IO $io
     */
    public function __construct(IO $io)
    {
        $this->io = $io;
    }

    /**
     * {@inheritdoc}
     */
    public function render(ResultCollection $resultCollection)
    {
        $format = '[%s][%s] %s - %s';

        foreach ($resultCollection as $result) {
            $this->io->write(
                sprintf(
                    $format,
                    $result->getExpectedStatus() != $result->getStatusCode() ? 'FAIL' : 'OK',
                    $result->getStatusCode(),
                    $result->getName(),
                    $result->getReponseTime()
                )."\n"
            );
        }
    }
}