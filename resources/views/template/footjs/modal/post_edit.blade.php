<script>
    function editModal(route,id,modal = null) {
		var modalId = '#edit-form'; 
		if(modal) modalId = modal;
		
        $('.modal-load').show();
        $('.modal-body').hide();
            
        $.post(route,
        {
           '_token': $('meta[name=csrf-token]').attr('content'),
            id: id
        },
        function(response) {
            $(modalId+' .modal-body').html(response);
            $('.modal-load').hide();
            $('.modal-body').show();
        });
    }
</script>
