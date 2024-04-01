<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
  /* Navbar */
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .login-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
  width:120px;
}

.topnav .login-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background-color: #555;
  color: white;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .login-container button:hover {
  background-color: green;
}

@media screen and (max-width: 600px) {
  .topnav .login-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .login-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
}
/* Navbar end*/
/* product list */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  width: 100%;
  text-align: center;
  font-family: arial;
  padding:12px;
}

.price {
  color: grey;
  font-size: 22px;
}

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card button:hover {
  opacity: 0.7;
}

/* product list end*/

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
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>

<div class="topnav">
  <!-- <a class="active" href="#home">Home</a>
  <a href="#about">About</a>
  <a href="#contact">Contact</a> -->
  <div class="login-container">
  <div id="notlogin">
    <button type="submit"> <a href="http://localhost/nodefrontend/login.php" > Login</a></button> 
    <button type="submit"><a href="http://localhost/nodefrontend/register.php" >Register </a></button>
  </div>
  <div id="login">
  <a class="active" href="#home">Home</a>
  <a href="#about">About</a>
  <a href="#productlisting">Product</a>
  <a href="javascript:void(0);"><i class="fa fa-shopping-cart" aria-hidden="true" id="cartproductcount">0</i></a>
  <a href="http://localhost/nodefrontend/orders.php">Orders</a>
  <a href="http://localhost/nodefrontend/profile.php">My Account</a>
  <a href="http://localhost/nodefrontend/admin/dashboard.php" id="admin" style="display:none;">Admin</a>
  <a href="javascript:void(0);" onclick="logout()">Logout</a>
  </div>
  </div>
</div>

<div id="productlisting" class="container">
<div class="row productlist">

</div>
</div>
<div style="display:none;" id="loader">
<img  src="https://media.tenor.com/wpSo-8CrXqUAAAAi/loading-loading-forever.gif" width="200" height="200">
</div>

<script>
         $(window).on('load', function () {  
          $("#loader").show(); 
          var accessToken ="";
           accessToken=localStorage.getItem("accessToken");
           if(accessToken=="" || accessToken == null){
            //not login
            $('#notlogin').show();
            $('#login').hide();


           }else{    
             //login
             $('#notlogin').hide();
             $('#login').show();
             var accessToken =userid=role="";
            accessToken=localStorage.getItem("accessToken");
          
            var accessTokenBearer ="Bearer "+accessToken;
            userid=localStorage.getItem("userid");
            role=localStorage.getItem("role");
            if(role==1){             
              $('#admin').show();              
            }else{
              $('#admin').hide();
            }
             var settings1 = {
              "url": "http://localhost:5001/api/cart/add-to-cart-count",
              "method": "POST",
              "timeout": 0,
              "headers": {
                "Content-Type": "application/json",
                "Authorization": accessTokenBearer      
                         },
              "data": JSON.stringify({
                "userid":userid
              }),
            };

            $.ajax(settings1).done(function (response) {
              if(response){
                $("#cartproductcount").text(response.cartproductcount);
              }else{
                $("#cartproductcount").text("0");
              }
              
            });

           }
            //productlist
            var settings = {
              "url": "http://localhost:5001/api/products/allproducts",
              "method": "GET",
              "timeout": 0,             
            };
         
            $.ajax(settings).done(function (response) {
               if(response.data!=""){
                  var data="";
                  $.each(response.data, function(key, val) {
                  
                  
                  data +="<div class='col-sm-6 col-md-4 col-lg-3'><div class='card'><img src='"+val.image+"' style='width:100%'><h1 id='name'>"+val.name+"</h1><p class='price'>"+val.price+"</p><p id='description'>"+val.description+"</p><p><button id='addtocart' data-id='"+val._id+"' >Add to Cart</button></p><p><button id='"+val._id+"'><a href='http://localhost/nodefrontend/product-details.php/?id="+val._id+"'>Product details</a></button></p></div></div>";

                  



                  return data;
                  });
                  $('.productlist').append(data);
                  $("#loader").hide(); 
               }else{
                  $("#errormsg").text("Something went wrong please try again after sometime....");
               }
         
                
              });
               

          });
          
          function logout() {
            localStorage.clear();
            window.location.href = "http://localhost/nodefrontend/login.php";
          }
          $(document).on("click","#addtocart",function() {
            $("#loader").show(); 
            document.getElementById("addtocart").disabled = true;
            var accessToken =userid=pid="";
            accessToken=localStorage.getItem("accessToken");
          
            var accessTokenBearer ="Bearer "+accessToken;
            var pid=$(this).attr("data-id");
            userid=localStorage.getItem("userid");
            
            if(accessToken=="" || accessToken == null){
                window.location.href = "http://localhost/nodefrontend/login.php";
            }else{   



                var settings = {
                  "url": "http://localhost:5001/api/cart/add-to-cart",
                  "method": "POST",
                  "timeout": 0,
                  "headers": {
                    "Content-Type": "application/json",
                    "Authorization": accessTokenBearer                },
                  "data": JSON.stringify({
                            "productid":pid,
                            "userid":userid
                  }),
                };

                $.ajax(settings).done(function (response) {
                  
                  $("#cartproductcount").text(response.cartproductcount);
                  $("#loader").hide(); 
                  document.getElementById("addtocart").disabled = false;

                });
                }
          });
          
          $(document).on("click","#cartproductcount",function() {
            var accessToken =userid="";
            accessToken=localStorage.getItem("accessToken");
          
            var accessTokenBearer ="Bearer "+accessToken;
            userid=localStorage.getItem("userid");
            
            if(accessToken=="" || accessToken == null){
                window.location.href = "http://localhost/nodefrontend/login.php";
            }else{   

              window.location.href = "http://localhost/nodefrontend/add-to-cart.php";

                }
          });
      </script>
</body>
</html>
