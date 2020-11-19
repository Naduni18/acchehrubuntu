<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
   /**
     * Show the application help page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        
       return view('help.index');
      
       
    }

    
      /**
     * download user manual.
     *
     * @return \Illuminate\View\View
     * 
     */
    public function download_file_pdf()
    {
       
        return response()->download(storage_path("app/public/uploads/user manual/usermanual.pdf"));
        
    }
    public function download_file_docx()
    {
       
            return response()->download(storage_path("app/public/uploads/user manual/usermanual.docx"));    
        
    }
}
