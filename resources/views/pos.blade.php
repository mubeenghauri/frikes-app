<!DOCTYPE html>
<html>
<head>
	<title>Frikes</title>
	<link rel="stylesheet" type="text/css" href="css/mdb.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<style type="text/css">
		button {
			border: none; 
			padding:0.1;
		}
		.padder {
			padding:15px;
		}
		.padder-secondary {
			padding:15px;
			padding-top: 5px;
			margin: 0px;	
		}
		.order-window {
			/*height: 60%;*/
			width: 100%;
		}
		.order p{
			padding-top: 10px;
			text-align: right;
			font-weight: bold;
			font-size: 20px;	
		}
		.button-group-padding {
			padding-top: 10%;
			/*height: 70%;*/
		}
		.btn {
			font-size: 18px;
			margin: 0;
			/*padding: 0;*/
		}
		.arrow-padding {
			padding-top: 12px;
			padding-bottom: 13px;
		}
		.arrow-padding-1 {
			margin-bottom: 10px;
		}
		.c-nav {
			text-align: center;
			text-decoration-line: 12px;
		}
	</style>
</head>
<body>

		<!-- Navbar -->
	  <nav class="navbar navbar-expand-lg  bg-warning">
	    <!-- <div class="container-fluid text-center"> -->
	   		<h2 class="c-nav bold" style="font-weight: bold;align-content: center; margin-left: 47%; color: white;">Frikes</h2>
	    <!-- </div> -->
	  </nav>



	  <div class="main" style="margin-top: 20px;">
	  	<div class="container">
	  		<hr>
	  		<div class="row">
	  			<!-- <div class="col-md-3">
	  				<button style="" onclick="addOrder(this)">
	  					<div class="card" style="width: 18rem">
							  <div class="card-body">
							    <h5 class="card-title">Loaded Fries</h5>
							    <h6 class="card-subtitle mb-2 text-muted">Some description</h6>
							  	<p>Price : <span class="badge bg-light text-dark">200</span> </p> 
							  </div>
							</div>
	  				</button>
	  			</div>
	  			 seconnd card -->
	  			<!-- <div class="col-md-3">
	  				<button style="" onclick="addOrder(this)">
	  					<div class="card" style="width: 18rem">
							  <div class="card-body">
							    <h5 class="card-title">Fries</h5>
							    <h6 class="card-subtitle mb-2 text-muted">Some description</h6>
							  	<p>Price <span class="badge bg-warning ">100</span></p>
							  </div>
							</div>
	  				</button>
	  			</div> -->
	  			<!-- another card -->
	  			<!-- <div class="col-md-3">
	  				<button style="" onclick="addOrder(this)">
	  					<div class="card" style="width: 18rem">
							  <div class="card-body">
							    <h5 class="card-title">Potato Spirals</h5>
							    <h6 class="card-subtitle mb-2 text-muted">Some description</h6>
							  	<p>Price <span class="badge bg-warning text-dark">150</span></p>
							  </div>
							</div>
	  				</button>
	  			</div> -->
	  			<!-- one more -->

	  			@foreach($products as $p)
		  			<div class="col-md-3 mt-4">
		  				<button style="" onclick="addOrder(this)">
		  					<div class="card" style="width: 18rem">
								  <div class="card-body">
								    <h5 class="card-title"> {{ $p->name }}</h5>
								    <h6 class="card-subtitle mb-2 text-muted">Some description</h6>
								  	<p>Price <span class="badge bg-dark">{{ $p->price }}</span></p>
								  </div>
								</div>
		  				</button>
		  			</div> 
		  		@endforeach
	  		</div> <!-- End row -->
	  		<hr>
	  		<div class="container" style="margin-top: 30px;">
	  			<div class="row">
	  				<!-- Drinks -->
	  				<div class="col-md-3" style="border-style: none; padding: 0%; margin: 0%;">
	  					<center><h5>Drinks</h5></center>
	  					<ul class="list-group list-group-flush">
	  					<!-- Drink Card -->
	  						<div class="padder list-group-item">
		  						<button class="" onclick="addOrder(this)">
				  					<div class="card" style="width: 18rem">
										  <div class="card-body">
										    <h5 class="card-title">Coke</h5>
										    <h6 class="card-subtitle mb-2 text-muted">Some description</h6>
										  	<p>Price <span class="badge bg-light text-dark">60</span></p>
										  </div>
										</div>
				  				</button>
		  					</div>

								<!-- Another drink card  -->
		  					<div class="padder-secondary list-group-item">
		  						<button class="" onclick="addOrder(this)">
				  					<div class="card" style="width: 18rem">
										  <div class="card-body">
										    <h5 class="card-title">Pepsi</h5>
										    <h6 class="card-subtitle mb-2 text-muted">Some description</h6>
										  	<p>Price <span class="badge bg-light text-dark">60</span></p>
										  </div>
										</div>
				  				</button>
		  					</div>

		  					<!-- Another drink card  -->
		  					<div class="padder-secondary list-group-item">
		  						<button class="" onclick="addOrder(this)">
				  					<div class="card" style="width: 18rem">
										  <div class="card-body">
										    <h5 class="card-title">Dew</h5>
										    <h6 class="card-subtitle mb-2 text-muted">Some description</h6>
										  	<p>Price <span class="badge bg-light text-dark">60</span></p>
										  </div>
										</div>
				  				</button>
		  					</div>

		  					<!-- Another drink card  -->
		  					<div class="padder-secondary list-group-item">
		  						<button class="" onclick="addOrder(this)">
				  					<div class="card" style="width: 18rem">
										  <div class="card-body">
										    <h5 class="card-title">Sting</h5>
										    <h6 class="card-subtitle mb-2 text-muted">Some description</h6>
										  	<p>Price <span class="badge bg-light text-dark">60</span></p>
										  </div>
										</div>
				  				</button>
		  					</div>
	  					</ul>
	  				</div>

	  				<!-- spaces -->
	  				<div class="col-md-1">
	  					
	  				</div>

	  				<!-- Cart -->
	  				<div class="col-md-4">
	  					<center><h5>Order</h5></center>
	  					<div class="order-window">
	  						<!-- <div class="order" >
	  							<p style=""> Loaded Fries <span> x 2</span></p>
	  							<input type="hidden" name="price" value="200">
	  						</div> -->
	  						<!-- <div class="order" >
	  							<p style=""> Pepsi <span> x 2</span></p>
	  							<input type="hidden" name="price" value="60">
	  						</div> -->
	  					</div>
	  					<hr>
	  					<div class="order-total">
	  						<center>
	  						<h2>Total : <span id="total-amount">0.00</span> Rs</h2>
	  						</center>
	  					</div>
	  				</div>
	  				<div class="col-md-4">
	  					<div class="button-group-padding">
	  						<div class="container" id="button-group">
	  							<!-- <div class="row ">
	  								<div class="col-md-2">
				  						<button class="badge bg-warning "> <i class="fas fa-caret-down fa-2x"></i></button>
	  								</div>
	  								<div class="col-md-2">
				  						<button class="badge bg-warning "> <i class="fas fa-caret-up fa-2x"></i></button>
	  								</div>
	  							</div> -->
	  							<!-- row 2 -->
	  							<!-- <div class="row arrow-padding">
	  								<div class="col-md-2">
				  						<button class="badge bg-warning "> <i class="fas fa-caret-down fa-2x"></i></button>
	  								</div>
	  								<div class="col-md-2">
				  						<button class="badge bg-warning "> <i class="fas fa-caret-up fa-2x"></i></button>
	  								</div>
	  							</div> -->
	  						</div>
	  					</div>
	  						<div class="container">
	  							<div class="row">
	  								<div class="col-md-6">
	  									<button type="button" onclick="confirm()" class="btn btn-warning">Confirm !</button>
	  								</div>
	  								<div class="col-md-6">
	  									<button type="button" class="btn btn-danger" onclick="discard()">Discard</button>
	  								</div>
	  							</div>
	  						</div>
	  				</div>
	  			</div>
	  		</div>
	  	</div> <!-- End container -->
	  </div> <!-- End main -->

	  <script type="text/javascript">
	  	// window.print();

	  	function addOrder(e) {
				var itemName = e.children[0].children[0].children[0].innerHTML;
				var price = e.children[0].children[0].children[2].children[0].innerText;
				// console.log(e.children[0].children[0].children[2].children[0].innerText);
		  		console.log(itemName);
				var orders = document.getElementsByClassName('order-window')[0].children;
				var createNewOrder = true;
				console.log(orders.length)
				

				for (var i = 0; i < orders.length; i++) {
					var orderItemName = orders[i].children[0].innerText.split('x')[0];
					var orderItemQuantity = orders[i].children[0].children[0].innerText.split('x')[1];
					console.log(orderItemName);

					if(itemName.trim() == orderItemName.trim()) {
						// add to quantity
						var newQuantity = parseInt(orderItemQuantity, 10) + 1;
						console.log(newQuantity);
						orders[i].children[0].children[0].innerText = "x "+newQuantity;
						createNewOrder = false;
					}
				}

				if(createNewOrder) {
					console.log('get');
					var orderWindow = document.getElementsByClassName('order-window')[0];
					var buttonGroup = document.getElementById('button-group');
					console.log(price);
					var orderPayload = "<div class='order' ><p> "+itemName+" <span> x 1</span></p><input type='hidden' name='price' value="+price+"></div>";
					var arrowPadding = false;
					if(buttonGroup.children.length > 0) { arrowPadding = true; }
					var buttonsPayload = "<div id='"+itemName+"' class='row "+ (arrowPadding ? 'arrow-padding' : 'arrow-padding-1') +"'><div class='col-md-2'><button onclick='decrementOrder(this)' class='badge bg-warning'> <i class='fas fa-caret-down fa-2x'></i></button></div><div class='col-md-2'><button onclick='incrementOrder(this)' class='badge bg-warning'> <i class='fas fa-caret-up fa-2x'></i></button></div></div>";

					// injecting payloads
					orderWindow.innerHTML += orderPayload;
					buttonGroup.innerHTML += buttonsPayload;
				}
				updateTotal();
	  	}

	  	function incrementOrder(e) {
	  		console.log(e.parentNode.parentNode.id);
	  		var itemName = e.parentNode.parentNode.id;


	  		var orders = document.getElementsByClassName('order-window')[0].children;
				for (var i = 0; i < orders.length; i++) {
					var orderItemName = orders[i].children[0].innerText.split('x')[0];
					var orderItemQuantity = orders[i].children[0].children[0].innerText.split('x')[1];

					if(itemName.trim() == orderItemName.trim()) {
						orders[i].children[0].children[0].innerText = "x " + (parseInt(orderItemQuantity,10)+1);
					}
				}
				updateTotal();
	  	}

	  	function decrementOrder(e) {
	  		console.log(e.parentNode.parentNode.id);
	  		var itemName = e.parentNode.parentNode.id;


	  		var orders = document.getElementsByClassName('order-window')[0].children;
				for (var i = 0; i < orders.length; i++) {
					var orderItemName = orders[i].children[0].innerText.split('x')[0];
					var orderItemQuantity = orders[i].children[0].children[0].innerText.split('x')[1];

					if(itemName.trim() == orderItemName.trim()) {
						var quan = (parseInt(orderItemQuantity,10)-1);
						if(quan == 0) {
							orders[i].remove();
							e.parentNode.parentNode.remove();
						} else {
							orders[i].children[0].children[0].innerText = "x " + quan;
						}
					}
				}
				updateTotal();
	  	}
	  	function discard() {
	  		document.getElementsByClassName('order-window')[0].innerHTML = "";
	  		document.getElementById('button-group').innerHTML = "";
	  		setTotal(0);
	  	}

	  	function updateTotal() {
				var orders = document.getElementsByClassName('order-window')[0].children;
				var sum = 0;
				for (var i = 0; i < orders.length; i++) {
					var price = parseInt(orders[i].children[1].value, 10);
					var quantity = parseInt(orders[i].children[0].children[0].innerText.split('x')[1], 10);

					sum += price * quantity;
				}
				setTotal(sum);
	  	}

	  	function confirm() {
	  		alert("Printing order ... Not really :P, Coming soon");
	  	}

	  	function setTotal(total) {
				document.getElementById('total-amount').innerText = total;
	  	}
	  </script>
</body>
</html>