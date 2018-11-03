<?php
/**
 * Created by PhpStorm.
 * User: pauldossantos
 * Date: 02/11/2018
 * Time: 14:51
 */

namespace Controller;

use App\Connection;

abstract class AbstractController
{
    protected $twig;
    protected $pdo;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(APP_VIEW_PATH);
        $this->twig = new \Twig_Environment(
            $loader,
            [
                'cache' => !APP_DEV,
                'debug' => APP_DEV,
            ]
        );
        $this->twig->addExtension(new \Twig_Extension_Debug());

        $connection = new Connection();
        $this->pdo = $connection->getPdoConnection();
    }
}
