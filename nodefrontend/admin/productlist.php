<!DOCTYPE html>
<html>
   <head>
      <title>Product List</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
      <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      
      <style>
         .delete{
            cursor: pointer;

         }
             #loader{
  position: fixed;
    width: 100%;
    height: 100vh;
    background-color: rgba(0, 0, 0, .5);
    inset: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}
         body{
         background-color: #eee; 
         }
         table th , table td{
         text-align: center;
         }
         table tr:nth-child(even){
         background-color: #BEF2F5
         }
         .pagination li:hover{
         cursor: pointer;
         }
         /* table tbody tr {
         display: none;
         } */
      </style>
      <!-- nav -->
   <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
  <style>
   body {
   font-family: Arial, Helvetica, sans-serif;
   }

   .navbar {
   overflow: hidden;
   background-color: #333;
   }

   .navbar a {
   float: left;
   font-size: 16px;
   color: white;
   text-align: center;
   padding: 14px 16px;
   text-decoration: none;
   }

   .dropdown {
   float: left;
   overflow: hidden;
   }

   .dropdown .dropbtn {
   font-size: 16px;  
   border: none;
   outline: none;
   color: white;
   padding: 14px 16px;
   background-color: inherit;
   font-family: inherit;
   margin: 0;
   }

   .navbar a:hover, .dropdown:hover .dropbtn {
   background-color: red;
   }

   .dropdown-content {
   display: none;
   position: absolute;
   background-color: #f9f9f9;
   min-width: 160px;
   box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
   z-index: 1;
   }

   .dropdown-content a {
   float: none;
   color: black;
   padding: 12px 16px;
   text-decoration: none;
   display: block;
   text-align: left;
   }

   .dropdown-content a:hover {
   background-color: #ddd;
   }

   .dropdown:hover .dropdown-content {
   display: block;
   }
   </style>
      <!-- nav -->
   </head>
   <body>
   <div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>Admin</h2>
      <ul class="nav nav-pills nav-stacked">
        <li ><a href="http://localhost/nodefrontend/admin/dashboard.php">Dashboard</a></li>
        <li class=""><a href="http://localhost/nodefrontend/">Offer</a></li>
        <li class="active"><a href="http://localhost/nodefrontend/admin/productlist.php">Product List</a></li>
        <li><a href="http://localhost/nodefrontend/admin/orders.php">Order List</a></li>
        <li><a href="http://localhost/nodefrontend/admin/userlist.php">User List</a></li>
        <!-- <li><a href="http://localhost/nodefrontend/admin/profile.php">My Account</a></li> -->
        <li onclick="logout()"><a href="javascript:void(0);">Logout</a></li>
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-9">

      <div class="row">
       <div class="container">
         <h2>Product List</h2>
         <br>
               <span id="successmsg"></span>
         <br><span id="errormsg"></span><br>
         <button class="w3-button w3-black"><a href="http://localhost/nodefrontend/admin/product-add.php">Add </a></button><br><br>

         <div class="form-group">
            <!--		Show Numbers Of Rows 		-->
            <select class  ="form-control" name="state" id="maxRows">
               <option value="5000">Show ALL Rows</option>
               <option value="5">5</option>
               <option value="10">10</option>
               <option value="15">15</option>
               <option value="20">20</option>
               <option value="50">50</option>
               <option value="70">70</option>
               <option value="100">100</option>
            </select>
         </div>
         <table class="table table-striped table-class" id= "table-id">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>edit/Delete</th>
               </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
         </table>
         <!--		Start Pagination -->
         <div class='pagination-container' >
            <nav>
               <ul class="pagination">
                  <li data-page="prev" >
                     <span> < <span class="sr-only">(current)</span></span>
                  </li>
                  <!--	Here the JS Function Will Add the Rows -->
                  <li data-page="next" id="prev">
                     <span> > <span class="sr-only">(current)</span></span>
                  </li>
               </ul>
            </nav>
         </div>
      </div>

      </div>

  </div>
</div>
<div style="display:none;" id="loader">
<img  src="https://media.tenor.com/wpSo-8CrXqUAAAAi/loading-loading-forever.gif" width="200" height="200">
</div>     
      <!-- 		End of Container -->
      <!--  Developed By Yasser Mas -->
      <script>
         getPagination('#table-id');
         //getPagination('.table-class');
         //getPagination('table');
         
         /*					PAGINATION 
         - on change max rows select options fade out all rows gt option value mx = 5
         - append pagination list as per numbers of rows / max rows option (20row/5= 4pages )
         - each pagination li on click -> fade out all tr gt max rows * li num and (5*pagenum 2 = 10 rows)
         - fade out all tr lt max rows * li num - max rows ((5*pagenum 2 = 10) - 5)
         - fade in all tr between (maxRows*PageNum) and (maxRows*pageNum)- MaxRows 
         */
         
         
         function getPagination(table) {
         var lastPage = 1;
         
         $('#maxRows')
         .on('change', function(evt) {
         //$('.paginationprev').html('');						// reset pagination
         
         lastPage = 1;
         $('.pagination')
         .find('li')
         .slice(1, -1)
         .remove();
         var trnum = 0; // reset tr counter
         var maxRows = parseInt($(this).val()); // get Max Rows from select option
         
         if (maxRows == 5000) {
         $('.pagination').hide();
         } else {
         $('.pagination').show();
         }
         
         var totalRows = $(table + ' tbody tr').length; // numbers of rows
         $(table + ' tr:gt(0)').each(function() {
         // each TR in  table and not the header
         trnum++; // Start Counter
         if (trnum > maxRows) {
         // if tr number gt maxRows
         
         $(this).hide(); // fade it out
         }
         if (trnum <= maxRows) {
         $(this).show();
         } // else fade in Important in case if it ..
         }); //  was fade out to fade it in
         if (totalRows > maxRows) {
         // if tr total rows gt max rows option
         var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
         //	numbers of pages
         for (var i = 1; i <= pagenum; ) {
         // for each page append pagination li
         $('.pagination #prev')
         .before(
         '<li data-page="' +
         i +
         '">\
         <span>' +
         i++ +
         '<span class="sr-only">(current)</span></span>\
         </li>'
         )
         .show();
         } // end for i
         } // end if row count > max rows
         $('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
         $('.pagination li').on('click', function(evt) {
         // on click each page
         evt.stopImmediatePropagation();
         evt.preventDefault();
         var pageNum = $(this).attr('data-page'); // get it's number
         
         var maxRows = parseInt($('#maxRows').val()); // get Max Rows from select option
         
         if (pageNum == 'prev') {
         if (lastPage == 1) {
         return;
         }
         pageNum = --lastPage;
         }
         if (pageNum == 'next') {
         if (lastPage == $('.pagination li').length - 2) {
         return;
         }
         pageNum = ++lastPage;
         }
         
         lastPage = pageNum;
         var trIndex = 0; // reset tr counter
         $('.pagination li').removeClass('active'); // remove active class from all li
         $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
         // $(this).addClass('active');					// add active class to the clicked
         limitPagging();
         $(table + ' tr:gt(0)').each(function() {
         // each tr in table not the header
         trIndex++; // tr index counter
         // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
         if (
         trIndex > maxRows * pageNum ||
         trIndex <= maxRows * pageNum - maxRows
         ) {
         $(this).hide();
         } else {
         $(this).show();
         } //else fade in
         }); // end of for each tr in table
         }); // end of on click pagination list
         limitPagging();
         })
         .val(5)
         .change();
         
         // end of on select change
         
         // END OF PAGINATION
         }
         
         function limitPagging(){
         // alert($('.pagination li').length)
         
         if($('.pagination li').length > 7 ){
         if( $('.pagination li.active').attr('data-page') <= 3 ){
         $('.pagination li:gt(5)').hide();
         $('.pagination li:lt(5)').show();
         $('.pagination [data-page="next"]').show();
         }if ($('.pagination li.active').attr('data-page') > 3){
         $('.pagination li:gt(0)').hide();
         $('.pagination [data-page="next"]').show();
         for( let i = ( parseInt($('.pagination li.active').attr('data-page'))  -2 )  ; i <= ( parseInt($('.pagination li.active').attr('data-page'))  + 2 ) ; i++ ){
         $('.pagination [data-page="'+i+'"]').show();
         
         }
         
         }
         }
         }
         
         $(function() {
         // Just to append id number for each row
         $('table tr:eq(0)').prepend('<th> ID </th>');
         
         var id = 0;
         
         $('table tr:gt(0)').each(function() {
         id++;
         $(this).prepend('<td>' + id + '</td>');
         });
         });
         
         //  Developed By Yasser Mas
         // yasser.mas2@gmail.com
         
      </script>    
      <script>
         $(window).on('load', function () {  
            $("#loader").show(); 
           var accessToken ="";
           accessToken=localStorage.getItem("accessToken");
           if(accessToken=="" || accessToken == null){
            window.location.href = "http://localhost/nodefrontend/login.php";
           }else{    
            //productlist
            var accessTokenBearer ="Bearer "+accessToken;
            var settings = {
              "url": "http://localhost:5001/api/products",
              "method": "GET",
              "timeout": 0,
              "headers": {
                "Authorization": accessTokenBearer
              },
            };
         
            $.ajax(settings).done(function (response) {
               if(response.data!=""){
                  $.each(response.data, function(key, val) {
                  var data;
                  data +="<tr><td>"+(key+1)+"</td><td>"+val.name+".</td><td>"+val.image+".</td><td>"+val.price+"</td><td><a href='http://localhost/nodefrontend/admin/product-edit.php?id="+val._id+"'><i class='fas fa-edit' data-attr='"+val._id+"' cl></i></a><i class='fas fa-trash delete' data_id='"+val._id+"' ></i></td></tr>";
                  $('#tbody').append(data);
                  return data;
                  });
                  $("#loader").hide(); 
               }else{
                  $("#errormsg").text("Something went wrong please try again after sometime....");
               }
         
                
              });
           }          
           $(document).ready(function() {              
               $(document).on("click",".delete",function() {
                  $("#loader").show(); 
                  var pid=$(this).attr("data_id");

                  var accessTokenBearer ="Bearer "+accessToken;
                  var settings1 = {
                  "url": "http://localhost:5001/api/products/"+pid,
                  "method": "DELETE",
                  "timeout": 0,
                  "headers": {
                     "Authorization": accessTokenBearer
                  },
                  };
               
                  $.ajax(settings1).done(function (response) {
                     if(response.data!=""){
                        $("#successmsg").text("Product Delete Successfully...");
                        setTimeout(function() { 
                        $("#successmsg").hide();               
                        window.location.href = "http://localhost/nodefrontend/admin/productlist.php";
                        },
                        5000);
                        $("#loader").hide(); 
                     }else{
                        $("#errormsg").text("Something went wrong please try again after sometime....");
                     }
         
                
              });


           });

              
            });
          });
          
          function logout() {
    localStorage.clear();
    window.location.href = "http://localhost/nodefrontend/login.php";
  }
          
      </script>
   </body>
</html>