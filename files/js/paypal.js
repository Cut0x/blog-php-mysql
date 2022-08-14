paypal.Buttons({
    createOrder: (data, actions) => {
		return fetch("/api/orders", {
		    method: "post",
        })
        .then((response) => response.json())
        .then((order) => order.id);
	},
	onApprove: (data, actions) => {
    	return fetch(`/api/orders/${data.orderID}/capture`, {
        	method: "post",
        })
		.then((response) => response.json())
        .then((orderData) => {
			console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
          });
    }
}).render('#paypal-button-container');