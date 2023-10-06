<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\DocumentSignedMail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Validation\Rule;

class DocumentSignController extends Controller
{
    public function index(){
        return view('index');
    }

    public function congratulation(){
        return view('congratulation');
    }

    public function uploadFiles($images)
    {
        $path = 'uploads/';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
            $indexFile = fopen($path . "/index.html", "w");
            fclose($indexFile);
        }

        $filePaths = [];

        foreach ($images as $file) {
            $fileName = uniqid(null, true) . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $filePaths[] = url($path . '/' . $fileName);
        }

        return $filePaths;
    }

    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'signature_status'  => ['required', Rule::in(['Digital Signature', 'Image Signature'])],
            'signatureImage'    => ['required_if:signature_status,Digital Signature'],
            'signature_photo'   => ['required_if:signature_status,Image Signature'],
            'imageFile'         => 'image|mimes:jpg,jpeg,png',
            'images'            => 'required|array|min:5|max:20',
            'images.*'          => 'image|mimes:jpg,jpeg,png'
        ]);


        $signatureStatus = $request->input('signature_status');

        if ($signatureStatus == 'Digital Signature') {
            $signatureImage = $request->input('signatureImage');
            $signatureImageFile = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureImage));
            $signatureImagePath = storage_path('app/public/signature.png');
            file_put_contents($signatureImagePath, $signatureImageFile);
        } 

        if ($signatureStatus == 'Image Signature') {
            $signatureImage = $request->file('signature_photo');
            $signatureImageFile = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureImage));
            $signatureImagePath = storage_path('app/public/signature.png');
            file_put_contents($signatureImagePath, $signatureImageFile);
        }

        if ($request->hasFile('imageFileOfId')) {
            $imageFile = $request->file('imageFileOfId');
            $imagePath = storage_path('app/public/temp_image.png'); // Adjust the file extension as needed
            $imageFile->move(storage_path('app/public'), 'temp_image.png'); // Move the uploaded file to storage
        }

        if ($request->hasFile('imageBackOfId')) {
            $backImageFile = $request->file('imageBackOfId');
            $backImagePath = storage_path('app/public/temp_image2.png'); // Adjust the file extension as needed
            $backImageFile->move(storage_path('app/public'), 'temp_image2.png'); // Move the uploaded file to storage
        }

        if($request->file('images')){
            $imageFiles = $this->uploadFiles($request->file('images'));
        }

        $pdf = new \Mpdf\Mpdf();
        $pdf->AddPage();
        $pdf->SetHTMLFooter('<div style="position: absolute; bottom: 0; right: 1%; width: 80px; text-align: right;"><img src="' . $signatureImage . '" style="width: 100%;" />Model Initial</div>');
        $html = view('pdf_with_signature', ['data' => $request->all(), 'signatureImage' => $signatureImage])->render();
        $pdf->WriteHTML($html);
        $filename = 'generated_pdf_' . time() . '.pdf';
        $pdf->Output(storage_path('app/public/') . $filename, 'F');

        $pdfFileDestination = storage_path('app/public/' . $filename);
        $tagetMails = ['talent@alluringintros.eu', 'model@kdsystemsbd.com'];
        foreach ($tagetMails as $mail) {
            \Mail::to($mail)->send(new DocumentSignedMail($pdfFileDestination, $imagePath, $backImagePath, $request->all(), $imageFiles));
        }

        Toastr::success('Information mailed successfully.');
        return redirect('congratulations');
    }
}
