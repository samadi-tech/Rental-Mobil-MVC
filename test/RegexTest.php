<?php

namespace SamTech;

use PHPUnit\Framework\TestCase as FrameworkTestCase;

class RegexTest extends FrameworkTestCase
{
    public function testRegex()
    {
        $path = "/products/12345/category/abcde";

        $pattern = "#^/products/([)-9a-zA-Z]*)/category/([0-9a-zA-Z]*)$#";

        $result = preg_match($pattern, $path, $variables);

        self::assertEquals(1, $result);

        var_dump($variables);

        array_shift($variables);
        var_dump($variables);
    }
}
