function moshist(){
    
    //alert("hola");
    $.ajax({
       type:"POST",
        url:"validar.php",
        data:"histcot="+ 40,
        success:function(r){
           $('#histcot').html(r);
            document.getElementById('cardhist').style.display='block';
            $('#dataTable').DataTable();
        } 
    });
}

function cotcli(num) {
    $.ajax({
       type:"POST",
        url:"Cotizadorhist/generar/generar-pdf-cliente.php",
        data:"nuncot="+ num,
        success:function(r){
           $('#histcot').html(r);
        } 
    });
}

