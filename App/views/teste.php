<?php

// clear the old headers
header_remove();
// set the header to make sure cache is forced
header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
// treat this as json
header('Content-Type: application/json');

http_response_code(200);
echo json_encode(
    [
        "status" => "success",
        "message" => "Arquivos salvos",
    ]
);