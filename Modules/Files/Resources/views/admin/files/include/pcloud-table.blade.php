<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body" id="files-table">
                <div class="table-responsive">
                   
                        <table class="display table table-striped table-hover" >
                            <thead>
                                 <tr>
                                    @include('admin::include.table.select-all',["name"=>clean(trans('files::files.files'))])
                                    <th>{{ clean(trans('files::files.table.name')) }}</th>
   
                                </tr>
                            </thead>

                            <tbody></tbody>
                        </table>
                </div>
            </div>
        </div>
    
    </div>
</div>