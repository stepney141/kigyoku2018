<?php

include_once 'dbblog.php';
include_once 'utils.php';


function createResponse()
{
    $response = [];
    try {
        $blog = new BlogMapper(GyokuwebDB::Instance());
        $html = $blog->previewPost($_POST['md'], json_decode($_POST['imgmap']));
    } catch (ImagePathNotConverted $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
        return $response;
    }

    $response['status'] = 'success';
    $response['data'] = $html;
    return $response;
}

echo(json_encode(createResponse(), JSON_UNESCAPED_UNICODE));