@extends('layouts.guest')
@section('content')
    <div>
        <h2 class="h4 text-title marbot20">Application Form / استمارة طلب</h2>

        @if($application->paid)
            <div class="alert alert-success mt-3">
                <div>
                    <strong>Invoice paid successfully.</strong>
                </div>
                <div class="row">
                    <div class="col-3">
                        <strong>Invoice ID</strong>: {{ $application->invoiceId }}
                    </div>
                    <div class="col-3">
                        <strong>Price</strong>: {{ number_format($application->price , 2) }} KD
                    </div>
                    <div class="col-3">
                        <strong>Invoice Reference</strong>: {{ $application->invoiceReference }}
                    </div>
                    <div class="col-3" title="{{ $application->paid_at }}">
                        <strong>Paid At</strong>: {{ $application->paid_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-danger mt-3">
                <div>
                    <strong>{{ request()->has('msg') ? request()->get('msg') : 'There is a problem in paying the invoice. Please try again.' }}</strong>
                </div>
                @if($application->grade->is_active)
                <div class="mt-3">
                    <a class="btn btn-warning" href="{{ route('application.pay' , ['uuid'  => $application->uuid]) }}">
                        Pay Now
                    </a>
                </div>
                @endif
            </div>
        @endif

        <div class="mt-3 mb-3 form-group">
            <label for="txtSPreviousSchool">Your Application Link:</label>
            <input value="{{ route('application.show' , ['uuid' => $application->uuid])  }}" readonly
                   class="form-control">
        </div>
        <div class="mt-3 mb-3 form-group">
            <button onclick="window.print();" class="btn btn-lg btn-outline-dark">
                <img style="margin-right: 10px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAw0lEQVR4nOWVsQ3CMBBFX0FHGQq6tNBCzQbZIQPABpHoGcHKDKSHBaCgzgQMgiJdpFNw7CNOx5dOLu70fDrb3/CtHNgbI8cgB1xlDUVfE5WT3WPqapyh7h+AS+AJvBLjISx2QE26amHZZ+HRAXgDKz2qFOAaOAOLuYBao8Dqh4OoLMCp18bFgGWgszIE3AI35SCNrJnHXTaDDhuVu+v8SblIKwWFx2EuA2Crcsex2bgAsI9iylvOAsba58zAWQ026Qv4ADzcXRgFrjG/AAAAAElFTkSuQmCC">
                Print
            </button>
        </div>
        @include('report' , ['application' => $application])
        <div class="mt-3"></div>
    </div>
@endsection
