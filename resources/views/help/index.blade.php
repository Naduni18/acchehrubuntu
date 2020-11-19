@extends('layouts.app')

@section('content')
    @include('users.partials.header', ['title' => __('Help')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
            
                <div class="card bg-white shadow">
                    <div class="card-body">
                    <h1>Download user manual</h1>
                    </br></br>
                    <?php $filetype='pdf'?>
                    <a href="{{ route('help.download_file_pdf') }}">
<span class="btn-inner--icon" style="padding:100px;">
<img  width="40" height="40" src="{{ asset('argon') }}/img/icons/common/download-solid.svg"/>
</span></a><label style="text-align: center;">{{ __('    User manual(pdf)') }}</label>
</br></br>
    <?php $filetype='docx'?>
<a href="{{ route('help.download_file_docx') }}">
<span class="btn-inner--icon" style="padding:100px;">
<img  width="40" height="40" src="{{ asset('argon') }}/img/icons/common/download-solid.svg"/>
</span></a><label style="text-align: center;">{{ __('    User manual(docx)') }}</label>
 
   
                    
                </div>
            </div>
        </div>
    </div>

        @include('layouts.footers.auth')
    </div>
@endsection

