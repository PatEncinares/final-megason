// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable({
        buttons : [
            'excel','pdf','print'
        ]
    });
});