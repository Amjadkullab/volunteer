$(document).ready(function(){


      $(document).on('input','#searchbytext',function(e){
        make_search();
      });


      $('input[type=radio][name=searchbyradio]').change(function() {
        make_search();
      });



      function make_search(){
        var searchbytext=$("#searchbytext").val();
        var searchbyradio=$("input[type=radio][name=searchbyradio]:checked").val();
        var token_search=$("#token_search").val();
        var ajax_search_url=$("#ajax_search_url").val();

        jQuery.ajax({
          url:ajax_search_url,
          type:'post',
          dataType:'html',
          cache:false,
          data:{searchbytext:searchbytext,"_token":token_search,searchbyradio:searchbyradio},
          success:function(data){

           $("#ajax_responce_serarchDiv").html(data);
          },
          error:function(){

          }
        });

      }
    });
