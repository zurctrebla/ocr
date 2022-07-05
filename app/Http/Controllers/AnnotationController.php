<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GoogleCloudVision\GoogleCloudVision;
use GoogleCloudVision\Request\AnnotateImageRequest;

class AnnotationController extends Controller
{
    //show the upload form
    public function displayForm()
    {
        return view('annotate');
    }

    public function annotateImage(Request $request)
    {
        if($request->file('image')){

            //convert image to base64
            $image = base64_encode(file_get_contents($request->file('image')));

            //prepare request
            $request = new AnnotateImageRequest();
            $request->setImage($image);
            $request->setFeature("TEXT_DETECTION");
            $gcvRequest = new GoogleCloudVision([$request],  env('GOOGLE_CLOUD_KEY'));

            //send annotation request
            $response = $gcvRequest->annotate();

            // return json_encode(["description" => $response->responses[0]->textAnnotations[0]->description]);

            $array = (array) $response->responses[0]->textAnnotations[0]->description;

            foreach ($array as $key => $value) {

                $words = explode("\n", $value);

                // dd($words); //  array

                $jogo = $words[0];
                $entrada = (integer) $words[17];
                $saida = (integer) $words[20];

                echo "Jogo: " . $jogo . "<br>";
                echo "Entrada: " . $entrada . "<br>";
                echo "Saida: " . $saida . "<br>";
                
            }

        }
    }
}
