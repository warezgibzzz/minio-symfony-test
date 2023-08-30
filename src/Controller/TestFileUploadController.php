<?php

namespace App\Controller;

use League\Flysystem\FilesystemOperator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestFileUploadController extends AbstractController
{
    #[Route('/file/upload', name: 'app_test_file_upload')]
    public function index(FilesystemOperator $defaultStorage): JsonResponse
    {
        $precheck = $defaultStorage->fileExists('test.jpg');
        $deleted = false;
        if ($precheck) {
            $deleted = true;
            $defaultStorage->delete('test.jpg');
        }
        $defaultStorage->write(
            'test.jpg',
            file_get_contents('https://picsum.photos/200/300.jpg')
        );


        return $this->json([
            'message' => 'Welcome to your new controller!',
            'preCheck' => $precheck,
            'deletedOld' => $deleted,
            'check' => $defaultStorage->fileExists('test.jpg'),
            'path' => 'src/Controller/TestFileUploadController.php',
        ]);
    }
}
