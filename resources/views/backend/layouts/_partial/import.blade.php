
<div class="modal fade" id="{{ $id ?? 'importExcel' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ $route }}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Import Excel File </h4>
                </div>
                <div class="modal-body">
                    @if(!empty($fields))
                        @foreach($fields as $field)
                            <div class="form-group">
                                <label for="{{ $field['label']  }}"> {{ $field['label'] }} </label>
                                @if($field['type'] == 'select')
                                    <select name="{{ $field['name']  }}" id="{{ $field['label']  }}" class="form-control">
                                        @foreach($field['options'] as $key => $value)
                                            <option value="{{ $key  }}">{{ $value  }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="{{ $field['type'] ?? 'text'  }}" name="{{ $field['name']  }}" id="{{ $field['label']  }}"  class="form-control">
                                @endif
                            </div>
                        @endforeach
                    @endif
                    <div class="form-group">
                        <label for="ExcelFileInput"> Select File </label>
                        @csrf
                        <input type="file" id="ExcelFileInput" name="file" accept=".xlsx, .xls" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
