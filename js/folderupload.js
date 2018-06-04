self.importScripts('jszip.js');
    // script is now loaded and executed.

onmessage = function(e) {
  console.log('Message received from main script');
    var folderZip=e;
    folderZip.generateAsync({
            type: "blob"
        }).then(function (blob) { // 1) generate the zip file
            //window.alert("The value of blob is"+blob);
            /*var reader = new FileReader();
            reader.onload = function (event) {
                window.alert("Creating Blob");
                window.alert("The value of blob is" + event.target.result);
            };
            reader.readAsText(blob);*/

            saveAs(blob, "test.zip");
        
            //saveAs(blob, "hello.zip");

            // 2) trigger the download
        }, function (err) {
            window.alert("What is the error " + err);
        });
  console.log('Posting message back to main script');
  postMessage(workerResult);
}




  