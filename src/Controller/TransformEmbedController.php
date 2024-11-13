<?php

namespace DEON\Mvc\Controller;

class TransformEmbedController
{

    public static function embedYouTubeVideo($url) {
        if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {

            $video_id = '';
            if (strpos($url, 'youtube.com') !== false) {
                parse_str(parse_url($url, PHP_URL_QUERY), $query_params);
                if (isset($query_params['v'])) {
                    $video_id = $query_params['v'];
                }
            } elseif (strpos($url, 'youtu.be') !== false) {
                $url_parts = explode('/', $url);
                $video_id = end($url_parts);
            }

            if (!empty($video_id)) {
                $embed_url = "https://www.youtube.com/embed/$video_id";
                return $embed_url;
            }
            return $url;
        }
        header('Location: /erro-envio?erro=url');
        return null;
    }
    
}