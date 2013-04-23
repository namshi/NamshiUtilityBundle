<?php

namespace Namshi\UtilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Exception;

class DefaultController extends Controller
{    
    public function serveFileAction($file)
    {
        $filePath   = $this->container->getParameter('namshi_utility.files.' . $file);
        $file       = new File($filePath);

        return new Response(file_get_contents($filePath), 200, array(
            'Content-Type' => $file->getMimeType()
        ));
    }
}
