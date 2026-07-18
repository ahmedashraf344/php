<?php

namespace App\Traits;

use PDF;

trait ExportFile
{
    private function exportAndDownloadPdf($pagePath, $pageVariables = [], $customFileName = null)
    {
        $customFileName = $customFileName ?? date('Y-m-d h:i');
        try {
            $pdf = PDF::loadView($pagePath, $pageVariables);
//            return $pdf->stream($customFileName . '.pdf');
            return $pdf->download($customFileName . '.pdf');
        } catch (\Exception $e) {
            return abort(400);
        }
    }

    private function exportAndSavePdf($pagePath, $pageVariables = [], $customFileName = null,$savePath=null)
    {
        $customFileName = $customFileName ?? date('Y-m-d h:i');
        $savePath=$savePath ?? 'export-pdf/';
        try {
            $pdf = PDF::loadView($pagePath, $pageVariables);
            $fileName = $savePath . time() . '_'.$customFileName.'.pdf';
            $pdf->save($fileName);
        } catch (\Exception $e) {
            return abort(400);
        }
    }
}
