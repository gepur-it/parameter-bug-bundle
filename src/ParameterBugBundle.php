<?php
/**
 * Created by PhpStorm.
 * User: zogxray
 * Date: 22.08.18
 * Time: 14:15
 */

namespace GepurIt\ParameterBugBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class ParameterBugBundle
 * @package GepurIt\ParameterBugBundle
 */
class ParameterBugBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }
}
