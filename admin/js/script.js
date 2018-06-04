$(function () {
    
    /*Listener to the standards select input*/
    $("#std_id").change(function (event) {
        var value = $("#std_id option:selected").val();
        //window.alert("you selected " + value);
        
        $.get("ajaxhelper.php?std_id="+value, function (data) {
            //window.alert(data);
            $("#s_id").empty();
            while(data.indexOf('-')!=-1){
                v=data.slice(data.indexOf('-')+1,data.indexOf(','));
               // window.alert(v);
                c=data.slice(data.indexOf(',')+1,data.indexOf('?'));
                //window.alert(c);
                data=data.slice(data.indexOf('?')+1);
                $("#s_id").append("<option value='"+v+"'>"+c+"</option>");
            }
            
            $('#s_id').val(v).trigger('change');
            
        });
    });
    /*end Listener to the standards select input*/
    
    
    /*Listener to the subjects select input*/
    $("#s_id").change(function (event) {
        var value = $("#s_id option:selected").val();
        //window.alert("you selected " + value);
        
        $.get("ajaxhelper.php?s_id="+value, function (data) {
            //window.alert(data);
            $("#c_id").empty();
            while(data.indexOf('-')!=-1){
                v=data.slice(data.indexOf('-')+1,data.indexOf(','));
               // window.alert(v);
                c=data.slice(data.indexOf(',')+1,data.indexOf('?'));
                //window.alert(c);
                data=data.slice(data.indexOf('?')+1);
                $("#c_id").append("<option value='"+v+"'>"+c+"</option>");
            }
        });
    });
    /*end Listener to the subjetcs select input*/
});