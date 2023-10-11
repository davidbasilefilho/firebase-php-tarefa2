<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="../js/script.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $('#sel_outro').hide();
        $('input[type=radio][name="escolha"]').change(function() {
            if ($(this).val() === "Professor") {
                $('#sel_professor').show();
                $('#sel_outro').hide();
            } else if ($(this).val() === "Outro") {
                $('#sel_professor').hide();
                $('#sel_outro').show();
            }
        });
    });
</script>