
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width , initial-scale=1" />

    <title>News Editor</title>
    <link rel="stylesheet" href="/ci-news/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/ci-news/css/styles.css">

    <script src="../scripts/editor/build/ckeditor.js"></script>
    <script>
        
    document.addEventListener("DOMContentLoaded", function () {

        var activeField = null;
        var ckeditorInstance = null;

        //Get all fields
        var ckeditorFields = document.querySelectorAll('.ckeditor-field');

        // Function to restore original content
        function restoreOriginalContent() {
            if (activeField && typeof ckeditorInstance !== 'undefined') {;
                // Get the original content from the data attribute
                var originalContent = activeField.getAttribute('data-original-content');
                // Set the original content back to the field
                activeField.innerHTML = originalContent;

                updateInput(originalContent);
                
            }
        }

        // Update data on the form listaUpdate
        function updateInput(data){
            datatitle = activeField.getAttribute('data-title');
            updateForm = document.querySelector(`form[action="listaUpdate"][data-title="${datatitle}"]`);
            if (updateForm) {
                const titleInput = updateForm.querySelector('input[name="title"]');
                const bodyInput = updateForm.querySelector('input[name="body"]');
                if (titleInput && bodyInput) {
                    titleInput.value = activeField.getAttribute('data-title');
                    bodyInput.value = data;
                }
            }

        }


        // Loop through each element and add dblclicklistener
        ckeditorFields.forEach(function (field) {

            field.addEventListener('dblclick', function () {

                if(activeField == null || activeField !== field)
                {
                    
                    //Restore original
                    restoreOriginalContent();

                    field.setAttribute('data-original-content', field.innerHTML);

                    
                    activeField = field;
                    //Destroy old editor No hace falta por then(editor => {ckeditorInstance = editor; en el creador
                    if (ckeditorInstance && typeof ckeditorInstance.destroy === 'function') {
                            ckeditorInstance.destroy();
                        } 
                    
                    // Get the current text content and create a div
                    var currentContent = field.innerHTML;

                    var div = document.createElement('div');
                    div.innerHTML = currentContent;
                    var datatitle = field.getAttribute('data-title');
                    div.setAttribute('data-title', datatitle);


                    // Replace the content of the td with the div
                    field.innerHTML = '';
                    field.appendChild(div);                
                    

                    // Initialize CKEditor on the created div
                    ClassicEditor
                    .create(div, { 
                        link: {
                        addTargetToExternalLinks: true,  //Esto debería estar en la config
                        defaultProtocol: 'http://'
                        }
                    })
                    .then(editor => {
                        ckeditorInstance = editor;
                        editor.model.document.on('change:data', () => {
                            // Update data on the form listaUpdate
                            updateInput(editor.getData());
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
                }
             });
        })
    })


</script>

