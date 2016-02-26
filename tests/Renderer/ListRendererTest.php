<?php

namespace Hogosha\Monitor\Renderer;

use Hogosha\Monitor\Model\Result;
use Hogosha\Monitor\Model\ResultCollection;
use Webmozart\Console\Api\IO\IO;
use Webmozart\Console\IO\BufferedIO;

/**
 * @author Guillaume Cavana <guillaume.cavana@gmail.com>
 */
class ListRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BufferedIO
     */
    private $io;

    protected function setUp()
    {
        $this->io = new BufferedIO();
    }

    /**
     * testTableRenderer.
     */
    public function testListRenderer()
    {
        $renderer = RendererFactory::create('list', $this->io);
        $renderer->render($this->createResultCollection());

        $output = <<<TABLE
[FAIL][200] Example - 0.42

TABLE;

        $this->assertInstanceOf(RendererInterface::class, $renderer);
        $this->assertSame($output, $this->io->fetchOutput());
    }

    /**
     * createResultCollection.
     */
    public function createResultCollection()
    {
        $result = new Result('Example', 200, 0.42, 404);

        $resultCollection = new ResultCollection();
        $resultCollection->append($result);

        return $resultCollection;
    }
}