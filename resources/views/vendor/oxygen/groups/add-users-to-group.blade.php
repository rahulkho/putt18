<div class="modal fade" id="userControlModal" tabindex="-1" role="dialog" aria-labelledby="userControlModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="usersForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-header">
                    <h5 class="modal-title" id="userControlModalLabel">Headline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <p>Assign users to one or many groups.</p>

                    <div class="form-group multi-select-wrapper">
                        <label for="recipient-name" class="control-label">Select Groups</label>
                        <select class="form-control select2" id="selectRoles" name="selectRoles[]" multiple="multiple" style="width: 100%">
                            @foreach ($availableRoles as $availableRole)
                                <option value="{{ $availableRole['id'] }}">{{ $availableRole['title'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group multi-select-wrapper">
                        <label for="recipient-name" class="control-label">Select New Users</label>
                        <select class="form-control select2" id="selectUsers" name="selectUsers[]" multiple="multiple" style="width: 100%">
                            @foreach ($users as $selectedUser)
                                <option value="{{ $selectedUser->id }}">{{ $selectedUser->name }} - {{ $selectedUser->email }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="modalErrorMessage" class="alert alert-danger"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-default text-right" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-lg btn-success" id="addUsersButton">
                        <i class="fa fa-spin fa-spinner" id="loadingIndicator"></i> Add User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        $(document).ready(function() {
            var hideModalErrorMessage = function () {
                $('#modalErrorMessage').html('').hide();
            };
            var showLoadingIndicator = function () {
                $('#loadingIndicator').show();
            };
            var hideLoadingIndicator = function () {
                $('#loadingIndicator').hide();
            };

            // multiple drop-down selects
            $('.select2').select2();

            $('#usersForm').validate({
                rules: {
                    'selectRoles[]': {
                        required: true
                    },
                    'selectUsers[]': {
                        required: true
                    }
                },
                submitHandler: function(form) {
                    hideModalErrorMessage();
                    showLoadingIndicator();
                    $.ajax({
                        method: "post",
                        url: "/account/groups/users",
                        data: $(form).serialize()
                    }).done(function( data ) {
                        // don't clear or hide the modal, since we're going to reload the page
                        // clear the drop down
                        // $('.select2').select2('val', []);
                        // $('#userControlModal').modal('hide');

                        // refresh the page
                        window.location.reload();
                    }).fail(function (xhr, status, err) {
                        var message = 'An error occured. Please check your input and try again';
                        if (xhr.responseJSON.message) message = xhr.responseJSON.message;
                        $('#modalErrorMessage').html('<strong>Whoops!</strong> ' + message).show();
                    }).always(function () {
                        hideLoadingIndicator();
                    });
                }
            });


            $('#userControlModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);  // Button that triggered the modal
                var role_id = button.data('role_id'); // Extract info from data-* attributes

                var modal = $(this);

                // select the role by default
                $('#selectRoles').select2('val', role_id);

                modal.find('.modal-title').text('Add New Users to a Group');

                hideModalErrorMessage();
                hideLoadingIndicator();
            });

            $('#userControlModal').on('hidden.bs.modal', function (event) {
                // clear the errors when closing
                hideModalErrorMessage();
            });
        });
    </script>
@endpush
