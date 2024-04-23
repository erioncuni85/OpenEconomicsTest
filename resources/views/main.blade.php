@extends('components.layouts.app')
@section('head')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
@section('content')
<div class="row g-2 p-2 m-0">
    <div class="col-lg-2 text-center p-2 m-0">
        <h3 class="m-0">Regions</h3>
        <div class="m-2 mx-auto" id="regions">
        </div>
        <div class="d-flex justify-content-center align-items-center d-none" id="spinner-regions">
            <div class="spinner-border text-primary spinner-border-sm" role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
    </div>

    <div class="col p-2 m-0">
        <div class="row justify-content-between">
            <div class="col-auto">
                <h3 class="mb-3">Species</h3>
            </div>

            <div class="col-auto">
                <select name="" id="" class="form-select" onchange="loadSpeciesByClass(this.value, this)">
                    <option disabled selected value="">Class</option>
                    <option value="MAMMALIA">Mammalia</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-borderless table-secondary align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Taxonid</th>
                        <th>Common name</th>
                        <th>Scientific name</th>
                        <th>Category</th>
                        <th>Phylum name</th>
                        <th>Kingdom</th>
                        <th>Family</th>
                        <th>Class</th>
                        <th>Order</th>
                        <th>Taxonomic authority</th>
                        <th>Genus name</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" id="species">
                    <tr class="table-primary">
                        <td colspan="11" class="text-center">Select a region!</td>
                    </tr>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
        <div class="d-flex justify-content-center align-items-center d-none" id="spinner-species">
            <div class="spinner-border text-primary spinner-border-sm" role="status">
                <span class="visually-hidden"></span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/custom-table.js')}}"></script>
@endsection
</body>

</html>