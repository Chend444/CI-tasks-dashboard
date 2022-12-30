<script>
    $('table').DataTable({
        "columns": [
            { "searchable": false,"orderable": false },  // disable sorting on first column
            { "searchable": false, "orderable": true }, //name
            { "searchable": false, "orderable": false },//text
            { "searchable": true, "orderable": true },//status
            { "searchable": true, "orderable": true },//due
            { "searchable": true, "orderable": true },//creation
            { "searchable": false,"orderable": false }  // disable sorting on last column
        ]
    });

    $('.delete_row').click(function() {
        let id = $(this).data('id');
        $.ajax({
            url: '/tasks/' + id,
            type: 'DELETE',
            success: function(result) {
                $('*[data-id='+id+']').closest('tr').remove();
            },
            error: function(xhr, status, error) {
                if (xhr.status === 400) {
                    let errorMes = JSON.parse(xhr.responseText);
                    alert(errorMes.error);
                }
            }
        });
    });
    $('.edit_row').click(function() {
        let id = $(this).data('id');
        let text = $(this).closest('tr').find('td[data-text]').data('text');
        let status = $(this).closest('tr').find('td[data-status]').data('status');
        $('#edit_text').val(text);
        $('#edit_status').val(status);
        $('#edit_id').val(id);
    });

    $('#editEmployeeModal form').submit(function(event) {
        event.preventDefault();  // Prevent the form from being submitted normally

        // Get the values of the text and status fields
        let text = $('#edit_text').val();
        let status = $('#edit_status').val();
        let id = $('#edit_id').val();

        $.ajax({
            url: '/tasks/' + id,
            type: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify({text: text, status: status}),
            success: function(result) {
                // Update the table row with the new values
                let row = $('*[data-id='+id+']').closest('tr');
                row.find('td[data-text]').data('text', text).text(text);
                row.find('td[data-status]').data('status', status).text(status);
                $('#edit_close').click();
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                alert(xhr);
            }
        });
    });

    $('#addEmployeeModal form').submit(function(event) {
        event.preventDefault();  // Prevent the form from being submitted normally

        // Get the values of the text and status fields
        let name = $('#add_name').val();
        let text = $('#add_text').val();
        let status = $('#add_status').val();
        let due_date = $('#add_due_date').val();


        $.ajax({
            url: '/tasks',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({text: text, status: status,name: name,due_date:due_date}),
            success: function(result) {
                // Update the table row with the new values
                // let row = $('*[data-id='+id+']').closest('tr');
                // row.find('td[data-text]').data('text', text).text(text);
                // row.find('td[data-status]').data('status', status).text(status);
                location.reload();
                // $('#add_close').click();
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                alert(xhr);
            }
        });
    });


</script>
