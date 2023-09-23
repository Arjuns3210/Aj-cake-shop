
window.addEventListener('load', function() {

     $(document).ready(function() {
            $('#sortingBy').change(function(){

                    var sortingBy=$(this).val();
                    var catId=$("#catId").val();
                        // alert(catId);

                    $.ajax({
                    type: "get",
                    url: "../sortingCake", 
                    cache: false,               
                    data: { sortingBy: sortingBy,catId:catId},
                    dataType: "json",
                    success: function(val){
                    var insert_html = '';

                        console.log(val);
                      
                        // console.log(val[1].img_name);

                    for(i=0;i<val.length;i++){

                        var id=val[i].id;
                        var cake_name=val[i].cake_name;
                        var img_name=val[i].img_name;
                        pic=jQuery.parseJSON(img_name);

                        var cake_price=val[i].cake_price;
                        var cake_url=val[i].cake_url;
                        var img="";

                        insert_html += '<a href="../buy/'+cake_url+'" class="no-decoration">';
                        insert_html += ' <div class="card3">';
                        insert_html += ' <div id="cake'+id+'" class="carousel slide" data-bs-ride="carousel">';
                        insert_html += ' <div class="carousel-indicators"> ';
                        var cl = 'active';
                        for(let j=0;j<pic.length;j++){
                            if(j > 0) {
                                cl = '';
                            }
                        insert_html += ' <button type="button" data-bs-target="#cake'+id+'" data-bs-slide-to='+j+' class="'+cl+'" style="background-color:red;border-radius: 50%;height: 15px;width: 15px;"></button> ';
                        }

                        insert_html += ' </div> ';
                        insert_html += ' <div class="carousel-inner"> ';

                        for (let x=0;x<pic.length;x++) {
                            if(x==0){
                                insert_html += ' <div class="carousel-item active"> ';
                            }else{
                                insert_html += ' <div class="carousel-item"> ';
                            }
                           
                        insert_html += ' <img class="card-img-top" src="../public/images/'+pic[x]+'" alt="Card image" style="width:100%"> ';
                            
                        insert_html += ' </div> ';
                        }

                        insert_html += ' </div> ';
                        insert_html += ' <button class="carousel-control-prev" type="button" data-bs-target="#cake'+id+'" data-bs-slide="prev"><i class="fa fa-arrow-left" style="font-size: 30px;color: red;"></i></button> ';
                        insert_html += ' <button class="carousel-control-next" type="button" data-bs-target="#cake'+id+'" data-bs-slide="next"><i class="fa fa-arrow-right" style="font-size: 30px;color: red;"></i></button></div> ';
                        insert_html += ' <div class="card-body"><h5 class="mt-2 text-left">'+cake_name+'</h5><p class="card-text"><i class="fas fa-rupee-sign"></i>'+cake_price+'</p></div> ';
                        insert_html += '  </div></a> ';

                    $("#cakedata").html(insert_html);
                    }



                    try{     
                    }catch(e) {     
                        alert('Exception while request..');
                    }   

                    },
                    error: function(){                      
                        alert('Error while request..');
                    }

                        });
                });
    });

    //for delete 
    $('.delete-data').click(function(){
        var id = $(this).attr('id');
        var url = $(this).attr('data-url');
        // var final_id = id.substr(6);
        // alert(final_id);
        Swal.fire({
          title: 'Are you sure?<br><h5>You want to delete</h5>',
          width:500,
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Delete it!',

        }).then((result) => {
          if (result.isConfirmed) {
            
            
        $.ajax({
            type:"get",
            url:url,
            data:{id:id},
            success:function(data){
                var response = JSON.stringify(data);

                Swal.fire({
                  title: '<h4 style="color:green;">'+data["success"]+'</h4>',
                  width: 300,
                  icon: 'success',
                  showConfirmButton: false,
                  },
                )
                setTimeout(function(){
                    location.reload();
                },1500);
            
            }
        });
          }
        })
    
    });

});

//for cart add and sub
function changeQty(process, id){

       
            var cPrice=parseInt($('#cakePrice'+id).text());
            var valOld=parseInt($('#qty'+id).val());
            var addPrice=cPrice/valOld;
 
        if(process == 'add') {
            var price=addPrice+cPrice;
            var val=parseInt($('#qty'+id).val())+1;
        } else {
            price=cPrice-addPrice;
            var val=parseInt($('#qty'+id).val())-1;
        }

        $('#qty'+id).val(val);

        if(val > 9){
            $('#add'+id).hide();

        } else {
            $('#add'+id).show();
        }
        if(val > 1){
            $('#sub'+id).show();

        } else {
            $('#sub'+id).hide();
        }
         
        $.ajax({
            type:"post",
            cache:false,
            url:'cart/update/'+id+'/'+val+'/'+price,
            data:{'_token': $('meta[name="csrf-token"]').attr('content') ,id: id,val:val},
            dataType:"json",

            success:function(data){

                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  width:300,
                  title: '<h4 style="color:green;">'+data["message"]+'</h4>',
                  showConfirmButton: false,
                })
                setTimeout(function(){
                    location.reload();
                },1500);
            }
        });
        
}

$(document).ready(function () {
        var today = new Date();
        $('.datepicker').datepicker({
            format: 'dd-MM-yyyy',
            autoclose:true,
            endDate: "today",
            maxDate: today
        }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });


        $('.datepicker').keyup(function () {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9^-]/g, '');
            }
        });
    });
