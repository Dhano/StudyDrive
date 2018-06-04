$(function () {

    //zip.FileWriter("C:\Users\Dhananjay\Desktop\Bimage.jpg");
    
    /*FOR FILE / FOLDER UPLOAD*/
    $('#btnCreateFolder').click(function () {
        $("#new-folder-form").submit();
    });

    $("#fileUpload").change(function (){
        var file = document.getElementById("fileUpload").files[0];
        uploadFile(file);
        window.alert("file was selected");
    });
    
    $("#folderUpload").change(function (event){
        var files=event.target.files;
        folderName=files[0].webkitRelativePath.substr(0,files[0].webkitRelativePath.indexOf('/'));
        window.alert("Folder selected "+files.length);
        uploadFolder(files);
    });
    
 
    /*********************************************************************************************************************************************************************UPLOAD A FILE************************************************************* ************************************************************************************************************************/
     function uploadFile(file) {
                if (file){

                    var onLoadFunction=function loaded(evt) {
                        window.alert("file was loaded");
                        // Obtain the read file data
                        var fileString = evt.target.result;
                        var hash = fileHashSHA512(fileString);
                        var hashStr=new String(hash);
                        compareHash(hashStr);
                    }

                    var onErrorFunction=function(evt){
                        window.alert(evt.target.error.name);
                    }

                    var onProgressFunction=function(evt){
                        if (evt.lengthComputable) {
                            // evt.loaded and evt.total are ProgressEvent properties
                            var loaded = (evt.loaded / evt.total);
                            if (loaded < 1) {
                                // Increase the prog bar length
                                // style.width = (loaded * 200) + "px";
                            }
                        }
                    }


                    getAsText(file,onLoadFunction,onErrorFunction,onProgressFunction);
                }
            }
    
    
            function compareHash(hashStr){
                parent_file_id=$("#file_id").text();
                window.alert(parent_file_id);
                $.get("ajaxhelper.php?task=compareHash&hashStr="+hashStr+"&file_id="+parent_file_id+"&file_name="+fileName,function(data){
                    str=JSON.stringify(data);
                    window.alert("The value of data"+str);
                    if(str.includes('true')==true){
                        window.alert("file Uploaded as it was already there");
                        location.reload();
                    }else{
                        $("#actionForm").attr("action","index.php?file_id="+parent_file_id+"&fileHash="+hashStr);
                         $("#actionForm").submit();
                    }
                });    
            }

 /*********************************************************************************************************************************************************************END OF UPLOAD FILE************************************************************* ************************************************************************************************************************/ 
    
    
 /*********************************************************************************************************************************************************************UPLOAD A FOLDER************************************************************* ************************************************************************************************************************/
 function uploadFolder(files) {
     window.alert("Inside Folder Upload");
     var count = 0;
     var zip = new JSZip();


     $.each(files, function (index) {

         var path = files[index].webkitRelativePath;
         file = files[index];

         var onLoadFunction = function loaded(evt) {
             //window.alert(event.target.result);
             var fileData = evt.target.result;
             zip.file(path, fileData, {binary: true});
             count = count + 1;
             //window.alert(files.length+"Index"+index);
             if ((files.length) == count) {
                 window.alert("Calling uploadZip");
                 uploadZip(zip);
             }

         }

         var onErrorFunction = function (evt) {
             window.alert(evt.target.error.name);
         }

         var onProgressFunction = function (evt) {
             if (evt.lengthComputable) {
                 // evt.loaded and evt.total are ProgressEvent properties
                 var loaded = (evt.loaded / evt.total);
                 if (loaded < 1) {
                     // Increase the prog bar length
                     // style.width = (loaded * 200) + "px";
                 }
             }
         }

         getAsArrayBuffer(file, onLoadFunction, onErrorFunction, onProgressFunction)
     });
 }

    function uploadZip(folderZip) {

        window.alert("Upload Folder Zip");
        folderZip.generateAsync({
            type: "blob"
        }).then(function (blob) { // 1) generate the zip file
            //window.alert("The value of blob is"+blob);
            parent_file_id = $("#file_id").text();
            /*var reader = new FileReader();
            reader.onload = function (event) {
                window.alert("Creating Blob");
                window.alert("The value of blob is" + event.target.result);
            };
            reader.readAsText(blob);*/

            saveAs(blob, "test.zip");
            var fd = new FormData();

            fd.append('folderName', folderName);
            fd.append('data', blob);

            window.alert("AJAX Calling");
            $.ajax({
                type: 'POST',
                url: 'ajaxhelper.php?task=unzipAndStore&file_id=' + parent_file_id,
                data: fd,
                processData: false,
                contentType: false
            }).done(function (data) {
                window.alert("AJAX DONE " + data);
                location.reload();
            })

            //saveAs(blob, "hello.zip");

            // 2) trigger the download
        }, function (err) {
            window.alert("What is the error " + err);
        });

    }



    /*********************************************************************************************************************************************************************END OF UPLOAD FOLDER************************************************************* ************************************************************************************************************************/
    
    

    /*GLOBAL SECTION*/
    
    var fileName="";
    
    var folderName="";
    
    function getAsArrayBuffer(readFile,onLoadFunction,onErrorFunction,onProgressFunction) {
        var reader = new FileReader();
        // Read file into memory as UTF-16
        reader.readAsArrayBuffer(readFile);
        fileName=readFile.name;
        // Handle progress, success, and errors
        reader.onprogress = onProgressFunction;
        reader.onload = onLoadFunction;
        reader.onerror = onErrorFunction;
    }

    function getAsText(readFile,onLoadFunction,onErrorFunction,onProgressFunction) {
        var reader = new FileReader();
        // Read file into memory as UTF-16
        reader.readAsText(readFile);
        fileName=readFile.name;
        // Handle progress, success, and errors
        reader.onprogress = onProgressFunction;
        reader.onload = onLoadFunction;
        reader.onerror = onErrorFunction;
    }
    
    
    function fileHashSHA512(fileString){
                var hash=CryptoJS.SHA512(fileString);
                return hash;
    }
    
    /*END OF GLOBAL SECTION*/
    

});





