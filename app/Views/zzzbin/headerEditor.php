<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CKEditor 5 – Classic editor</title>
    <script src="../scripts/ckeditor/build/ckeditor.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {

        var activeField = null;
        var ckeditorInstance = null;
        var modifiedNewsArray = [];

        //Get all fields
        var ckeditorFields = document.querySelectorAll('.ckeditor-field');

        // Function to restore original content
        function restoreOriginalContent() {
                if (activeField && typeof ckeditorInstance !== 'undefined') {;
                    // Get the original content from the data attribute
                    var originalContent = activeField.getAttribute('data-original-content');
                    // Set the original content back to the field
                    activeField.innerHTML = originalContent;
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
                    /* if (ckeditorInstance && typeof ckeditorInstance.destroy === 'function') {
                            ckeditorInstance.destroy();
                        } 
                         */
                    // Get the current text content and create a div
                    var currentContent = field.innerHTML;

                    var div = document.createElement('div');
                    div.innerHTML = currentContent;


                    // Replace the content of the td with the div
                    field.innerHTML = '';
                    field.appendChild(div);
                    
                    // Initialize CKEditor on the created div
                    ClassicEditor
                        .create(div)
                        .then(editor => {
                            ckeditorInstance = editor;
                        })
                        .catch(error => {
                            console.error(error);
                        });
                    }
            });
        });
        document.getElementById('saveButton').addEventListener('click', function () {
            if (ckeditorInstance)
            {
                // Get the edited content from CKEditor
                var editedContent = ckeditorInstance.getData();
                var id = activeField.className.split(' ')[1];   
                addModifiedNew(id, editedContent);

                console.log(modifiedNewsArray);
            
                ckeditorInstance.destroy().catch( error => {
                    console.log( error );
                    } );
                
                ckeditorInstance = null;

                activeField.innerHTML = editedContent;


                activeField = null;
            }


        });
        document.getElementById('saveDB').addEventListener('click', function () {
            console.log('hello');
            try {    
                if(ckeditorInstance) {
                    const formData = new FormData();
                    formData.append('title', activeField.getAttribute('data-title'));
                    formData.append('body', ckeditorInstance.getData())

                    fetch('listaUpdate', {
                    method: 'post',
                    body: formData
                });
                }

                console.log('Completed!', response);
            } catch(err) {
                console.error(`Error: ${err}`);
            }
        });
 
        
        // Storage modified news
        function addModifiedNew(id, text) {
            // Check if the ID is unique
            var existingIndex = findIndexById(id);

            if (existingIndex !== -1) {
                // Update the new
                modifiedNewsArray[existingIndex].text = text;
            } else {
                // Create a new object
                var modifiedNew = {
                    id: id,
                    text: text
                };

                // Add the object to the array
                modifiedNewsArray.push(modifiedNew);
            }
        }

            // Function to find the index of an object by its ID
        function findIndexById(id) {
            for (var i = 0; i < modifiedNewsArray.length; i++) {
                if (modifiedNewsArray[i].id === id) {
                    return i;
                }
            }
            return -1; // Return -1 if the ID is not found
        }
    });






</script>
</head>
<body>
    <h1>Classic editor</h1>



    

