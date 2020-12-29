<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

class Html2pdfController extends Controller
{
    public function index()
    {
        $annonces = new AnnoncesModel;
        $annonces = $annonces->findAll();
        ob_start();


        require_once ROOT . '/Views/html2pdf/index.php';

        $contenu =  ob_get_clean();

        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetDisplayMode('fullwidth');
        $html2pdf->pdf->SetTitle('Mon document');
        try {


            $html2pdf->writeHTML($contenu);

            $html2pdf->output();
        } catch (Html2PdfException $e) {
            die($e);
        }
    }
}
