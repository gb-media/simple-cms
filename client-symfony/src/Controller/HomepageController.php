<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\SimpleCms\Content;
use App\Resource\SimpleCms\ContentResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @throws
     */
    public function index(ContentResource $contentResource)
    {
        $content = new Content();
        $content->title = 'Test One';
        $content->text = 'Blabla...';
        dump('New object => ', $content);
        $content = $contentResource->post($content);
        dump('Response Post => ', $content);
        $content->title = 'Test One update';
        $content = $contentResource->put($content->id, $content);
        dump('Response Put => ', $content);
        $content = $contentResource->getItem($content->id);
        dump('Response Get Item => ', $content);

        $contents = $contentResource->getCollection();
        /** @var Content $content */
        foreach ($contents as $content) {
            dump($content);
            dump($contentResource->delete($content->id));
        }
        die;

        return $this->render('homepage.html.twig', [
            'contentNew' => $contentNew,
            'contentUpdate' => $contentUpdate,
            'contentshow' => $contentshow,
            'contents' => $contents,
        ]);
    }
}
