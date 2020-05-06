<?php

namespace App\Http;

use Illuminate\Routing\UrlGenerator;

class AppUrlGenerator extends UrlGenerator
{
    /**
     * AppUrlGenerator constructor.
     * @param UrlGenerator $url
     */
    public function __construct(UrlGenerator $url)
    {
        parent::__construct($url->routes, $url->request);
    }

    /**
     * Generate a URL to an application asset.
     *
     * @param string    $path
     * @param bool|null $secure
     *
     * @return string
     */
    public function asset($path, $secure = null)
    {
        $path_parts = pathinfo($path);
        if (!in_array($path_parts['extension'], ['js', 'css'])) {
            return parent::asset($path);
        }
        $v = config('app.version', 0);
        if (config('app.env') != 'production') {
            // ランダム
            //$v = md5(microtime(uniqid()));
            $v = config('const.CACHE_ID');
        }
        $path .= '?v=' . $v;
        return parent::asset($path, $secure);
    }
}
