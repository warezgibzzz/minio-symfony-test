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
        $defaultStorage->write(
            'test.jpg',
            file_get_contents('https://picsum.photos/200/300.jpg')
        );


        return $this->json([
            'message' => 'Welcome to your new controller!',
            'check' => $defaultStorage->fileExists('test.jpg'),
            'path' => 'src/Controller/TestFileUploadController.php',
        ]);
    }
}
