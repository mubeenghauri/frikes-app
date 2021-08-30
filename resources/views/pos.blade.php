<!DOCTYPE html>
<html>
<head>
	<title>Frikes</title>
	<link rel="stylesheet" type="text/css" href="css/mdb.min.css">
	<link rel="stylesheet" type="text/css" href="css/toastr.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/toastr.js"></script>
	<script src="js/bootstrap.min.js"></script>


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

		.item-pad {
			margin-left: 19px;
			margin-right: 19px; 
			/* width: 270px; */
		}

		/** BEGIN: Non Openmrs CSS **/
		@import url("https://fonts.googleapis.com/css?family=Roboto&display=swap");
		* {
			font-family: "Roboto";
		}
		/* div.container {
			display: flex;
			align-items: flex-start;
			justify-content: space-around;
			margin-top: 30px;
			border: 1px solid whitesmoke;
			padding: 21px;
			border-radius: 4px; */
		}
		h4.title {
			text-align: center;
			margin-bottom: 45px;
		}
		:root {
			--omrs-color-ink-lowest-contrast: rgba(47, 60, 85, 0.18);
			--omrs-color-ink-low-contrast: rgba(60, 60, 67, 0.3);
			--omrs-color-ink-medium-contrast: rgba(19, 19, 21, 0.6);
			--omrs-color-interaction: #1e4bd1;
			--omrs-color-interaction-minus-two: rgba(73, 133, 224, 0.12);
			--omrs-color-danger: #b50706;
			--omrs-color-bg-low-contrast: #eff1f2;
			--omrs-color-ink-high-contrast: #121212;
			--omrs-color-bg-high-contrast: #ffffff;
			
		}
		/** END: Non Openmrs CSS **/
		div.omrs-input-group {
		margin-bottom: 1.5rem;
		position: relative;
		width: 20.4375rem;
		}

		/* Input*/
		.omrs-input-underlined > input,
		.omrs-input-filled > input {
			border: none;
			border-bottom: 0.125rem solid var(--omrs-color-ink-medium-contrast);
			width: 100%;
			height: 2rem;
			font-size: 1.0625rem;
			padding-left: 0.875rem;
			line-height: 147.6%;
			padding-top: 0.825rem;
			padding-bottom: 0.5rem;
		}

		.omrs-input-underlined > input:focus,
		.omrs-input-filled > input:focus {
			outline: none;
		}

		.omrs-input-underlined > .omrs-input-label,
		.omrs-input-filled > .omrs-input-label {
			position: absolute;
			top: 0.9375rem;
			left: 0.875rem;
			line-height: 147.6%;
			color: var(--omrs-color-ink-medium-contrast);
			transition: top .2s;
		}

		.omrs-input-underlined > svg,
		.omrs-input-filled > svg {
			position: absolute;
			top: 0.9375rem;
			right: 0.875rem;
			fill: var(--omrs-color-ink-medium-contrast);
		}

		.omrs-input-underlined > .omrs-input-helper,
		.omrs-input-filled > .omrs-input-helper {
			font-size: 0.9375rem;
			color: var(--omrs-color-ink-medium-contrast);
			letter-spacing: 0.0275rem;
			margin: 0.125rem 0.875rem;
		}

		.omrs-input-underlined > input:hover,
		.omrs-input-filled > input:hover {
			background: var(--omrs-color-interaction-minus-two);
			border-color: var(--omrs-color-ink-high-contrast);
		}

		.omrs-input-underlined > input:focus + .omrs-input-label,
		.omrs-input-underlined > input:valid + .omrs-input-label,
		.omrs-input-filled > input:focus + .omrs-input-label,
		.omrs-input-filled > input:valid + .omrs-input-label {
			top: 0;
			font-size: 0.9375rem;
			margin-bottom: 32px;;
		}

		.omrs-input-underlined:not(.omrs-input-danger) > input:focus + .omrs-input-label,
		.omrs-input-filled:not(.omrs-input-danger) > input:focus + .omrs-input-label {
			color: var(--omrs-color-interaction);
		}

		.omrs-input-underlined:not(.omrs-input-danger) > input:focus,
		.omrs-input-filled:not(.omrs-input-danger) > input:focus {
			border-color: var(--omrs-color-interaction);
		}

		.omrs-input-underlined:not(.omrs-input-danger) > input:focus ~ svg,
		.omrs-input-filled:not(.omrs-input-danger) > input:focus ~ svg {
			fill: var(--omrs-color-ink-high-contrast);
		}

		/** DISABLED **/

		.omrs-input-underlined > input:disabled {
			background: var(--omrs-color-bg-low-contrast);
			cursor: not-allowed;
		}

		.omrs-input-underlined > input:disabled + .omrs-input-label,
		.omrs-input-underlined > input:disabled ~ .omrs-input-helper{
			color: var(--omrs-color-ink-low-contrast);
		}

		.omrs-input-underlined > input:disabled ~ svg {
			fill: var(--omrs-color-ink-low-contrast);
		}


		/** DANGER **/

		.omrs-input-underlined.omrs-input-danger > .omrs-input-label, .omrs-input-underlined.omrs-input-danger > .omrs-input-helper,
		.omrs-input-filled.omrs-input-danger > .omrs-input-label, .omrs-input-filled.omrs-input-danger > .omrs-input-helper{
			color: var(--omrs-color-danger);
		}

		.omrs-input-danger > svg {
			fill: var(--omrs-color-danger);
		}

		.omrs-input-danger > input {
			border-color: var(--omrs-color-danger);
		}

		.omrs-input-underlined > input {
			background: var(--omrs-color-bg-high-contrast);
		}
		.omrs-input-filled > input {
			background: var(--omrs-color-bg-low-contrast);
		}
	</style>
</head>
<body>

		<!-- Navbar -->
	  <nav class="navbar navbar-expand-lg  bg-warning">
	    <!-- <div class="container-fluid text-center"> -->
		<a href="{{url('/')}}">
			<img class="" style="margin-left: 10px; fill:white;"  src="css/icons/solid/home.svg" width="35" alt="home page">
		</a>
		<!-- </div> -->
		<h2 class="c-nav bold" style="font-weight: bold;align-content: center; margin-left: 47%; color: white; clear: both;">Frikes</h2>
		<!-- <div class="container-fluid navs" >
			<div class="row" style="margin-left: 200px;">
				<div class="col-md-6 form" >
					<select  class="form-control"  placeholder="Cancel Order" name="" id="">
						<option value="1">Some Option</option>
					</select>
				</div>
				<div class="col-md-6">
				<img onclick="showModal()"  onclick="" width="34" src="css/icons/trash-white.svg" alt="undo cancel sale">    

				</div>
			</div>
		</div> -->
	  </nav>


	  <div class="main" style="margin-top: 20px;">
	  	<div class="container-fluid pl-4 ml-4">
	  		<hr>
	  		<div class="row">
	  			@foreach($products as $p)
				  @if ($p->category == "main-course")
				  <div class="col-md-2 ml-4" style="padding-top:10px;">
		  				<button style="" onclick="addOrder(this)">
		  					<div class="card" style="width: 230px;">
								  <div class="card-body">
								    <h5 class="card-title"> {{ $p->name }}</h5>
								    <!-- <h6 class="card-subtitle mb-2 text-muted">Some description</h6> -->
									<hr>
								  	<p>Price <span class="badge bg-dark">{{ $p->price }}</span></p>
								  </div>
								</div>
		  				</button>
		  			</div> 					  
				  @endif
		  		@endforeach
	  		</div> <!-- End row -->
	  		<hr>

			  <!-- DRINKS  -->
	  		<div class="container" style="margin-top: 30px;">
	  			<div class="row">
	  				<!-- Drinks -->
	  				<div class="col-md-3" style="border-style: none; padding: 0%; margin: 0%;">
	  					<center><h5>Drinks</h5></center>
	  					<ul class="list-group list-group-flush">
							  @foreach($products as $p)
								@if ($p->category == "soft-drinks")
								<div class="col-md-3 mt-4">
										<button style="" onclick="addOrder(this)">
											<div class="card" style="width: 15rem">
												<div class="card-body">
													<h5 class="card-title"> {{ $p->name }}</h5>
													<hr>
													<p>Price <span class="badge bg-dark">{{ $p->price }}</span></p>
												</div>
												</div>
										</button>
									</div> 					  
								@endif
							@endforeach
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
	  						<h1>Total : <span id="total-amount">0.00</span> Rs</h1>
	  						</center>
	  					</div>
	  				</div>
	  				<div class="col-md-4">
	  					<div class="button-group-padding">
	  						<div class="container" id="button-group">
	  							<!-- just padding -->
	  						</div>
	  					</div>
						<div class="container">
							<div class="row" style="padding-top:24px;">
								<div class="col-md-6" s>
									<button type="button" onclick="confirm()" class="btn btn-warning">Confirm !</button>
								</div>
								<div class="col-md-6">
									<button type="button" class="btn btn-danger" onclick="discard()">Discard</button>
								</div>
							</div>
						</div>
							<div class="container">
							<div class="row">
								<div class="col-md-6">
									<!-- <button type="button" onclick="confirm()" class="btn btn-warning">Confirm !</button> -->
								</div>
								<div class="col-md-6" style="width: 100px; margin-top:30px;">
									<div class="omrs-input-group">
										<label class="omrs-input-underlined">
											Discount
										<input id="discount" placeholder="discount" value=0 required style="height: 50px; font-size: 40px;">
									</div>
								</div>
							</div>
						</div>  
	  				</div>
	  			</div>
	  		</div>
	  	</div> <!-- End container -->
	  </div> <!-- End main -->
            <!-- begin product items modal -->
            <div id="cancel-order-modal" class="modal fade cancel-order" tabindex="" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                            <h4 class="modal-title">Items</h4>
                        </div>
                        <div id="items-modal-body" class="modal-body">

                            <form class="form" action="">
								<label class="form-input" for=""> </label>
								<select class="form-input" name="" id=""></select>
						
							</form>
                        </div>
                        <div class="modal-footer">
							<button class="btn btn-primary"> Cancel Order </button>
                        </div>
                    </div>
                </div>
            </div>
	  <script type="text/javascript">
	  	// window.print();

	  	function addOrder(e) {
			var itemName = e.children[0].children[0].children[0].innerHTML;
			var price = e.children[0].children[0].children[2].children[0].innerText;
			// console.log(e.children[0].children[0].children[2].children[0].innerText);
			// console.log(itemName);
			var orders = document.getElementsByClassName('order-window')[0].children;
			var createNewOrder = true;
			// console.log(orders.length)
			

			for (var i = 0; i < orders.length; i++) {
				var orderItemName = orders[i].children[0].innerText.split('x')[0];
				var orderItemQuantity = orders[i].children[0].children[0].innerText.split('x')[1];
				// console.log(orderItemName);

				if(itemName.trim() == orderItemName.trim()) {
					// add to quantity
					var newQuantity = parseInt(orderItemQuantity, 10) + 1;
					// console.log(newQuantity);
					orders[i].children[0].children[0].innerText = "x "+newQuantity;
					createNewOrder = false;
				}
			}

			if(createNewOrder) {
				// console.log('get');
				var orderWindow = document.getElementsByClassName('order-window')[0];
				var buttonGroup = document.getElementById('button-group');
				// console.log(price);
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
	  		// console.log(e.parentNode.parentNode.id);
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
	  		// console.log(e.parentNode.parentNode.id);
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
	  		// alert("Printing order ... Not really :P, Coming soon");
			let orderdata = {};
			orderdata['items'] = []
			let o = document.getElementsByClassName("order-window")[0].children;
			if(o.length === 0) {
				toastr.info("Cant place empty order !");
				return;
			}
			for (let i = 0; i < o.length; i++) {
				let p = o[i].children[0].innerText;
				let price = o[i].children[1].value;
				console.log(p);
				console.log(price);
				
				let name = p.split('x')[0].trim();
				let quantity = p.split('x')[1].trim();

				let orderitem = {
					'name' : name, 
					'price' : price,
					'quantity' : quantity
				}

				orderdata['items'].push(orderitem);
			}
			orderdata['total'] = getTotal();
			orderdata['discount'] = getDiscount(); 
			console.log(orderdata);
			discard();
			submitOrder(orderdata);

	  	}

	  	function setTotal(total) {
			document.getElementById('total-amount').innerText = total;
	  	}

		function getTotal() {
			return document.getElementById('total-amount').innerText;
	  	}

		function getDiscount() {
			return document.getElementById('discount').value
		}

		function submitOrder(orderdata) {
			var xhr = new XMLHttpRequest();
			var url = "{{ url('/order') }}";
			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-Type", "application/json");
			xhr.setRequestHeader("X-CSRF-TOKEN", document.getElementsByTagName('meta')[0].content);

			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4 ) {
					console.log("Got response");
					console.log(xhr);
					console.log(xhr.status);
					console.log(xhr.responseText);

					if(xhr.status == 200) {
						toastr.success('Added order Successfully !!');
					} else if(xhr.status == 500 && xhr.responseText != "") {
						toastr.warning(xhr.responseText);
					} else {
						toastr.warning('Failed Adding order !');
					}
				}
			};
			xhr.send(JSON.stringify(orderdata));
		}

		function showModal() {
			$("#cancel-order-modal").modal('show');
		}
	  </script>
</body>
</html>