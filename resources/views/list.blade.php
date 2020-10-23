<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax todo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
        <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Ajax Todo <a href="#" class="pull-right" data-toggle="modal" data-target="#myModal"><i  id="addnew" class="fa fa-plus" aria-hidden="true"></i></a>
</h3>
  </div>
  <div class="panel-body"id="refresh" >
            <ul class="list-group">
            @foreach($items as $item)
            <li class="list-group-item outItem" data-toggle="modal" data-target="#myModal">{{$item->item}}
            <input type="hidden" id="itemId" value ="{{$item->id}}">
            </li>
            @endforeach
            </ul>
  </div>
</div></div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title">Add New Item</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id"> 
        <p><input type="text" placeholder="write item here" id="addItem" class="form-control"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning " id="delete" data-dismiss="modal" style="display:none">Delete</button>
        <button type="button" class="btn btn-primary" id="saveChanges" style="display:none" >Save changes</button>
        <button type="button" class="btn btn-primary" id="addButton">Add new</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


    
</div>
</div>
{{csrf_field()}}

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<script>
$(document).ready(function(){
  $(document).on('click','.outItem',function(event){
           var text = $(this).text();
           var id = $(this).find("#itemId").val();
           console.log(id);
           $("#title").text('Edit Item');
           $("#delete").show(400);
           $('#saveChanges').show(400);
           var text = $.trim(text);
           $('#addButton').hide(400);
           $("#id").val(id);
           $('#addItem').val(text);
           console.log(text);
           
   });
   $(document).on('click','#addnew',function(event){
           var text = $(this).text();
           $("#title").text('Add new');
           $("#delete").hide(400);
           $('#saveChanges').hide(400);
           $('#addButton').show(400);
           $('#addItem').val(text);

         
   });
   $('#addButton').click(function(event){
       var text = $('#addItem').val();
        // $.post('list',{},{'text':text ,'_token':$('input[name=_token]').val()},function(data){
        // console.log(data);
        // $("#myModal").modal('hide');
        // });
        $.ajax({
          url:"list",
          data:{'text':text},
          headers: {
            'X-CSRF-TOKEN': $('input[name=_token]').val(),
            "head":'abdul',
           
        
    },
    
    dataType:'json',
          type:'post',
          success:function(data){
            console.log(data.data.item);
            $("#myModal").modal('hide');
            $( "#refresh" ). load(window. location. href + " #refresh" );
          },
          error:function(error){
            console.log(error)
          }
        });
     
   });
   $("#delete").click(function (e) { 
    var id = $('#id').val();
     $.post('delete',{'id':id ,'_token':$('input[name=_token]').val()},function(data){
      $( "#refresh" ). load(window. location. href + " #refresh" );
        console.log(data);
        $("#myModal").modal('hide');
        });
   });  
   $("#saveChanges").click(function (e) { 
    var id = $('#id').val();
    var value = $('#addItem').val();
     $.post('Update',{'id':id ,'value':value ,'_token':$('input[name=_token]').val()},function(data){
      $( "#refresh" ). load(window. location. href + " #refresh" );
        console.log(data);
        $("#myModal").modal('hide');
        });
   });   
   
});
</script>
</body>
</html>