require('./bootstrap');

const deleteForm = document.querySelectorAll('.delete-post');
deleteForm.forEach(item => {
    item.addEventListener('submit', function(e){
        const resp = confirm('Vuoi cancellare?');
        if(!resp){
            e.preventDefault();
        }
    })
})

$('.alert').alert()
