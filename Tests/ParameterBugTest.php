<?php
/**
 * Created by PhpStorm.
 * User: pavlov
 * Date: 22.12.17
 * Time: 3:30
 */
namespace GepurIt\ParameterBugBundle\Tests;

use GepurIt\ParameterBugBundle\Entity\Parameter;
use Doctrine\ORM\EntityManager;
use GepurIt\ParameterBugBundle\ParameterBug\ParameterBug;
use PHPUnit\Framework\TestCase;

/**
 * Class ParameterBugTest
 * @package GepurIt\ParameterBugBundle\Tests
 */
class ParameterBugTest extends TestCase
{
    public function testGet()
    {
        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManager */
        $entityManager = $this->createMock(EntityManager::class);
        /** @var Parameter|\PHPUnit_Framework_MockObject_MockObject $clientEmailParameter */
        $clientEmailParameter = $this->createMock(Parameter::class);

        $parameterBug = new ParameterBug($entityManager);

        $entityManager->expects($this->once())->method('find')->willReturn($clientEmailParameter);
        $clientEmailParameter->expects($this->once())->method('getValue')->willReturn('value');

        $parameter = $parameterBug->get('name', null);

        $this->assertEquals('value', $parameter);
    }

    public function testDefault()
    {
        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManager */
        $entityManager = $this->createMock(EntityManager::class);
        $parameterBug = new ParameterBug($entityManager);
        $default = $parameterBug->get('name', 'default');
        $this->assertEquals('default', $default);
    }

    public function testSaveExists()
    {
        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManager */
        $entityManager = $this->createMock(EntityManager::class);
        /** @var Parameter|\PHPUnit_Framework_MockObject_MockObject $clientEmailParameter */
        $clientEmailParameter = $this->createMock(Parameter::class);

        $entityManager->expects($this->once())->method('find')->willReturn($clientEmailParameter);
        $clientEmailParameter->expects($this->once())->method('setValue');
        $entityManager->expects($this->once())->method('persist');
        $entityManager->expects($this->once())->method('flush');

        $parameterBug = new ParameterBug($entityManager);

        $parameterBug->set('name', 'value');
    }

    public function testSaveExistsNew()
    {
        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManager */
        $entityManager = $this->createMock(EntityManager::class);
        /** @var Parameter|\PHPUnit_Framework_MockObject_MockObject $clientEmailParameter */

        $entityManager->expects($this->once())->method('find')->willReturn(null);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManager */

        $entityManager->expects($this->once())->method('persist');
        $entityManager->expects($this->once())->method('flush');

        $parameterBug = new ParameterBug($entityManager);

        $parameterBug->set('name', 'value');
    }

    public function testSet()
    {
        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManager */
        $parameterBug = $this->createMock(ParameterBug::class);

        $parameterBug->expects($this->once())->method('save');

        $parameterBug->save('name', 'value');
    }
}
