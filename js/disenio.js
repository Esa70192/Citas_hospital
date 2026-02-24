let diseño_actual = null;

function Diseño(num) {
    diseño_actual = num;
    fetch('diseño.php?diseño=' + num)
        .then(res => res.text())         
        .then(html => {
            document.getElementById('contenido').innerHTML = html; 

            $('.select2').each(function() {
                $(this).select2({
                    placeholder: $(this).data('placeholder'),
                    allowClear: true,
                    width: '100%'
                });
            });
        });
}