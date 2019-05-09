<?php

namespace BlogBundle\Controller;

use BlogBundle\Item\ItemManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @Route("/blog")
 */
class BlogController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/articles", name="get_all_items")
     * @Rest\View()
     */
    public function getAllItems(ItemManager $itemManager): array
    {
        return ['data' => $itemManager->getAllItems()];
    }


    /**
     * @Rest\Get(path="/articles/{id}", name="get_item")
     * @Rest\View()
     */
    public function getItem(int $id, ItemManager $itemManager): array
    {
        return ['data' => $itemManager->getItemById($id)];
    }
}
