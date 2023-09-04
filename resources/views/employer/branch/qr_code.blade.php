@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $branches->name }}</h4>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
    <div class="col-md-12 stretch-card">
    <div class="card p-4 text-center">
                    <h6 class="card-title font-weight-bolder">QR code</h6>
                    @if($branches->qr_code)
                    <div id='qr_code' class="m-3 p-5" style="text-align: center;">
                        <div style="display: inline-block; padding: 20px; margin-top: 20px; border:1px solid #000000;">
                            <div style="text-align: center;font-size: 20px; font-weight: bold; text-transform: uppercase; margin-bottom: 20px;">{!! $branches->name !!}</div>
                            <div style="text-align: center;">{!! $branches->qr_code !!}</div>
                        </div>
                    </div>
                    <button class="btn btn-info mx-auto" onclick="downloadSvg()" value="{{$branches->name}}">
                        <i class="link-icon" data-feather="download">Download</i>
                    </button>
                    @else
                    <div id='qr_code' class="display-5 font-weight-bolder m-3 p-5 text-center text-danger">No QR code</div>
                    <a href="{{ route('employer.branch.generate_branch_qrcode',$branches->id) }}" class="btn btn-primary mx-auto">Generate QR Code</a>
                    @endif
                </div></div>
    </div>
@endsection
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
    <script>
        function downloadSvg() {
            const svg = document.getElementById('qr_code');
            const svgString = new XMLSerializer().serializeToString(svg);
            const blob = new Blob([svgString], { type: 'image/svg+xml' });
            const url = URL.createObjectURL(blob);

            const link = document.createElement('a');
            link.download = 'employer-business-qr.svg';
            link.href = url;
            link.click();

            URL.revokeObjectURL(url);
            }
    </script>
@endpush
