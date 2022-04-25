<?php

namespace SamTech\Controller;

class ProductController
{

    function Category(string $productID, string $category)
    {
        echo "Product $productID, Category $category";
    }
}
