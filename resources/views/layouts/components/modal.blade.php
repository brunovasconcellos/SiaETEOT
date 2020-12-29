<!-- Modal -->
<div class="modal fade" id="{{$modalId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form form id="{{$formId}}" class="" enctype="multipart/form-data">
        <div class="modal-body">

        @csrf
        <input id="{{$methodId}}" name="_method" type="hidden" value="">
          <div id="input-box" class="form-group">
            {{$inputs}}
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="{{$modalId}}" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>