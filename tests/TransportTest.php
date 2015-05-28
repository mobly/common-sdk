<?php

/*
 * This file is part of gpupo/common-sdk
 *
 * (c) Gilmar Pupo <g@g1mr.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gpupo\Tests\CommonSdk;

use Gpupo\Common\Entity\Collection;
use Gpupo\CommonSdk\Transport;

class TransportTest extends TestCaseAbstract
{
    public function testÉUmDriver()
    {
        $transport = new Transport(new Collection([]));
        $this->assertInstanceof("\Gpupo\CommonSdk\Transport\Driver\DriverInterface", $transport);

        return $transport;
    }

    /**
     * @depends testÉUmDriver
     */
    public function testExecutaRequisiçãoAUmaUrlInformada(Transport $transport)
    {
        $transport->setUrl('https://github.com/');
        $data = $transport->exec();
        $this->assertEquals(200, $data['httpStatusCode']);

        return $transport;
    }

    /**
     * @depends testExecutaRequisiçãoAUmaUrlInformada
     */
    public function testPossuiInformaçõesSobreAÚltimaRequisição($transport)
    {
        $lastTransfer = $transport->getLastTransfer();
        $this->assertInstanceof("\Gpupo\Common\Entity\Collection", $lastTransfer);
        $this->assertEquals('https://github.com/', $lastTransfer->get('url'));
    }
}
