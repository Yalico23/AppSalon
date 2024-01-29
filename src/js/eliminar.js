function confirmDelete(event, Id) {
    event.preventDefault(); // Previne el envío del formulario inmediatamente

    Swal.fire({
        title: 'Confirmación',
        text: '¿Estás seguro de que deseas eliminar este registro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            console.log(Id);
            document.getElementById(Id).submit();
        }
    });
}